<?php
include('../includes/config.php');
session_start();
error_reporting(0);


//User Login 
if (isset($_POST['Adminlogin'])) {
	$ret = mysqli_query($db, "SELECT * FROM admin WHERE adminEmail='" . $_POST['admin_email'] . "' and password='" . $_POST['admin_password'] . "'");
	$num = mysqli_fetch_array($ret);

	if ($num["status"] == "0") {
		$locked = "Your Account is Disabled Contact Admin ";
	} else if ($num["status"] == "1") {
		$_SESSION['admin_Email'] = $_POST['admin_email'];
		$_SESSION['adminId'] = $num['id'];
		header("location: dashbord.php");
		exit();
	} else {
		$errormsg = "Invalid username or password";
	}
}


//Complaint Remarks
if (isset($_POST['submitRemark'])) {
	$remarkStatus = $_POST['remarkStatus'];
	$complaintremark = ucfirst(strtolower($_POST['complaintremark']));
	$complaintNumber = $_POST['complaintNumber'];
	$rmUser = $_POST['rmUser'];
	$replay = $_POST['replay'];
	$query = mysqli_query($db, "insert into complaintremark(compNum,status,remark,rmUser) values('$complaintNumber','$remarkStatus','$complaintremark','$rmUser')");
	$query = mysqli_query($db, "update tblcomplaints set status='$remarkStatus',replay='$replay' where complaintNumber='$complaintNumber'");
	if ($query) {
		$_SESSION['response'] = "Remark Submited Successfully Complaint Number is : $complaintNumber and status is $remarkStatus  ";
		$_SESSION['res_type'] = "success";
	} else {
		$errormsg = "Profile not updated !!";
	}
}



//Create Products
if (isset($_POST['createProduct'])) {
	$prdName = strtoupper($_POST['products']);
	$prddesc = ucfirst(strtolower($_POST['productDesc']));
	$query = mysqli_query($db, "insert into products(productName,productDescription) values('$prdName','$prddesc')");

	if ($query) {
		$_SESSION['response'] = "Product Created Name : $prdName ";
		$_SESSION['res_type'] = "success";
	} else {
		$errormsg = "Profile not updated !!";
	}
}



//Disable User	Action
if (isset($_POST['Disable_user'])) {
	$user_id = $_POST['disable_user'];
	$user_status = $_POST['user_status'];

	$query = mysqli_query($db, "update users set status='$user_status' where id='$user_id'");
	if ($query) {
		if ($user_status == 1) {
			$_SESSION['response'] = "User Successfully Activated User Id is : $user_id ";
			$_SESSION['res_type'] = "success";
		} else {
			$_SESSION['response'] = "User Successfully Deactivated User Id is : $user_id ";
			$_SESSION['res_type'] = "warning";
		}
	} else {
		$errormsg = "Profile not updated !!";
	}
}


//Fetch Data in To User Popup View ......
if (isset($_POST['checking_viewbtn'])) {
	$user_id = $_POST['userid'];
	$query = mysqli_query($db, "select * from users where id = $user_id ");
	while ($row = mysqli_fetch_array($query)) {  ?>
		<table class="table-bordered table   table-info ">
			<tbody>
				<tr class="">
					<th class="col-sm-4 ">
						<p>User Id </p>
					</th>
					<td>
						<p class=""> <?php echo htmlentities($row['id']); ?></p>
					</td>
				</tr>
				<tr>
					<th class="col-sm-4">User Name </th>
					<td>
						<p class=""> <?php echo htmlentities($row['name']); ?></p>
					</td>
				</tr>
				<tr>
					<th class="col-sm-4">User Email </th>
					<td>
						<p class=""> <?php echo htmlentities($row['userEmail']); ?></p>
					</td>
				</tr>
				<tr>
					<th class="col-sm-4">User Created Date </th>
					<td>
						<?php echo date("d-m-Y h:i A", strtotime($row['CreatedDate'])); ?>
					</td>
				</tr>
				<tr>
					<th class="col-sm-4">User Mobile </th>
					<td>
						<?php echo htmlentities($row['userMobile']); ?>
					</td>
				</tr>
				<tr>
					<th class="col-sm-4">User Status </th>
					<td>
						<?php if ($row['status'] == 1) { ?>
							<p>Active User</p>
						<?php  } else { ?>
							<p>Disabled User</p>
						<?php  } ?>
					</td>
				</tr>
			</tbody>
		</table>
	<?php    }
}



//DisableUser Popup View ......
if (isset($_POST['disable_userbtn'])) {
	$disable_user_id = $_POST['disable_user_id'];
	$query = mysqli_query($db, "select * from users where id = $disable_user_id ");
	while ($row = mysqli_fetch_array($query)) {  ?>
		<form method="POST" action="">
			<input type="hidden" name="disable_user" value="<?php echo	$row['id']	?>">
			<?php $status = $row['status'];
			if ($status == 0) { ?>
				<div class="row mb-2">
					<div class="col-sm-4 "> Active User :</div>
					<div class="col-sm-2">
						<div class="form-check form-switch">
							<input class="form-check-input" value='1' name="user_status" type="checkbox" id="user_status">
						</div>
					</div>
				</div>
			<?php    } else { ?>
				<div class="row mb-2">
					<div class="col-sm-4 "> Deactive User :</div>
					<div class="col-sm-2">
						<div class="form-check form-switch">
							<input class="form-check-input" value='0' name="user_status" type="checkbox" id="user_status">
						</div>
					</div>
				</div>
			<?php }	?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" name="Disable_user" class="btn btn-primary">Save changes</button>
		</form>
<?php    }
}
//Edit Products  Popup View ......
if (isset($_POST['product_editbtn'])) {
	$Product_id = $_POST['Product_id'];
	$query = mysqli_query($db, "select * from products where prductId = $Product_id ");
	$arr_data = array();
	while ($row = mysqli_fetch_array($query)) {
		$arr_data['prductId'] = $row['prductId'];
		$arr_data['productName'] = $row['productName'];
		$arr_data['productDescription'] = $row['productDescription'];
	}
	echo json_encode($arr_data);
}


////Edit Products  Action
if (isset($_POST['updateProduct'])) {
	$Product_id = $_POST['Product_id'];
	$product_name = strtoupper($_POST['editProducts']);
	$product_Desc = ucfirst(strtolower($_POST['editProductDesc']));

	$query = mysqli_query($db, "update products set productName='$product_name' , productDescription= '$product_Desc' where prductId='$Product_id'");
	if ($query) {
		$_SESSION['response'] = "Product Successfully Updated Id is : $Product_id ";
		$_SESSION['res_type'] = "success";
	} else {
		$errormsg = "Profile not updated !!";
	}
}





//Delete Product ......
if (isset($_POST['delete_product'])) {
	$product_id = $_POST['del_Product_id'];
	$query = mysqli_query($db, "DELETE FROM products WHERE prductId ='$product_id'");
	if ($query) {
		$_SESSION['response'] = "Product deleted Successfully  ";
		$_SESSION['res_type'] = "danger";
	} else {
		$errormsg = "Profile not updated !!";
	}
}
?>