$(document).ready(function () {
    // xét chiều cao phù hợp màn hình
    $(".main").height($(window).height());

    $("#formReg").submit(function (e) {
        // Khai báo biến
        const $MessageUser = $("#MessageUser");
        $MessageUser.text("");
        const $MessagePass = $("#MessagePass");
        $MessagePass.text("");
        const $MessageConfirm = $("#MessageConfirm");
        $MessageConfirm.text("");
        const $MessageMail = $("#MessageMail");
        $MessageMail.text("");
        const $MessageNumber = $("#MessageNumber");
        $MessageNumber.text("");

        var user = $("#username").val();
        var pass = $("#password").val();
        var confirm = $("#confirm").val();

        // Validate password
        var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        var checkval = pattern.test($("#password").val());
        if (!checkval) {
            e.preventDefault();
            $("#password").addClass("error");
            $MessagePass.text("Password phải chứa ít nhất 8 ký tự");
            $MessagePass.css("color", "red");
        } else if (confirm == "") {
            e.preventDefault();
            $("#confirm").addClass("error");
            $MessageConfirm.text("Confirm không được để trống");
            $MessageConfirm.css("color", "red");
        } else {
            if (pass != confirm) {
                e.preventDefault();
                $("#confirm").addClass("error");
                $MessageConfirm.text("Đã có lỗi");
                $MessageConfirm.css("color", "red");
            } else {
                $("#password").addClass("success");
                $("#confirm").addClass("success");
                window.location.href='login.php';
            }
        }
    });
//    Check Email
    const validateEmail = (email) => {
        return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
    };

    const checkEmail = () => {
        const $MessageMail = $('#MessageMail');
        const email = $('#email').val();
        $MessageMail.text("");

        if (validateEmail(email)) {
            $("#email").addClass("success");
        } else if (email == '') {
            $("#email").removeClass("success");
            $MessageMail.text('Email không được để trống');
            $MessageMail.css('color', 'red');
        } else {
            $("#email").removeClass("success");
            $("#email").addClass("error");
            $MessageMail.text(email + ' không hợp lệ ');
            $MessageMail.css('color', 'red');
        }
        return false;
    }

    $('#email').on('input', checkEmail);


//    Check User
    const validateUser = (user) => {
        return user.match(/^[a-zA-Z0-9]*.{6,}$/);
    };
    const checkUser = () => {
        const $MessageUser = $('#MessageUser');
        const user = $('#username').val();
        $MessageUser.text('');

        if (validateUser(user)) {
            $('#username').addClass("success");
            $MessageUser.css('color', 'green');
        } else if(user ==''){
            $('#username').removeClass("success");
            $('#username').addClass("error");
            $MessageUser.text('UserName không được để trống');
            $MessageUser.css('color', 'red');
        }
        else {
            $('#username').removeClass("success");
            $('#username').addClass("error");
            $MessageUser.text('UserName không hợp lệ');
            $MessageUser.css('color', 'red');
        }
        return false;
    }

    $('#username').on('input', checkUser);
    
//    Check numberphone
        const validateNumber = (PhoneNumber) => {
            return PhoneNumber.match(/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/);
        };
        const checkNumber = () => {
        const $MessageNumber = $('#MessageNumber');
        const PhoneNumber = $('#phonenumber').val();
        $MessageNumber.text('');
        
        if (validateNumber(PhoneNumber)) {
            $('#phonenumber').addClass("success");
            $MessageNumber.css('color', 'green');
        } else if(PhoneNumber ==''){
            $('#phonenumber').removeClass("success");
            $('#phonenumber').addClass("error");
            $MessageNumber.text('PhoneNumber không được để trống');
            $MessageNumber.css('color', 'red');
        }
        else {
            $('#phonenumber').removeClass("success");
            $('#phonenumber').addClass("error");
            $MessageNumber.text('PhoneNumber không hợp lệ');
            $MessageNumber.css('color', 'red');
        }
        return false;
        
        }
        $('#phonenumber').on('input', checkNumber);
});
