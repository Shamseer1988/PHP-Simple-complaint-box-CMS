$(document).ready(function () {


	$("#email-message").hide();
	$("#user-message").hide();
	$("#confrimpswd").hide();
	$('#password-message').hide();


	$("#user_email").keyup(function () {
		check_email();
	});

	$("#user_name").keyup(function () {
		check_user_name();
	});

	$("#confirmpassword").keyup(function () {
		Check_ConfirmPasswrd();
	});

	$("#password").keyup(function () {
		check_Password();
	});



	// Email ID Validation ###################################################
	function check_email() {
		var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
		var email = $("#user_email").val();
		if (!(pattern.test(email))) {
			$("#email-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Hello Invalid Email Format</span>");
			$("#email-message").show();
			$("#user_email").css("border", "2px solid #F90A0A");
			$('#register').prop('disabled', true);
			EmailError = true;

			if (!(email.length >= 6 && email.length <= 250) || email.length == 0) {
				$("#email-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Email should be minimum 6 characters</span>");
				$("#email-message").show();
				$("#user_email").css("border", "2px solid #F90A0A");
				$('#register').prop('disabled', true);
				EmailError = true;

			}
		}
		else {
			$.ajax({
				type: 'post',
				url: 'live_validation.php',
				data: {
					'chkEmailBtn': 1,
					'user_email': $("#user_email").val(),
				},
				success: function (data) {
					if (data == 1) {
						EmailError = true;
						$("#email-message").show();
						$("#email-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Email ID All Ready Used</span>");
						$("#user_email").css("border", "2px solid #F90A0A");
						$('#register').prop('disabled', true);
					}
					else {
						EmailError = false;
						$("#email-message").show();
						$("#user_email").css("border", "2px solid #34F458");
						$("#email-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Email Available for Register</span>");
						$('#register').prop('disabled', false);
					}
				},
				error: function () {
					alert('Something went wrong');
				}
			});
		}
	}


	// User Name Validation ###################################################
	function check_user_name() {
		var username = $("#user_name").val();
		var pattern = /^[a-zA-Z-' ]*$/;
		if (!(pattern.test(username))) {
			$("#user-message").show();
			$("#user-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Only White Spaces are used</span>");
			$("#user_name").css("border", "2px solid #F90A0A");
			$('#register').prop('disabled', true);
			UnameError = true;
		}
		else if ((username.length <= 4 || username.length >= 12) || username.length == '') {
			$("#user-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> User name should be beetween 4 and 12 characters</span>");
			$("#user-message").show();
			$("#user_name").css("border", "2px solid #F90A0A");
			$('#register').prop('disabled', true);
			UnameError = true;
		}
		else {
			$("#user-message").show();
			$("#user_name").css("border", "2px solid #34F458");
			$("#user-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> User name Available for Register</span>");
			$('#register').prop('disabled', false);
			UnameError = false;
		}
	}


	//  Password Validation ###################################################
	function check_Password() {
		var passwrdValue = $('#password').val();

		if ((passwrdValue.length <= 4 || passwrdValue.length >= 12) || passwrdValue.length == '') {
			$('#password-message').show();
			$('#confrimpswd').hide();
			$("#password").css("border", "2px solid #F90A0A");
			$("#password-message").html("<span class=' text-danger'><i class='fa fa-times-circle'></i>password beetween 4 and 12 characters </span>");
			$('#register').prop('disabled', true);
			passwordError = true;

		} else {
			$("#password-message").show();
			$("#password").css("border", "2px solid #34F458");
			$("#password-message").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Password Varified</span>");
			$('#register').prop('disabled', false);
			passwordError = false;

		}
	}


	// Confirm Password Validation ###################################################
	function Check_ConfirmPasswrd() {
		var confirmPasswordValue = $('#confirmpassword').val();

		var passwrdValue = $('#password').val();

		if (confirmPasswordValue.length == '') {
			$('#confrimpswd').show();
			$("#confirmpassword").css("border", "2px solid #F90A0A");
			$("#confrimpswd").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Password should be confirmed</span>");
			$('#register').prop('disabled', true);
			confirmPasswordError = true;
		}

		else if (passwrdValue != confirmPasswordValue) {
			$('#confrimpswd').show();
			$("#confirmpassword").css("border", "2px solid #DEFF00");
			$("#confrimpswd").html("<span class=' text-danger'><i class='fa fa-times-circle'></i> Confirm password not match</span>");
			$('#register').prop('disabled', true);
			confirmPasswordError = true;

		} else {
			$("#confrimpswd").show();
			$("#confirmpassword").css("border", "2px solid #34F458");
			$("#confrimpswd").html("<span class=' text-success'><i class='fa fa-check-circle'></i> Confirm password done</span>");
			$('#register').prop('disabled', false);
			confirmPasswordError = false;


		}
	}


	// Submit button
	$('#register').click(function () {



		check_user_name();
		check_email();
		Check_ConfirmPasswrd();
		check_Password();


		if (
			(UnameError == false) &&
			(EmailError == false) &&
			(confirmPasswordError == false) &&
			(passwordError == false)


		) {
			return true;

		} else {
			return false;

		}

	});


});

