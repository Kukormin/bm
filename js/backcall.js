var errorMessage = "Заполните поле";

function backCallValidator() {

    var data = jQuery("#formMain").serialize();
    jQuery.ajax({
        url: "/ajax/BackCallValidator.php",
        type: "POST",
        dataType: "json",
        data: data,
        success: function (data) {
            for (var count in data['error']) {
                document.getElementById(data['error'][count]).innerHTML = errorMessage;
            }
            for (var count in data['success']) {
                document.getElementById(data['success'][count]).innerHTML = "";
            }

            if (data['status']) {
                backCallSender();
            }

        }
    });
}
function backCallSender() {
    jQuery.ajax({
        url: "/ajax/BackCallSender.php",
        type: "POST",
        dataType: "html",
        data: jQuery("#formMain").serialize(),
        success: function (response) {
            $.fancybox.close('#call-form');
            $.fancybox.open('#answer');
        }
    });
}
function backCallValidator1() {

    var data = jQuery("#formMain1").serialize();
    jQuery.ajax({
        url: "/ajax/BackCallValidator1.php",
        type: "POST",
        dataType: "json",
        data: data,
        success: function (data) {
            for (var count in data['error']) {
                document.getElementById(data['error'][count]).innerHTML = errorMessage;
            }
            for (var count in data['success']) {
                document.getElementById(data['success'][count]).innerHTML = "";
            }

            if (data['status']) {
                backCallSender1();
            }

        }
    });
}
function backCallSender1() {
    jQuery.ajax({
        url: "/ajax/BackCallSender1.php",
        type: "POST",
        dataType: "html",
        data: jQuery("#formMain1").serialize(),
        success: function (response) {
            $.fancybox.close('#call-form1');
            $.fancybox.open('#answer1');
        }
    });
}