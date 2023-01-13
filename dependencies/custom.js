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
    // $("#otpVerifyArea").addClass("d-none");
    $("#result").addClass("d-none");
    $("#otpArea").removeClass("d-none");
    $("#resultJson").html("");
})

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
                $("#otpVerifyArea").addClass("alert-primary");
                $("#otpArea").removeClass("d-none");
                let interval = 30;
                tis.prop("disabled", true);
                $("#otpVerifyArea").removeClass("d-none");
                var timer = setInterval(() => {
                    $("#spinner").html(`- ${interval--} <i class="fas fa-spinner fa-spin ml-1"></i>`);
                }, 1000)
                setTimeout(() => {
                    tis.html(html);
                    tis.prop("disabled", false);
                    clearInterval(timer);
                    $("#otpVerifyArea").removeClass("alert-primary").addClass("alert-warning");
                    $("#spinner").html(`- 00 <i class="fas fa-exclamation-triangle ml-1"></i>`);
                }, 3000);
            }
            else{

            }
        }
    });
})
