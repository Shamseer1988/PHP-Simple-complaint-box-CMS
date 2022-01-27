<?php
session_start();

include("includes/config.php");
$_SESSION['admin_Email'] == "";
session_unset();
header("location: ../index.html");
