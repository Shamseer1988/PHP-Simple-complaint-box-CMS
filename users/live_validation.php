<?php
session_start();
error_reporting(0);
require_once("includes/config.php");

// Live Check Email Exit Or Not ###################3
if (isset($_POST['chkEmailBtn'])) {
     $email = $_POST['user_email'];
     if (!empty($email)) {
          $sql = "SELECT userEmail FROM users WHERE userEmail = '$email'";
          $result = $db->query($sql);
          if (!$result) {
               echo 'Something went wrong with database';
          } elseif ($result->num_rows == 1) {
               echo "1";
          } else {
               echo 'notexist';
          }
     }
}


// Chaange Password ###################3
if (isset($_POST['currentpswdBtn'])) {
     $currentpswd = md5($_POST['currentpswd']);
     $uid = $_SESSION['UserId'];
     if (!empty($currentpswd)) {
          $sql = "SELECT * FROM users WHERE password = '$currentpswd' and id = '$uid' ";
          $result = $db->query($sql);
          if (!$result) {
               echo 'Something went wrong with database';
          } elseif ($result->num_rows == 1) {
               echo "1";
          } else {
               echo 'notexist';
          }
     }
}


