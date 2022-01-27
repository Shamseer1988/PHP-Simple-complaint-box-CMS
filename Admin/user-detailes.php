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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/datatables.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/datatables.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="login-pg">
        <section class="container-fluid custom-bg">
            <div class="wrapper">


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
                <p class="main-title">User detailes</p>
                <?php include("includes/sidebar.php"); ?>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-hover table-info table-responsive-sm ">
                        <thead>
                            <tr align="center">
                                <th class="bg-primary" scope="col">User Id</th>
                                <th class="bg-primary" scope="col">User Name</th>
                                <th class="bg-primary" scope="col">User Email</th>
                                <th class="bg-primary" scope="col">No Of Complaints</th>
                                <th class="bg-primary" scope="col">Reg Date</th>
                                <th class="bg-primary" scope="col">Status</th>
                                <th class="bg-primary" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $query = mysqli_query($db, "select * from users ");
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="user_id" scope="row" align="center">
                                        <?php echo htmlentities($row['id']); ?>
                                    </td>
                                    <td scope="row" align="start">
                                        <?php echo htmlentities($row['name']); ?>
                                    </td>
                                    <td scope="row" align="start">
                                        <?php echo htmlentities($row['userEmail']); ?>
                                    </td>
                                    <td scope="row" align="center">
                                        <?php $userId = $row['id'];
                                        $rt = mysqli_query($db, "SELECT * FROM tblcomplaints where userId = $userId");
                                        $num1 = mysqli_num_rows($rt); { ?>
                                            <?php echo htmlentities($num1); ?>
                                        <?php } ?>
                                    </td>
                                    <td scope="row" align="center">
                                        <?php echo htmlentities($row['CreatedDate']); ?>
                                    </td>
                                    <td scope="row" align="center">
                                        <?php if ($row['status'] == 1) { ?>
                                            <p class="text-success">Active</p>
                                        <?php  } else { ?>
                                            <p class="text-danger">Disabled</p>
                                        <?php  } ?>
                                    </td>
                                    <td scope="row" align="center">
                                        <a href="">
                                            <i class="fas fa-ban pe-3 text-danger user_disable"></i></a>
                                        <a href="">
                                            <i class="fas fa-edit pe-3 text-warning user_update"></i></a>
                                        <a href="">
                                            <i class="fas fa-eye pe-3 text-success view_btn"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        <!-- User detailes Modal -->
        <div class="modal fade " id="user_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title main-title  text-dark" id="staticBackdropLabel">User detailes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="jumbotron modal_view ">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Delete e User -->
        <div class="modal fade" id="update_user" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-start text-justify   text-warning">Kindly contact User for update Profile.<small>Thank you</small> </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Disable User -->
        <div class="modal fade" id="disable_user" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  modal_view">
                    </div>
                </div>
            </div>
        </div>





        <script>
            /* View Model Script */
            $(document).ready(function() {
                $('.view_btn').click(function(e) {
                    e.preventDefault();
                    var user_id = $(this).closest('tr').find('.user_id').text();
                    $.ajax({
                        type: "POST",
                        url: "includes/action.php",
                        data: {
                            'checking_viewbtn': true,
                            'userid': user_id,
                        },
                        success: function(response) {
                            $('.modal_view').html(response);
                            $('#user_view').modal('show');
                        }
                    });
                });
            });
        </script>

        <script>
            /* Delete Model Script */
            $(document).ready(function() {
                $('.user_update').click(function(e) {
                    e.preventDefault();
                    $('#update_user').modal('show');
                });
            });
        </script>

        <script>
            /* Disble User Script */
            $(document).ready(function() {
                $('.user_disable').click(function(e) {
                    e.preventDefault();
                    var disable_user_id = $(this).closest('tr').find('.user_id').text();
                    $.ajax({
                        type: "POST",
                        url: "includes/action.php",
                        data: {
                            'disable_userbtn': true,
                            'disable_user_id': disable_user_id,
                        },
                        success: function(response) {
                            $('.modal_view').html(response);
                            $('#disable_user').modal('show');
                        }
                    });
                });
            });
        </script>






        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    dom: 'Bfrtip',
                    buttons: {
                        buttons: [{
                                extend: 'copy',
                                className: 'copyButton'
                            },
                            {
                                extend: 'excel',
                                className: 'excelButton'
                            }, {
                                extend: 'pdf',
                                className: 'pdfButton'
                            }, {
                                extend: 'print',
                                className: 'printButton'
                            }
                        ]
                    },
                    "lengthMenu": [
                        [5, 10, 25, -1],
                        [5, 10, 25, "All"]
                    ],
                });
            });
        </script>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>



    </body>

<?php } ?>