<?php
require_once("includes/config.php");


//User Login 
if (isset($_POST['login'])) {
	$ret = mysqli_query($db, "SELECT * FROM users WHERE userEmail='" . $_POST['user_email'] . "' and password='" . md5($_POST['password']) . "'");
	$num = mysqli_fetch_array($ret);

	if ($num["status"] == "0") {
		$locked = "Your Account is Disabled Contact Admin ";
	} else if ($num["status"] == "1") {
		$_SESSION['login'] = $_POST['user_email'];
		$_SESSION['UserId'] = $num['id'];
		header("location:dashbord.php");
		exit();
	} else {
		$errormsg = "Invalid username or password";
	}
}


//User Registration 
if (isset($_POST['register'])) {
	$fullname = strtoupper($_POST['user_name']);
	$email = strtolower($_POST['user_email']);
	$password = md5($_POST['password']);
	$status = 1;
	$query = mysqli_query($db, "insert into users(name,userEmail,password,status) values('$fullname','$email','$password','$status')");
	$msg = "Registration successfull. Now You can login !";
}

//Register User Complaint 
if (isset($_POST['submitcomplaint'])) {
	$uid = $_SESSION['UserId'];
	$products = $_POST['products'];
	$complaintype = $_POST['complaintype'];
	$complaintdetials = ucfirst(strtolower($_POST['complaindetails']));
	$compfile = str_replace(" ", "_", $_FILES["compfile"]["name"]);


	move_uploaded_file($_FILES["compfile"]["tmp_name"], "complaintdocs/" . $compfile);
	$query = mysqli_query($db, "insert into tblcomplaints(userId,product,complaintType,complaintDetails,complaintFile) values('$uid','$products','$complaintype','$complaintdetials','$compfile')");

	$sql = mysqli_query($db, "select complaintNumber from tblcomplaints  order by complaintNumber desc limit 1");
	while ($row = mysqli_fetch_array($sql)) {
		$cmpn = $row['complaintNumber'];
	}
	$complainno = $cmpn;
	$_SESSION['response'] = "Your complaint successfully registrated . Complaint No is :$complainno ";
	$_SESSION['res_type'] = "success";
	header("location:dashbord.php");
}


//User	Profile	Change


if (isset($_POST['usrprofileUpdate'])) {
	$uid = $_SESSION['UserId'];
	$userFName	=	ucfirst(strtolower($_POST['userFName']));
	$userSName = ucfirst(strtolower($_POST['userSName']));
	$userDist = ucfirst(strtolower($_POST['userDist']));
	$userState = ucfirst(strtolower($_POST['userState']));
	$userCountry = ucfirst(strtolower($_POST['userCountry']));
	$userMobile = $_POST['userMobile'];
	$userImg = str_replace(" ", "_", $_FILES["userImg"]["name"]);

	move_uploaded_file($_FILES["userImg"]["tmp_name"], "UserImage/" . $userImg);
	$query = mysqli_query($db, "update users set userFName='$userFName',userSName='$userSName',userDist='$userDist',userState='$userState',userCountry='$userCountry',userMobile='$userMobile',userImg='$userImg' where id ='$uid'");
	if ($query) {
		$_SESSION['response'] = "Your	Profile	id	No:$uid	Successfully	Updated ";
		$_SESSION['res_type'] = "success";
		header("location:dashbord.php");
	} else {
		$errormsg = "Profile not updated !!";
	}
}


//Complaint Remarks
if (isset($_POST['submitRemark'])) {
	$complaintremark = ucfirst(strtolower($_POST['complaintremark']));
	$complaintNumber = $_POST['complaintNumber'];
	$rmUser = $_POST['rmUser'];
	$status = $_POST['status'];
	$replay = '0';
	$query = mysqli_query($db, "insert into complaintremark(compNum,status,remark,rmUser) values('$complaintNumber','$status','$complaintremark','$rmUser')");
	$query = mysqli_query($db, "update tblcomplaints set replay='$replay' where complaintNumber='$complaintNumber'");
	if ($query) {
		$_SESSION['response'] = "Remark Submited Successfully Complaint Number is : $complaintNumber and status is $status  ";
		$_SESSION['res_type'] = "success";
	} else {
		$errormsg = "Profile not updated !!";
	}
}


//User	Change Password	Change

if (isset($_POST['changepassword'])) {
	$newpassword = md5($_POST['newPassword']);
	$uid = $_SESSION['UserId'];
	$query = mysqli_query($db, "update users set password='$newpassword' where id='$uid' ");
	if ($query) {
		$_SESSION['response'] = "Your Password Updated Sucessfully ";
		$_SESSION['res_type'] = "success";
		header("location:dashbord.php");
	} else {
		$errormsg = "passowrd  not updated !!";
	}
}
