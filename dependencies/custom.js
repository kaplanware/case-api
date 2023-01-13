$("[id^=btn]").click(function() {
    let param = $(this).data("param");
    let html = $(this).html()
    $.ajax({
        type: "POST",
        url: "apiCheck.php",
        dataType: "json",
        data: {
            param: param,
            apikey : $("#apikey").val(),
        },
        success: function (response) {
            let tree = objectToArray(response.text.data);
            if(tree.length > 0) {
                $("#otpArea").addClass("d-none");
                $("#result").removeClass("d-none");
                $("#resultJson").html("<pre>" + JSON.stringify(tree, null, 2) + "</pre>");
                $("#processTitle").html(html);
            }
            else
                $("#result").addClass("d-none");
        }
    });
});

function objectToArray(obj){
    var arr = [];
    for(var key in obj){
        arr.push(obj[key]);
    }
    return arr;
}

$("#otpSend").click(function() {
    $("#otpVerifyArea").addClass("d-none");
    $("#result").addClass("d-none");
    $("#otpArea").removeClass("d-none");
    $("#resultJson").html("");
    $("#otpResultArea").addClass("d-none")
})

var timer = "";
var timer2 = "";
$("#send").click(function() {
    let tis = $(this);
    let html = tis.html();
    $.ajax({
        type: "POST",
        url: "apiCheck.php",
        dataType: "json",
        data: {
            param: "sendOTP",
            apikey : $("#apikey").val(),
            mobile: $("#mobile").val(),
            message: $("#message").val(),
        },
        success: function (response) {
            if(response.status == 200) {
                $("#otpErrors").addClass("d-none")
                $("#otpVerifyArea").addClass("alert-primary");
                $("#otpArea").removeClass("d-none");
                $("#otpVerifyArea").removeClass("d-none");

                $("#otpID").val(response.text.data);
                let interval = 30;
                tis.prop("disabled", true);
                timer = setInterval(() => {
                    $("#spinner").html(`- ${interval--} <i class="fas fa-spinner fa-spin ml-1"></i>`);
                }, 1000)
                timer2 = setTimeout(() => {
                    tis.html(html);
                    tis.prop("disabled", false);
                    clearInterval(timer);
                    $("#otpVerifyArea").removeClass("alert-primary").addClass("alert-warning");
                    $("#spinner").html(`- 00 <i class="fas fa-exclamation-triangle ml-1"></i>`);
                }, 30000);
            }
            else{
                $("#otpVerifyArea").addClass("d-none");
                $("#otpErrors").removeClass("d-none").html("<pre class='border-0'>" + JSON.stringify(response, null, 2) + "</pre>");
            }
        }
    });
})

$("#otpVerify").click(function(){
    clearInterval(timer);
    clearTimeout(timer2);
    $("#spinner").html(``);
    $.ajax({
        type: "POST",
        url: "apiCheck.php",
        dataType: "json",
        data: {
            param: "verifyOTP",
            apikey : $("#apikey").val(),
            otpID: $("#otpID").val(),
            verifyCode: $("#verifyCode").val(),
        },
        success: function (response) {
            if(response.status == 200) {
                $("#otpResultArea").removeClass("d-none").find("#otpResult").addClass("text-success").html(response.title.toUpperCase())
                $("#otpVerifyArea").removeClass("alert-warning").addClass("alert-success");
                $("#spinner").html(`- <i class="fas fa-check ml-1"></i>`);
            }
            else{
                $("#otpResultArea").removeClass("d-none").find("#otpResult").addClass("text-danger").html(response.title.toUpperCase())
                $("#otpVerifyArea").removeClass("alert-warning").addClass("alert-danger");
                $("#spinner").html(`- <i class="fas fa-times ml-1"></i>`);
            }
        }
    });
})

$("#header button").click(function() {
    $("#header button").removeClass("btn-dark");
    $(this).addClass("btn-dark");
})