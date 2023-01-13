<?php
require_once 'functions.php';
require_once 'api.php';

if(!$_POST)
    die(json_encode(array('status' => 400, 'title' => "Başarısız", 'text' => "Geçersiz İşlem")));
else{
    $param = $_POST['param'];
    $post = $_POST;

    if($param == "me"){
        me();
    }
    else if($param == "balance"){
        balance();
    }
    else if($param == "smsTitles"){
        smsTitles();
    }
    else if($param == "sendOTP"){
        $mobile = $post['mobile'];
        $message = $post['message'];
        sendOTP($mobile, $message);
    }
    else if($param == "verifyOTP"){
        $otpID = $post['otpID'];
        $code = $post['verifyCode'];
        verifyOTP($otpID, $code);
    }
    else{
        die(json_encode(array('status' => 400, 'title' => "Başarısız", 'text' => "Geçersiz İşlem")));
    }
}
