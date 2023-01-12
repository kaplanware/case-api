<?php
require 'vendor/autoload.php';

function guzzleGo($method = "GET", $urlParam = "", $params = []){
    $client = new GuzzleHttp\Client();
    $res = $client->request($method, apiUrl($urlParam), [
        "headers" => [
            "X-Organik-Auth" => session("apikey")
        ],
        "json" => $params
    ]);
    return $res;
}

function me(){
    return guzzleGo("GET", "me")->getBody();
}

function balance(){
    return guzzleGo("GET", "user/payment/balance")->getBody();
}

function smsTitles(){
    return guzzleGo("GET", "sms/headers/get")->getBody();
}

function sendOTP($mobiles = [], $message = ""){
    $params = [
        "message" => $message . ' : ${code}',
        "recipients" => $mobiles,
        "header" => 100077,
        "type" => "sms",
        "encode" => "numeric",
        "timeout" => 60,
        "length" => 6
    ];
    return guzzleGo("POST", "sms/otp/send", $params)->getBody();
}

function verifyOTP($otpID = "", $code = ""){
    $params = [
        "id" => $otpID,
        "code" => $code
    ];
    return guzzleGo("POST", "sms/otp/verify", $params)->getBody();
}