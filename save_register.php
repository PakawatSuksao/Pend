<?php

include('connect/conn.php');
session_start();



// receive all input values from the form
$firstname = $_POST['firstname'];
$Surname = $_POST['surname'];
$Username_m =  $_POST['username'];
$password_1 =  $_POST['password'];
$password_2 =  $_POST['c_password'];
$Phone =  $_POST['phone_number'];
$Faculty =  $_POST['faculty'];
$Agency =  $_POST['agency'];
$Img =  $_POST['mbImg'];
$HouseNum =  $_POST['mbHouseNum'];
$Province =  $_POST['mbProvince'];
$City =  $_POST['mbCity'];
$District =  $_POST['mbDistrict'];
$Postcode =  $_POST['mbPostcode'];
$member_type =  "user";




$user_check_query = "SELECT * FROM member WHERE username='$Username_m' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($password_1 != $password_2) {
  $_SESSION['pnotmatch'] = "รหัสผ่านไม่ตรงกัน";
  header("Location: register.php");
} else {


  if ($user['username'] == $Username_m) {
    $_SESSION['ualready'] = "ชื่อผู้ใช้ซ้ำ";
    header("Location: register.php");
  } else {
    $password_1 = md5($password_1);
    $sql = "INSERT INTO member (firstname,surname,username,password,phone_number,faculty,agency,member_type,mbHouseNum,mbProvince,mbCity,mbDistrict,mbPostcode) 
      VALUES('$firstname','$Surname','$Username_m','$password_1','$Phone','$Faculty','$Agency','$member_type','$HouseNum','$Province','$City','$District','$Postcode')";


    // execute query
    if (mysqli_query($conn, $sql)) {
      $_SESSION['register_success'] = "สมัครสมาชิกสำเร็จ";
      header("Location: login.php");
    }
  }
}
