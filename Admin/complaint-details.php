<?php session_start();
error_reporting(0);
include('includes/config.php');
include('includes/action.php');
if (strlen($_SESSION['admin_Email']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
  </head>

  <body class="login-pg">
    <section class="container-fluid custom-bg">
      <div class="wrapper">
        <p class="main-title">Complaint Detailes</p>
        <div class="col-sm-8 offset-sm-2">
          <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible  text-center" role="alert">
              <?php echo $_SESSION['response']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php  } ?>
          <?php unset($_SESSION['response']); ?>
          <?php unset($_SESSION['res_type']); ?>
        </div>
        <hr>
        <?php include("includes/sidebar.php"); ?>
        <div class="container">

          <?php $query = mysqli_query($db, "SELECT tblcomplaints.*, products.*,users.name	AS	userName FROM tblcomplaints LEFT JOIN products ON products.prductId = tblcomplaints.product LEFT JOIN	users	ON	users.id	=	tblcomplaints.userId  where  complaintNumber='" . $_GET['cid'] . "'");
          while ($row = mysqli_fetch_array($query)) {
            $complaintNumber  = $row['complaintNumber'];
            $username = $row['userName'];
          ?>
            <p class="text-uppercase  fw-bold ">user name : <?php echo htmlentities($row['userName']); ?></p>
            <table class="table text-center table-bordered table-info table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Complaint Number</th>
                  <th scope="col">Reg. Date</th>
                  <th scope="col">Product</th>
                  <th scope="col">Complaint Type</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td scope="row">
                    <p><?php echo $complaintNumber; ?></p>
                  </td>
                  <td>
                    <p><?php echo date("d-m-Y h:i A", strtotime($row['regDate'])); ?></p>
                  </td>
                  <td>
                    <p><?php echo htmlentities($row['productName']); ?></p>
                  </td>
                  <td>
                    <p><?php echo htmlentities($row['complaintType']); ?></p>
                  </td>
                </tr>
                <thead>
                  <th class="" scope="col" colspan="4">Complaint Detailes</th>
                </thead>
                <tr>
                  <td class="text-start" scope="row" colspan="4">
                    <p class=""> <?php echo htmlentities($row['complaintDetails']); ?></p>
                  </td>
                </tr>
                <thead>
                  <th class="" colspan="4" scope="col">Complaint Status</th>
                </thead>
                <tr>
                  <td class="" scope="row" colspan="4">
                    <?php
                    $status = $row['status'];
                    if ($status == "" or $status == "NULL") { ?>
                      <button type="button" class="btn btn-danger">Not Process Yet</button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-success"> <?php echo htmlentities($row['status']); ?></button>
                    <?php } ?>
                  </td>
                </tr>
                <thead>
                  <th class="text-start" scope="col" colspan="4">Complaint Documents</th>
                </thead>
                <tr>
                  <td class="text-start" scope="row" colspan="2">
                    <p>
                      <?php $cfile = $row['complaintFile'];
                      if ($cfile == "" || $cfile == "NULL") {
                        echo htmlentities("File NA");
                      } else { ?>
                        <a target="_blank" href="../users/complaintdocs/<?php echo htmlentities($row['complaintFile']); ?>"> View File</a>
                    </p>
                  <?php } ?>
                  </td>
                  <?php if ($row['status'] == "closed") { ?>
                    <td class="text-center" scope="row" colspan="1">
                      <button type="button" class="btn btn-secondary comp_remark  ">Re Open</button>
                    </td>
                    <td class="text-center" scope="row" colspan="1">
                      <button type="button" class="user_view_btn btn btn-success  ">View User</button>
                    </td>
                  <?php  } else { ?>
                    <td class="text-center" scope="row" colspan="1">
                      <button type="button" class="btn btn-primary comp_remark  ">Take Action</button>
                    </td>
                    <td class="text-center" scope="row" colspan="1">
                      <button type="button" class="user_view_btn btn btn-success  ">View User</button>
                    </td>
                  <?php } ?>
                </tr>
              </tbody>
            </table>
            <?php
            $status = $row['status'];
            if ($status == "" or $status == "NULL") {
            } else { ?>
              <table id="data-table" class="table text-center table-bordered table-info table-striped table-hover">
                <thead>
                  <th class="text-center col-sm-2" scope="col" colspan="">From</th>
                  <th class="text-center" scope="col" colspan="">Complaint Remarks</th>
                  <th class="text-center col-sm-3" scope="col" colspan="">Remark Date</th>
                  <th class="text-center col-sm-2" scope="col" colspan="">status</th>
                </thead>
                <tbody>
                  <?php
                  $ret = mysqli_query($db, "select complaintremark.id as remarkId, complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate,complaintremark.rmUser as rmUser from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.compNum where complaintremark.compNum='" . $_GET['cid'] . "'ORDER BY remarkId DESC");
                  while ($row = mysqli_fetch_array($ret)) { ?>
                    <tr>
                      <td class="col-sm-2 text-start" scope="row" colspan="">
                        <p class=""> <?php echo htmlentities($row['rmUser']); ?></p>
                      </td>
                      <td class="text-start" scope="row" colspan="">
                        <p class=""> <?php echo htmlentities($row['remark']); ?></p>
                      </td>
                      <td class="col-sm-3" scope="row" colspan="">
                        <p class=""> <?php echo date("d-m-Y h:i A", strtotime($row['rdate'])); ?></p>
                      </td>
                      <td class="col-sm-2" scope="row" colspan="">
                        <p class=""> <?php echo htmlentities($row['sstatus']); ?></p>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php   }  ?>
          <?php  } ?>
        </div>
      </div>
    </section>

    <!-- Modal for Reamrk -->
    <div class="modal fade " id="comp_remark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title main-title" id="staticBackdropLabel">Complaint Remark</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 mt-4 custom-form" method="post" name="remark" enctype="multipart/form-data">
              <input type="hidden" name="complaintNumber" value="<?php echo $complaintNumber; ?>"></input>
              <?php $query = mysqli_query($db, "select adminName from admin where id = " . $_SESSION['adminId'] . " ");
              while ($row = mysqli_fetch_array($query)) { ?>
                <input type="hidden" name="rmUser" value="  <?php echo htmlentities($row['adminName']); ?>"></input>
              <?php } ?>
              <div class="row mb-3">
                <div class="col-sm-3 text-dark text-capitalize">Complint Number :</div>
                <div class="col-sm-3">
                  <p class="text-dark"> <?php echo $complaintNumber; ?></p>
                </div>
              </div>
              <div class="row mb-3">
                <label for=" remarkStatus" class="col-sm-3 form-label col-form-label-sm text-dark text-capitalize">Compalint Status :</label>
                <div class="col-sm-3">
                  <select name="remarkStatus" id="remarkStatus" class="form-select" required>
                    <option value="in Process"> In Process</option>
                    <option value="closed">Closed</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3 text-dark text-capitalize">Replay on/Off :</div>
                <div class="col-sm-3">
                  <div class="form-check form-switch">
                    <input class="form-check-input" value='1' name="replay" type="checkbox" id="replay">
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nature" class=" col-sm-3 form-label text-dark text-capitalize">Complaint Details (max 200 words) :</label>
                <div class="col-sm-6">
                  <textarea maxlength="200" name="complaintremark" required="required" cols="5" rows="5" class="form-control" maxlength="1000" required> </textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button name="submitRemark" type="submit" class="btn btn-primary ">SUBMIT</button>
          </div>
        </div>
        </form>
      </div>
    </div>


    <!-- User detailes Modal -->
    <div class="modal fade " id="user_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title main-title" id="staticBackdropLabel">User detailes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php $query = mysqli_query($db, "select * from users where name =  '$username' ");
            while ($row = mysqli_fetch_array($query)) { ?>
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
            <?php } ?>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('#data-table').DataTable({
          "order": [
            [2, 'desc'],
            [2, 'desc']
          ],
          "lengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
          ],
        });
      });
    </script>

    <script>
      /* Delete Model Script */
      $(document).ready(function() {
        $('.comp_remark').click(function(e) {
          e.preventDefault();
          $('#comp_remark').modal('show');
        });
      });
    </script>
    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    </script>

    <script>
      /* Delete Model Script */
      $(document).ready(function() {
        $('.user_view_btn').click(function(e) {
          e.preventDefault();
          $('#user_view').modal('show');
        });
      });
    </script>






  </body>

  </html>
<?php } ?>