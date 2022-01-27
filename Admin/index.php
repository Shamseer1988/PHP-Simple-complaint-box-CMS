<?php
session_start();
error_reporting(0);
include("includes/config.php");
include("includes/action.php");
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shamseer M</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="js/jquery.flipster.min.css">
</head>

<body class="login-pg flex flex-column ">

    <!-- blue circle background -->
    <div class=" ball login   position-absolute wow zoomIn  rounded-circle ">
    </div>


    <!-- logo name -->
    <div class="position-absolute top-0 start-0 p-3">
        <a href="" class="text-decoration-none fw-bold fs-5">Shamseer.</a>
    </div>

    <!-- Login Section -->
    <div class="container login__form active">
        <div class="row vh-100 w-100 align-self-center">
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder">WELCOME BACK <small>Admin Portal</small> </h3>
                        <!-- form login section -->
                        <span style="padding-left:4%; padding-top:2%;  color:red">
                            <?php if ($errormsg) {
                                echo htmlentities($errormsg);
                            } ?></span>

                        <span style="padding-left:4%; padding-top:2%;  color:red">
                            <?php if ($locked) {
                                echo htmlentities($locked);
                            } ?></span>
                        <span style="padding-left:4%; padding-top:2%;  color:red">
                            <?php if ($msg) {
                                echo htmlentities($msg);
                            } ?></span>



                        <form action="" method="post" class="mt-5">
                            <div class="mb-3">
                                <label for="admin_email" class="form-label text-light">Email</label>
                                <input type="email" name="admin_email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter  p-2" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="admin_password" class="form-label text-light">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="admin_password" class="form-control  auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter  p-2" placeholder="your password">
                                    <span class="password__icon text-primary fs-4 fw-bold fa fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="col text-center">
                                <button type="submit" name="Adminlogin" class="btn btn-outline-success text-light btn-lg rounded-pill mt-4 w-100">Login</button>
                            </div>
                        </form>

                        <p class="mt-5 text-center text-light">Or Sign in with social platforms</p>
                        <div class="row text-center">
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-light border-2 rounded-circle"><i class="fa fa-facebook fs-5"></i></a>
                            </div>
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-light border-2 rounded-circle"><i class="fa fa-linkedin fs-5"></i></a>
                            </div>
                            <div class="col mt-3">
                                <a href="" class="btn btn-outline-light border-2 rounded-circle"><i class="fa fa-twitter fs-5"></i></a>
                            </div>
                            <div class="col my-3">
                                <a href="" class="btn btn-outline-light border-2 rounded-circle"><i class="fa fa-google fs-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/user_insert_valid.js"></script>

    <!-- For Stop form submission when refreshing -->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }



        const passwordIcon = document.querySelectorAll('.password__icon')
        const authPassword = document.querySelectorAll('.auth__password')
        // change hidden password to visible password
        for (var i = 0; i < passwordIcon.length; ++i) {
            passwordIcon[i].addEventListener('click', (i) => {
                const lastArray = i.target.classList.length - 1
                if (i.target.classList[lastArray] == 'fa-eye-slash') {
                    i.target.classList.remove('fa-eye-slash')
                    i.target.classList.add('fa-eye')
                    i.currentTarget.parentNode.querySelector('input').type = 'text'
                } else {
                    i.target.classList.add('fa-eye-slash')
                    i.target.classList.remove('fa-eye')
                    i.currentTarget.parentNode.querySelector('input').type = 'password'
                }
            });
        }
    </script>
</body>



</html>