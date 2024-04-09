<?php
include('../connect/conn.php');
session_start();
if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];

    $Status = $_POST['status'];
    $Name = $_POST['name'];
    $Surname = $_POST['surname'];
    $Phone = $_POST['phone_number'];
    $status = $_POST['status'];
    $Faculty =  $_POST['faculty'];
    $Agency = $_POST['agency'];
    $HouseNum =  $_POST['mbHouseNum'];
    $Province =  $_POST['mbProvince'];
    $City =  $_POST['mbCity'];
    $District =  $_POST['mbDistrict'];
    $Postcode =  $_POST['mbPostcode']; {
        $Password = md5($Password);
        $sql = "UPDATE member SET member_type = '$Status' , firstname = '$Name' , surname = '$Surname' , phone_number = '$Phone' , faculty = '$Faculty' , agency = '$Agency' , mbHouseNum = '$HouseNum', mbProvince = '$Province', mbCity = '$City', mbDistrict = '$District', mbPostcode = '$Postcode'  where member_id='$id'";
        // execute query
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $_SESSION['updatemembersuc'] = "แก้ไขข้อมูลผู้ใช้สำเร็จ";
            header('Location: member_manage.php');
        } else {
            header('Location: intromanage.php');
        }
    }
}
