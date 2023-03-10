<?php
require_once 'functions.php';
require_once 'api.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API Case</title>
    <?php
    require_once 'dependencies/css.php';
    require_once 'dependencies/js.php';
    ?>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title">organikhaberlesme.com Case</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="header">
                            <div class="form-group">
                                <label>API Key</label>
                                <input type="text" class="form-control" id="apikey" value="apikey">
                            </div>
                            <button class="btn btn-primary" id="btnMe" data-param="me">Kullanıcı Bilgileri</button>
                            <button class="btn btn-primary" id="btnBalance" data-param="balance">Bakiye</button>
                            <button class="btn btn-primary" id="btnSmsTitles" data-param="smsTitles">SMS Başlıkları</button>
                            <button class="btn btn-primary" id="otpSend">OTP Gönder</button>
                        </div>
                    </div>

                    <hr>

                    <div class="row d-none" id="result">
                        <div class="col-md-12">
                            <div>
                                <div class="alert alert-primary alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                    <span class="font-weight-bolder w-100 d-block h5" id="processTitle"></span>
                                    <span class="font-weight-semibold">İşlem Sonucu</span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body" id="resultJson">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-none" id="otpArea">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder">GSM</label>
                                <input type="text" class="form-control" id="mobile">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder">Mesaj</label>
                                <input type="text" class="form-control" id="message">
                            </div>
                            <div class="form-group">
                                <button class="btn bg-purple" id="send">OTP Kodu Gönder</button>
                            </div>
                        </div>
                        <div class="col-md-6 alert alert-primary d-nones" id="otpVerifyArea">
                            <div class="form-group">
                                <label class="font-weight-bolder">OTP Kodu</label>
                                <input type="text" class="form-control" id="verifyCode">
                                <input type="hidden" id="otpID">
                            </div>
                            <div class="form-group">
                                <button class="btn bg-indigo w-100" id="otpVerify">
                                    OTP Doğrula
                                    <span class="font-weight-bolder" id="spinner"></span>
                                </button>
                            </div>
                            <div class="form-group d-none" id="otpResultArea">
                                <div class="alert alert-info alert-styled-left alert-dismissible">
                                    <span class="font-weight-semibold">OTP Doğrulama : <span id="otpResult" class=" font-weight-bolder">Başarılı!</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 alert alert-danger d-none" id="otpErrors">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="dependencies/custom.js"></script>
</body>
</html>





<?php
//$me = me();
//$balance = balance();
//$smsTitles = smsTitles();
//echo $smsTitles;

//$sendOTP = sendOTP("905344319778", "TEST Doğrulama kodunuz");
//echo $sendOTP;

//$verifyOTP = verifyOTP("4017325800", "580991");
//echo $verifyOTP;
//// Send an asynchronous request.
//$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
//$promise = $client->sendAsync($request)->then(function ($response) {
//    echo 'I completed! ' . $response->getBody();
//});
//$promise->wait();
