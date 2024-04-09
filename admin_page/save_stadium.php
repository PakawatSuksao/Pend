


<?php
include('../connect/conn.php');
session_start();

$msg = "";
// Get image name
$image = $_FILES['image']['name'];
// Get text
$name = $_POST['name'];
$stadium_type_id = $_POST['stadium_type_id'];
// $image = $_POST['image'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$people = $_POST['people'];
$location = $_POST['location'];
$status = 1;


//image file directory
$target = "../images/" . basename($image);
$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check !== false) {
    $_SESSION['yim_stadium'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
    $uploadOk = 1;
    header("Location: stadium_manage.php");
} else {
    $_SESSION['nim_stadium'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
    $uploadOk = 0;
    header("Location: stadium_manage.php");
}
if ($_FILES["image"]["size"] > 50000000) {
    $_SESSION['nz_stadium'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
    $uploadOk = 0;
    header("Location: stadium_manage.php");
}
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $_SESSION['nt_stadium'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
    $uploadOk = 0;
    header("Location: stadium_manage.php");
}
if ($uploadOk == 0) {
    $_SESSION['nu_stadium'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
    header("Location: stadium_manage.php");
    // if everything is ok, try to upload file
} else {



    $check_name = "
	SELECT  stadium_name
	FROM stadium
	WHERE stadium_name = '$name' 
	";

    $result1 = mysqli_query($conn, $check_name);
    $num1 = mysqli_num_rows($result1);
    if ($num1 > 0) {
        $_SESSION['stadiumalready'] = "ข้อมูลสนามกีฬาซ้ำ";
        header("Location: stadium_manage.php");
    } else {

        $sql = "INSERT INTO stadium (stadium_name,stadium_type_id,image,start_time,end_time,people,location,status) 
        values ('$name','$stadium_type_id','$image','$start_time','$end_time','$people','$location','$status')";
        // execute query
        mysqli_query($conn, $sql);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $_SESSION['addstadiumsuc'] = "เพิ่มข้อมูลสนามกีฬาสำเร็จ";
            header("Location: stadium_manage.php");
        } else {
            $msg = "ไม่สามารถอัพโหลดรูปภาพได้";
        }
    }
}


?>