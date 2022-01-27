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
                <p class="main-title">Create Products</p>
                <?php include("includes/sidebar.php"); ?>
                <div class="container">
                    <form class="row g-3 mt-4 custom-form" method="post" name="remark" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-sm-3 text-light text-capitalize">Product Name :</div>
                            <div class="col-sm-3">
                                <input type="text" name="products" class="form-control" id="product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nature" class=" col-sm-3 form-label text-light text-capitalize">Product Description (max 200 words) :</label>
                            <div class="col-sm-6">
                                <textarea maxlength="250" name="productDesc" required="required" cols="5" rows="3" class="form-control" maxlength="1000" required> </textarea>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button name="createProduct" type="submit" class="btn btn-primary ">SUBMIT</button>
                        </div>
                    </form>
                    <br>
                    <p class="main-title">Product History</p>
                    <div class="table-responsive">
                        <table id="data-table" class="text-start table table-striped table-hover table-dark table-responsive ">
                            <thead>
                                <tr align="center">
                                    <th class="bg-success" scope="col">Sl No</th>
                                    <th class="bg-success" scope="col">Product Name</th>
                                    <th class="bg-success" scope="col">Product Desc</th>
                                    <th class="bg-success" scope="col">Created Date</th>
                                    <th class="bg-success" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $query = mysqli_query($db, "select * from products ");
                                while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td scope="row " class="product_id" align="center">
                                            <?php echo htmlentities($row['prductId']); ?>
                                        </td>
                                        <td scope="row" align="start">
                                            <?php echo htmlentities($row['productName']); ?>
                                        </td>
                                        <td scope="row" align="start">
                                            <?php echo htmlentities($row['productDescription']); ?>
                                        </td>
                                        <td scope="row" align="start">
                                            <?php echo htmlentities($row['productRegDate']); ?>
                                        </td>
                                        <td scope="row" align="center">
                                            <a href="">
                                                <i class="fas fa-trash-alt pe-3 text-danger product_delete"></i></a>
                                            <a href="">
                                                <i class="fas fa-edit pe-3 text-warning edit_Product"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- Disable User -->
        <div class="modal fade" id="edit_Product" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  ">
                        <form class="row g-3 mt-4 custom-form" method="post" name="remark" enctype="multipart/form-data">
                            <input type="hidden" name="Product_id" class="form-control " id="Product_id">
                            <div class="row mb-3">
                                <div class="col-sm-3 text-dark text-capitalize">Product Name :</div>
                                <div class="col-sm-6">
                                    <input type="text" name="editProducts" class="form-control" id="Product_name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nature" class=" col-sm-3 form-label text-dark text-capitalize">Product Description (max 200 words) :</label>
                                <div class="col-sm-6">
                                    <textarea maxlength="250" name="editProductDesc" required="required" cols="5" rows="3" class="form-control" maxlength="1000" id="productDes" required> </textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button name="updateProduct" type="submit" class="btn btn-primary ">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete_product" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="text-center text-justify text-capitalize font-weight-bold  text-danger">Are You Sure Delete Selected Product ?? </h5>
                        <form method="POST" action="">
                            <input type="hidden" name="del_Product_id" class="form-control" id="delete_product_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>






        <script>
            /* Edit Product Script */
            $(document).ready(function() {
                $('.edit_Product').click(function(e) {
                    e.preventDefault();
                    var Product_id = $(this).closest('tr').find('.product_id').text();
                    $.ajax({
                        type: "POST",
                        url: "includes/action.php",
                        data: {
                            'product_editbtn': true,
                            'Product_id': Product_id,
                        },
                        success: function(response) {
                            var obj = $.parseJSON(response);
                            $('#Product_id').val(obj.prductId);
                            $('#Product_name').val(obj.productName);
                            $('#productDes').val(obj.productDescription);
                            $('#edit_Product').modal('show');
                        }
                    });
                });
            });
        </script>
        <script>
            /* Delete Model Script */
            $(document).ready(function() {
                $('.product_delete').click(function(e) {
                    e.preventDefault();
                    var product_id = $(this).closest('tr').find('.product_id').text();
                    $('#delete_product_id').val(product_id);
                    $('#delete_product').modal('show');

                });
            });
        </script>
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
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </body>

    </html>




<?php } ?>