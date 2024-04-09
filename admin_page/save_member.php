<?php

include('../connect/conn.php');
session_start();
if ($_SESSION['member_id'] == "") {
    $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header('location: ../login.php');
}

if ($_SESSION['member_type'] != "admin") {
    $_SESSION['msg'] = "หน้าสำหรับผู้ใช้";
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}



// receive all input values from the form
$Name = $_POST['name'];
$Surname = $_POST['surname'];
$Username_m =  $_POST['username'];
$Password =  $_POST['password'];
$Phone =  $_POST['phone_number'];
$Faculty =  $_POST['faculty'];
$Agency =  $_POST['agency'];
$HouseNum =  $_POST['mbHouseNum'];
$Province =  $_POST['mbProvince'];
$City =  $_POST['mbCity'];
$District =  $_POST['mbDistrict'];
$Postcode =  $_POST['mbPostcode'];
$Status =  $_POST['status'];




$user_check_query = "SELECT * FROM member WHERE username='$Username_m' LIMIT 1";
$result = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($result);


if ($user['username'] === $Username_m) {
    $_SESSION['memberalready'] = "ชื่อผู้ใช้ซ้ำ";
    header("Location: member_manage.php");
} else {
    $Password = md5($Password);
    $sql = "INSERT INTO member (firstname,surname,username,password,phone_number,faculty,agency,mbHouseNum,mbProvince,mbCity,mbDistrict,mbPostcode,member_type) 
      VALUES('$Name','$Surname','$Username_m','$Password','$Phone','$Faculty','$Agency','$HouseNum','$Province','$City','$District','$Postcode','$Status')";


    // execute query

    mysqli_query($conn, $sql);
    $_SESSION['addmembersuc'] = "เพิ่มข้อมูลสำเร็จ";
    header('location:member_manage.php');
}
