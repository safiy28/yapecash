<?php


namespace App\Facades\HttpClient;


use GuzzleHttp\Exception\RequestException;
use Log;
use Carbon\Carbon;
use GuzzleHttp\Client;

class GuzzleHttp extends HttpCallable {
    public function __construct($url = null) {
        if(is_null($url)){
            $this->client = new Client();
        }else{
            $this->client = new Client(['base_uri' => $url]);
        }

    }

    /**
     * @param $method
     * @param $url
     * @param $data
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send($method, $url, $data, $headers = ["Content-Type" => "application/json"]) {
        $url = self::BASEURL.$url;
        $method = strtoupper($method);

        $contentType = $headers['Content-Type'] ??  ($headers['content-type'] ?? '');
        if(session()->has('authtoken')){
            $headers['token'] = session('authtoken');

        }
        $requestTime = Carbon::now();

        $this->logRequest($method, $url, $data, $headers);

        $requestData['headers'] = $headers;

        if(in_array($method, ['GET', 'DELETE'])){
            $requestData['query'] = $data;

        }elseif(in_array($method, ['POST','PUT', 'PATCH'])){

            switch(strtolower($contentType)){
                case 'application/json':
                    $requestData['json'] = $data;
                    break;
                case 'application/x-www-form-urlencoded':
                    $requestData['form_params'] = $data;
                    break;
                case 'multipart/form-data':
                    $requestData['multipart'] = $data;
                    break;
                default:
                    $requestData['body'] = $data;
                    break;
            }
        }

        try {
            $response = $this->client->request($method, $url, $requestData);
        }catch (RequestException $e){
            Log::error(Log::getLine($e), __METHOD__);
            $response = $e->getResponse();
        }

        $responseTime = Carbon::now();
        try{
            if(is_null($response)){
                Log::error('Response is null', __METHOD__);
                return false;
            }
            $response->contents = $response->getBody()->getContents();
            //This is for previous getContents() call, it change the stream to last
            $response->getBody()->seek(0);
        }catch (\Exception $exception){
            Log::error(Log::getLine($exception), __METHOD__);
            return false;
        }

        Log::info('Respond with: '.$response->getStatusCode().'; Taken '.$responseTime->diffInSeconds($requestTime).'s', __METHOD__);

        if($response->getStatusCode() >= 200 && $response->getStatusCode() < 300){
            Log::success('Data: '.$response->contents, __METHOD__);
        }else{
            Log::error('Data: '.$response->contents, __METHOD__);
        }

        return $response;
    }

    public function post($url, $data = [], $headers = ["Content-Type" => "application/json"]) {
        return $this->send('post', $url, $data, $headers);
    }

    public function get($url, $data = [], $headers = []) {
        return $this->send('get', $url, $data, $headers);
    }

    public function put($url, $data = [], $headers = ["Content-Type" => "application/json"]) {
        return $this->send('put', $url, $data, $headers);
    }

    public function patch($url, $data = [], $headers = ["Content-Type" => "application/json"]){
        return $this->send('patch', $url, $data, $headers);
    }

    public function delete($url, $data = [], $headers = []) {
        return $this->send('delete', $url, $data, $headers);
    }
}