<?php
session_start();
error_reporting(0);
include('includes/config.php');
include("includes/action.php");
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body class="login-pg">
    <section class="container-fluid custom-bg">
      <div class="wrapper">
        <p class="text-center main-title">Update User Data</p>
        <hr>
        <?php include("includes/sidebar.php"); ?>
        <div class="accordion" id="accordionExample">
          <div class="accordion-item bg-dark">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button bg-dark btn-warning text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Update User Profile
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <?php $query = mysqli_query($db, "select * from users where id='" . $_SESSION['UserId'] . "'");
                while ($row = mysqli_fetch_array($query)) { ?>
                  <form class="row g-3 mt-4 text-light" method="post" name="complaint" enctype="multipart/form-data">
                    <div class="row ">
                      <div class="col-sm-6">
                        <label for="userFName" class=" form-label">First Name:</label>
                        <input type="text" name="userFName" class="form-control" id="userFName" value="<?php echo htmlentities($row['userFName']); ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="userSName" class=" form-label">Second Name:</label>
                        <input type="text" name="userSName" class="form-control" id="userSName" value="<?php echo htmlentities($row['userSName']); ?>">
                      </div>
                    </div>
                    <div class="row    pt-3 ">
                      <div class="col-sm-4">
                        <label for="userDist" class=" form-label">District:</label>
                        <input type="text" name="userDist" class="form-control" id="userDist" value="<?php echo htmlentities($row['userDist']); ?>">
                      </div>
                      <div class="col-sm-4">
                        <label for="userState" class=" form-label">State:</label>
                        <input type="text" name="userState" class="form-control" id="userState" value="<?php echo htmlentities($row['userState']); ?>">
                      </div>
                      <div class="col-sm-4">
                        <label for="userCountry" class=" form-label">Country:</label>
                        <input type="text" name="userCountry" class="form-control" id="userCountry" value="<?php echo htmlentities($row['userCountry']); ?>">
                      </div>
                    </div>
                    <div class="row    pt-3 ">
                      <div class="col-sm-4">
                        <label for="userMobile" class=" form-label">Mobile:</label>
                        <input type="number" name="userMobile" class="form-control" id="userMobile" value="<?php echo htmlentities($row['userMobile']); ?>">
                      </div>
                      <div class="col-sm-4">
                        <label for="userEmail" class=" form-label">Email:</label>
                        <input disabled type="email" name="userEmail" class="form-control" id="userEmail" value="<?php echo htmlentities($row['userEmail']); ?>">
                      </div>
                      <div class="col-sm-4">
                        <label for="userCrtDate" class=" form-label">Created Date:</label>
                        <input disabled type="text" name="userCrtDate" class="form-control" id="userCrtDate" value="<?php echo htmlentities($row['CreatedDate']); ?>">
                      </div>
                    </div>
                    <div class="row    pt-3 ">
                      <div class="col-sm-6">
                        <label for="userImg" class=" form-label">Uplaod Image:</label>
                        <input type="file" name="userImg" class="form-control" id="userImg" value="<?php echo htmlentities($row['userImg']); ?>">
                      </div>
                      <div class="col-sm-6">
                        <label for="userLUpdate" class=" form-label">Last Updated:</label>
                        <input disabled type="text" name="userLUpdate" class="form-control" id="userLUpdate" value="<?php echo htmlentities($row['lastUpdationDate']); ?>">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button name="usrprofileUpdate" type="submit" class="btn btn-primary ">SUBMIT</button>
                    </div>
                  </form>
                <?php
                } ?>
              </div>
            </div>
          </div>
          <div class="accordion-item bg-dark ">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed bg-dark btn-warning text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Change Password
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <form action="" method="POST" name="changepassword">
                  <div class="row g-3 align-items-center  mb-3">
                    <div class="col-sm-2">
                      <label for="currentPassword" class="col-form-label text-light">Current Password :</label>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group mb-2">
                        <span class="input-group-text current bg-light" id=""></span>
                        <input type="password" name="currentPassword" id="currentPassword" class="form-control" aria-describedby="passwordHelpInline">
                      </div>
                      <span id="currentPass-message"></span>
                    </div>
                  </div>
                  <div class="row g-3 align-items-center  mb-3">
                    <div class="col-sm-2">
                      <label for="newPassword" class="col-form-label text-light">New Password :</label>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group mb-2">
                        <span class="input-group-text new bg-light" id=""></span>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" value="">
                        <span class="input-group-text">
                          <i class="fas fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                        </span>
                      </div>
                      <span id="newPass-message"></span>
                    </div>
                    <div class="col-auto">
                      <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters long.
                      </span>
                    </div>
                  </div>





                  <div class="row g-3 align-items-center  mb-3">
                    <div class="col-sm-2">
                      <label for="changeConfirmPswd" class="col-form-label text-light">Confirm Password :</label>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group mb-2">
                        <span class="input-group-text confirm bg-light" id=""></span>
                        <input type="password" name="changeConfirmPswd" id="changeConfirmPswd" class="form-control" aria-describedby="passwordHelpInline">
                        <span class="input-group-text">
                          <i class="fas fa-eye-slash" id="togglePassword1" style="cursor: pointer"></i>
                        </span>
                      </div>
                      <span id="confirmPass-message"></span>
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <button disabled name="changepassword" type="submit" id="changepassword" class="btn btn-primary ">SUBMIT</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script>
      const togglePassword = document.querySelector("#togglePassword");
      const newpassword = document.querySelector("#newPassword");

      togglePassword.addEventListener("click", function() {
        // toggle the type attribute
        const type = newpassword.getAttribute("type") === "password" ? "text" : "password";
        newpassword.setAttribute("type", type);
        // toggle the eye icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });

      const togglePassword1 = document.querySelector("#togglePassword1");
      const confirmpassword = document.querySelector("#changeConfirmPswd");
      togglePassword1.addEventListener("click", function() {
        // toggle the type attribute
        const type = confirmpassword.getAttribute("type") === "password" ? "text" : "password";
        confirmpassword.setAttribute("type", type);
        // toggle the eye icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/changepswd_valid.js"></script>
  </body>

  </html>
<?php } ?>