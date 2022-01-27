<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['admin_Email']) == 0) {
    header('location:index.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Complaint History</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />
    </head>

    <body class="login-pg">
        <section class="container-fluid custom-bg">
            <div class="wrapper">
                <h3 class="main-title">Your Complaint History</h3>
                <?php include("includes/sidebar.php"); ?>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button bg-dark btn-warning text-light  text-uppercase  d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Not Yet Proceed
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table id="data-table" class=" table table-striped table-hover table-dark table-responsive ">
                                        <thead>
                                            <tr align="center">
                                                <th class="bg-success" scope="col">Complaint Number</th>
                                                <th class="bg-success" scope="col">Reg Date</th>
                                                <th class="bg-success" scope="col">last Updation date</th>
                                                <th class="bg-success" scope="col">Status</th>
                                                <th class="bg-success" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $query = mysqli_query($db, "select * from tblcomplaints where  status is null");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td scope="row" align="center">
                                                        <?php echo htmlentities($row['complaintNumber']); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['regDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['lastUpdationDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php
                                                        $status = $row['status'];
                                                        if ($status == "" or $status == "NULL") { ?>
                                                            <button type="button" class="btn btn-danger">Not Process Yet</button>
                                                        <?php }
                                                        if ($status == "in Process") { ?>
                                                            <button type="button" class="btn btn-warning">In Process</button>
                                                        <?php }
                                                        if ($status == "closed") {
                                                        ?>
                                                            <button type="button" class="btn btn-success">Closed</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>">
                                                            <button type="button" class="btn btn-primary">View Details</button></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item  ">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed bg-dark btn-warning text-light text-uppercase   collapsed    d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Under Processing
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table id="data-table1" class=" table table-striped table-hover table-dark table-responsive ">
                                        <thead>
                                            <tr align="center">
                                                <th class="bg-success" scope="col">Complaint Number</th>
                                                <th class="bg-success" scope="col">Reg Date</th>
                                                <th class="bg-success" scope="col">last Updation date</th>
                                                <th class="bg-success" scope="col">Status</th>
                                                <th class="bg-success" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $status = "in Process";
                                            $query = mysqli_query($db, "select * from tblcomplaints where  status   = '$status'");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td scope="row" align="center">
                                                        <?php echo htmlentities($row['complaintNumber']); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['regDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['lastUpdationDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php
                                                        $status = $row['status'];
                                                        if ($status == "" or $status == "NULL") { ?>
                                                            <button type="button" class="btn btn-danger">Not Process Yet</button>
                                                        <?php }
                                                        if ($status == "in Process") { ?>
                                                            <button type="button" class="btn btn-warning">In Process</button>
                                                        <?php }
                                                        if ($status == "closed") {
                                                        ?>
                                                            <button type="button" class="btn btn-success">Closed</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>">
                                                            <button type="button" class="btn btn-primary">View Details</button></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button bg-dark btn-warning text-light collapsed text-uppercase   d-block text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Closed
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table id="data-table2" class=" table table-striped table-hover table-dark table-responsive ">
                                        <thead>
                                            <tr align="center">
                                                <th class="bg-success" scope="col">Complaint Number</th>
                                                <th class="bg-success" scope="col">Reg Date</th>
                                                <th class="bg-success" scope="col">last Updation date</th>
                                                <th class="bg-success" scope="col">Status</th>
                                                <th class="bg-success" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $status = "closed";
                                            $query = mysqli_query($db, "select * from tblcomplaints where  status   = '$status'");
                                            while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                                <tr>
                                                    <td scope="row" align="center">
                                                        <?php echo htmlentities($row['complaintNumber']); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['regDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php echo date("d-m-Y h:i A", strtotime($row['lastUpdationDate'])); ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <?php
                                                        $status = $row['status'];
                                                        if ($status == "" or $status == "NULL") { ?>
                                                            <button type="button" class="btn btn-danger">Not Process Yet</button>
                                                        <?php }
                                                        if ($status == "in Process") { ?>
                                                            <button type="button" class="btn btn-warning">In Process</button>
                                                        <?php }
                                                        if ($status == "closed") {
                                                        ?>
                                                            <button type="button" class="btn btn-success">Closed</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td scope="row" align="center">
                                                        <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']); ?>">
                                                            <button type="button" class="btn btn-primary">View Details</button></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "lengthMenu": [
                        [5, 10, 25, -1],
                        [5, 10, 25, "All"]
                    ],
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#data-table1').DataTable({
                    "lengthMenu": [
                        [5, 10, 25, -1],
                        [5, 10, 25, "All"]
                    ],
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#data-table2').DataTable({
                    "lengthMenu": [
                        [5, 10, 25, -1],
                        [5, 10, 25, "All"]
                    ],
                });
            });
        </script>
    </body>

    </html>
<?php } ?>