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
        $balance = balance();
        die(json_encode(array('status' => 200, 'title' => "Başarılı", 'text' => $balance)));
    }
    else if($param == "smsTitles"){
        $smsTitles = smsTitles();
        die(json_encode(array('status' => 200, 'title' => "Başarılı", 'text' => $smsTitles)));
    }
    else if($param == "sendOTP"){
        $mobile = $post['mobile'];
        $message = $post['message'];
        $sendOTP = sendOTP($mobile, $message);
        die(json_encode(array('status' => 200, 'title' => "Başarılı", 'text' => $sendOTP)));
    }
    else if($param == "verifyOTP"){
        $otpID = $post['otpID'];
        $code = $post['code'];
        $verifyOTP = verifyOTP($otpID, $code);
        die(json_encode(array('status' => 200, 'title' => "Başarılı", 'text' => $verifyOTP)));
    }
    else{
        die(json_encode(array('status' => 400, 'title' => "Başarısız", 'text' => "Geçersiz İşlem")));
    }
}
