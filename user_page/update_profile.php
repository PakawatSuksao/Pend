<?php
include('../connect/conn.php');
session_start();
if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $Name = $_POST['name'];
    $Surname = $_POST['surname'];
    $Faculty =  $_POST['faculty'];
    $Agency = $_POST['agency'];
    $Phone = $_POST['phone_number'];
    $HouseNum = $_POST['mbHouseNum'];
    $Province = $_POST['mbProvince'];
    $City = $_POST['mbCity'];
    $District = $_POST['mbDistrict'];
    $Postcode = $_POST['mbPostcode'];


    $sql = "UPDATE member SET  firstname = '$Name' , surname = '$Surname' , phone_number = '$Phone' , faculty = '$Faculty' , agency = '$Agency' , mbHouseNum = '$HouseNum' , mbProvince = '$Province' , mbCity = '$City' , mbDistrict = '$District' , mbPostcode = '$Postcode'  where member_id='$id'";
    // execute query
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $_SESSION['edit_profile_success'] = "แก้ไขข้อมูลสำเร็จ";
        header('Location: profile.php');
    } else {
        header('Location: intromanage.php');
    }
}
