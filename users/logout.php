<?php
session_start();

include("includes/config.php");
$_SESSION['login'] == "";
session_unset();
header("location: ../index.html");
