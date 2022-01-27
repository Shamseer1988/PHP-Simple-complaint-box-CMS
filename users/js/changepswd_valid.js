$(document).ready(function () {


    $("#confirmPass-message").hide();
    $("#newPass-message").hide();
    $("#currentPass-mecurrentPass").hide();
    $(".input-group-text.confirm").hide();
    $(".input-group-text.new").hide();
    $(".input-group-text.current").hide();




    $("#currentPassword").keyup(function () {
        check_currentPassword();
    });



    $("#changeConfirmPswd").keyup(function () {
        changeConfirmPswd();
    });



    $("#newPassword").keyup(function () {
        newPassword();
    });



    // Email ID Validation ###################################################
    function check_currentPassword() {

        var currentPassword = $("#currentPassword").val();
        $(".input-group-text.current").show();
        $(".input-group-text.current").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
        if (!(currentPassword.length >= 6 && currentPassword.length <= 250) || currentPassword.length == 0) {
            $("#currentPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Email should be minimum 6 characters</span>");
            $("#currentPass-message").show();
            $("#currentPassword").css("border", "2px solid #F90A0A");
            $('#changepassword').prop('disabled', true);
            currentPassError = true;

        }

        else {
            $.ajax({
                type: 'post',
                url: 'live_validation.php',
                data: {
                    'currentpswdBtn': 1,
                    'currentpswd': $("#currentPassword").val(),
                },
                success: function (data) {
                    if (data == 1) {
                        $(".input-group-text.current").show();
                        $(".input-group-text.current").html("<span class=' text-success'><i class='fa fa-check-circle'></i></span>");
                        currentPassError = false;
                        $("#currentPass-message").show();
                        $("#currentPassword").css("border", "2px solid #34F458");
                        $("#currentPass-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Current Password Checked</span>");
                        $('#changepassword').prop('disabled', false);
                    }
                    else {
                        $(".input-group-text.current").show();
                        $(".input-group-text.current").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
                        currentPassError = true;
                        $("#currentPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Current Password not Match</span>");
                        $("#currentPass-message").show();
                        $("#currentPassword").css("border", "2px solid #F90A0A");
                        $('#changepassword').prop('disabled', true);
                        currentPassError = true;
                    }
                },
                error: function () {
                    alert('Something went wrong');
                }
            });
        }
    }


    // Confirm Password Validation ###################################################
    function changeConfirmPswd() {
        var confirmPasswordValue = $('#changeConfirmPswd').val();

        var passwrdValue = $('#newPassword').val();

        if (confirmPasswordValue.length == '') {
            $(".input-group-text.confirm").show();
            $('#confirmPass-message').show();
            $("#changeConfirmPswd").css("border", "2px solid #F90A0A");
            $("#confirmPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Password should be confirmed</span>");
            $(".input-group-text.confirm").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
            $('#changepassword').prop('disabled', true);
            confirmPswdError = true;
        } else if (passwrdValue != confirmPasswordValue) {
            $('#confirmPass-message').show();
            $("#changeConfirmPswd").css("border", "2px solid #F90A0A");
            $("#confirmPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Confirm password not match</span>");
            $(".input-group-text.confirm").show();
            $(".input-group-text.confirm").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
            $('#changepassword').prop('disabled', true);
            confirmPswdError = true;

        } else {
            $(".input-group-text.confirm").show();
            $(".input-group-text.confirm").html("<span class=' text-success'><i class='fa fa-check-circle'></i></span>");
            $("#confirmPass-message").show();
            $("#changeConfirmPswd").css("border", "2px solid #34F458");
            $("#confirmPass-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Confirm password done</span>");
            $('#changepassword').prop('disabled', false);
            confirmPswdError = false;
        }
    }


    //  Password Validation ###################################################
    function newPassword() {
        var passwrdValue = $('#newPassword').val();
        var currentPassword = $('#currentPassword').val();

        if ((passwrdValue.length <= 4 || passwrdValue.length >= 12) || passwrdValue.length == '') {
            $(".input-group-text.new").show();
            $(".input-group-text.new").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
            $('#newPass-message').show();
            $('#confirmPass-message').hide();
            $("#newPassword").css("border", "2px solid #F90A0A");
            $("#newPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i>password beetween 4 and 12 characters </span>");
            $('#changepassword').prop('disabled', true);
            newPswdError = true;

        }
        else if (passwrdValue == currentPassword) {
            $(".input-group-text.new").show();
            $(".input-group-text.new").html("<span class=' text-danger'><i class='fa fa-times-circle'></i></span>");
            $('#newPass-message').show();
            $('#confirmPass-message').hide();
            $("#newPassword").css("border", "2px solid #F90A0A");
            $("#newPass-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i>password should not be same </span>");
            $('#changepassword').prop('disabled', true);
            newPswdError = true;
        }
        else {
            $(".input-group-text.new").show();
            $(".input-group-text.new").html("<span class=' text-success'><i class='fa fa-check-circle'></i></span>");
            $("#newPass-message").show();
            $("#newPassword").css("border", "2px solid #34F458");
            $("#newPass-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Password Varified</span>");
            $('#changepassword').prop('disabled', false);
            newPswdError = false;

        }
    }


    // Submit button
    $('#changepassword').click(function () {

        changeConfirmPswd();
        check_currentPassword()
        newPassword();

        if (
            (currentPassError == false) &&
            (confirmPswdError == false) &&
            (newPswdError == false)


        ) {
            return true;

        } else {
            return false;

        }

    });

});

