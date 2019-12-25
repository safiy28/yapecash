<?php

function exceptionLine(\Exception $e, $msg = null, $isLog = false)
{
    if ($isLog) {
        return 'Line: '.$e->getLine().' File: '.$e->getFile().' => '.$e->getMessage();
    }

    if (! isProduction()) {
        return $e->getMessage();
    }

    return $msg ?? 'Unknown exception';
}

function isProduction()
{
    return in_array(env('APP_ENV'), ['production', 'local']);
}

function parseApiResponse($response){
    return json_decode($response->contents, true);
}
function uploadDocuments($file,$fieldName,$suffix){
    $imageName = $fieldName.'_'.$suffix.'.'.$file->getClientOriginalExtension();
    $destination = base_path().'/public/files/uploaded/user/temp/';
    $file->move($destination, $imageName);
    $upload = 'files/uploaded/user/temp/' . $imageName;
    $inputs = curl_file_create(realpath($upload));
    $inputs->mime = 'image/' . $file->getClientOriginalExtension();
    $inputs->postname = $imageName;
    return $inputs;
}
function getCountryDialingCode($country){
    $dialingCode = [
        'singapore' => '65',
        'malaysia' => '6',
        'nepal' => '977',
        'indonesia' => '62',
        'bangladesh' => '88',
        'australia' => '61'
    ];
    return $dialingCode = $dialingCode[$country];
}
function generateReceiverNumber($number,$country){
    $dialingCode = getCountryDialingCode($country);
    $dialingCodeLength = strlen($dialingCode);
    $returnNumber = substr($number,0,$dialingCodeLength) == $dialingCode ?  $number : $dialingCode.$number;
    return $returnNumber;
}
function removeDialingCode($number,$country){
    $dialingCode = getCountryDialingCode($country);
    $dialingCodeLength = strlen($dialingCode);
    //$dialingCodeNewLength = $country =='bangladesh' ? $dialingCodeLength-0 : $dialingCodeLength;
    $returnNumber = substr($number, $dialingCodeLength);
    return $returnNumber;
}
function customEncryptDecrypt( $string, $action = 'encrypt' ) {
    // you may change these values to your own
    $secret_key = '1989';
    $secret_iv = 'mycash@sg@card';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'encrypt' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}
function generateCardLabel($type){
    switch  ($type) {
        case "Visa":
            $inputlabel = "card-label-visa";
            break;
        case "MasterCard":
            $inputlabel = "card-label-master";
            break;
        case "Amex":
            $inputlabel = "card-label-amex";
            break;
        case "Discover":
            $inputlabel = "card-label-discover";
            break;
        case "JCB":
            $inputlabel = "card-label-jcb";
            break;
        case "DinersClub":
            $inputlabel = "card-label-diners-club";
            break;
        default:
            $inputlabel = "card-label-default";
    }
    return $inputlabel;
}




