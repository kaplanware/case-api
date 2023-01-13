<?php
require 'vendor/autoload.php';
function guzzleGo($method = "GET", $urlParam = "", $params = []){
    $client = new GuzzleHttp\Client(["headers" => ["X-Organik-Auth" => $_POST["apikey"]]]);
    //guzzle sendasync with parameters
//    http_build_query($params);
//    $request = new \GuzzleHttp\Psr7\Request($method, apiUrl($urlParam), $params);
//
//    $promise = $client->sendAsync($request)->then(function ($response) {
//        echo $response->getBody();
//    });
//    $promise->wait();

    $request = new \GuzzleHttp\Psr7\Request($method, apiUrl($urlParam), [], json_encode($params));

    $promise = $client->sendAsync($request)->then(function ($response) {
        return $response;
//        $resp = json_decode($response->getBody(), true);
//        $promise->resolve('foo');
//        die(json_encode(array("text" => $resp)));
    })->otherwise(function ($e) {
        die(json_encode(array("status" => 400, "title" => "Başarısız", "text" => $e->getMessage())));
    });
    return $promise;
//    $promise->wait();

//    $res = $client->request($method, apiUrl($urlParam), [
//        "headers" => [
//            "X-Organik-Auth" => $_POST["apikey"]
//        ],
//        "json" => $params
//    ]);
//    return $res;
}

function me(){
    $promise = guzzleGo("GET", "me")->wait();
    promiseCheck($promise);
}

function balance(){
    $promise = guzzleGo("GET", "user/payment/balance")->wait();
    promiseCheck($promise);
}

function smsTitles($return = true){
    $promise = guzzleGo("GET", "sms/headers/get")->wait();
    if($return)
        promiseCheck($promise);
    else
        return $promise;
}

function sendOTP($mobile = "", $message = ""){
    $smsHeaderCode = smsTitles(false);
    $smsHeaderCode = json_decode($smsHeaderCode->getBody(), true);
    if($smsHeaderCode["result"] !== true)
        die(json_encode(array("status" => 400, "title" => "Başarısız", "text" => "Kayıtlı SMS Başlığı Bulunamadı")));
    else {
        $params = [
            "message" => $message . ' : ${code}',
            "recipients" => $mobile,
            "header" => $smsHeaderCode["data"][0]["id"],
            "type" => "sms",
            "encode" => "numeric",
            "timeout" => 60,
            "length" => 6
        ];
        $promise = guzzleGo("POST", "sms/otp/send", $params)->wait();
        promiseCheck($promise);
    }
}

function verifyOTP($otpID = "", $code = ""){
    $params = [
        "id" => $otpID,
        "code" => $code
    ];
    $promise = guzzleGo("POST", "sms/otp/verify", $params)->wait();
    promiseCheck($promise);
}