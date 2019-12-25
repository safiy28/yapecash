<?php
namespace App\Facades\HttpClient;

use Carbon\Carbon;
use Log;


class Curl extends HttpCallable
{

    public function send($method, $url, $data, $headers = ["Content-Type" => "application/json"])
    {
        $url = self::BASEURL.$url;
        $method = strtoupper($method);
        $requestTime = Carbon::now();
        $this->logRequest($method, $url, $data, $headers);
        $builtHeader = [];

        foreach($headers as $key => $header){
            $builtHeader[] = "$key:$header";
        }
        $builtHeader[] = 'token: ' . session('authtoken');
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $builtHeader,
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $headersFirst = explode(':', $builtHeader[0]);
        if (strtolower($method) == 'post') {
            if (isset($headersFirst[1]) && trim(strtolower($headersFirst[1])) == "application/json") {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        $result = curl_exec($ch);

        $responseTime = Carbon::now();

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        Log::info("Respond with $httpCode; Taken ".$responseTime->diffInSeconds($requestTime).'s', __METHOD__);

        return $this->formatResponse($result, $ch, $httpCode);
    }

    public function post($url, $data = [], $headers = ["Content-Type" => "application/json"])
    {
        return $this->send('POST', $url, $data, $headers);
    }

    public function get($url, $data = [], $headers = [])
    {
        return $this->send('GET', $url, $data, $headers);
    }

    public function put($url, $data = [], $headers = ["Content-Type" => "application/json"])
    {
        return $this->send('PUT', $url, $data, $headers);
    }

    public function delete($url, $data = [], $headers = [])
    {
        return $this->send('DELETE', $url, $data, $headers);
    }

    private function formatResponse($result, $ch, $httpCode){
        $response = new \stdClass();
        $response->contents = $result;
        $response->statusCode = $httpCode;
        $responseLine = 'Data: '.$response->contents;

        if($httpCode >= 200 && $httpCode < 300){
            Log::success($responseLine, __METHOD__);
        }elseif((curl_errno($ch) || $httpCode != 200)){
            Log::error($responseLine, __METHOD__);
            Log::error('CURL reported error: '.curl_error($ch), __METHOD__);
        }

        curl_close($ch);
        return $response;
    }

    public static function create(){
        return new static();
    }
}