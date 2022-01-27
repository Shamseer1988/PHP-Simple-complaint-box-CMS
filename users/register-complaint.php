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
        <h3 class="main-title"><i class="text-light"></i>Register Your Complaint</h3>
        <hr>
        <?php include("includes/sidebar.php"); ?>
        <form class="row g-3 mt-4 custom-form" method="post" name="complaint" enctype="multipart/form-data">
          <div class="row mb-3">
            <label for="products" class="col-sm-2 form-label col-form-label-sm">Select Product :</label>
            <div class="col-sm-3">
              <select name="products" id="products" class="form-select" required="">
                <option value="">Select Product</option>
                <?php $sql = mysqli_query($db, "select 	prductId,productName from products ");
                while ($rw = mysqli_fetch_array($sql)) { ?>
                  <option value="<?php echo htmlentities($rw['prductId']); ?>"> <?php echo htmlentities($rw['productName']); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <label for="complaintype" class="col-sm-2 form-label col-form-label-sm">Compalint Type :</label>
            <div class="col-sm-3">
              <select name="complaintype" id="complaintype" class="form-select" required="">
                <option value=" Complaint"> Complaint</option>
                <option value="General Query">General Query</option>
              </select>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <label for="nature" class=" col-sm-2 form-label">Nature of Complaint :</label>
            <div class="col-sm-3">
              <input type="text" name="nature" class="form-control" id="nature">
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <label for="nature" class=" col-sm-2 form-label">Complaint Details (max 500 words) :</label>
            <div class="col-sm-6">
              <textarea maxlength="500" name="complaindetails" required="required" cols="5" rows="10" class="form-control" maxlength="1000"> </textarea>
            </div>
          </div>
          <hr>
          <div class="row mb-3">
            <label for="compfile" class="col-sm-2 form-label">Complaint Related Doc(if any)</label>
            <div class="col-sm-6">
              <input name="compfile" class="form-control" type="file" id="compfile" value="">
            </div>
          </div>
          <hr>
          <div class="col-12 text-center">
            <button name="submitcomplaint" type="submit" class="btn btn-primary ">SUBMIT</button>
          </div>
        </form>
      </div>
    </section>


  </body>

  </html>
<?php } ?>