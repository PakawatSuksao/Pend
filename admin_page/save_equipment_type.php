


<?php
include('../connect/conn.php');
session_start();

$msg = "";
// Get image name
$image = $_FILES['image']['name'];
// Get text
$name = $_POST['name'];

// image file directory
$target = "../images/" . basename($image);
$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check !== false) {
    $_SESSION['yim_equiptype'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
    $uploadOk = 1;
    header("Location: equipment_type_manage.php");
} else {
    $_SESSION['nim_equiptype'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
    $uploadOk = 0;
    header("Location: equipment_type_manage.php");
}
if ($_FILES["image"]["size"] > 50000000) {
    $_SESSION['nz_equiptype'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
    $uploadOk = 0;
    header("Location: equipment_type_manage.php");
}
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $_SESSION['nt_equiptype'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
    $uploadOk = 0;
    header("Location: equipment_type_manage.php");
}
if ($uploadOk == 0) {
    $_SESSION['nu_equiptype'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
    header("Location: equipment_type_manage.php");
    // if everything is ok, try to upload file
} else {



    $check_name = "
	SELECT  equipment_type_name
	FROM equipment_type
	WHERE equipment_type_name = '$name' 
	";

    $result1 = mysqli_query($conn, $check_name);
    $num1 = mysqli_num_rows($result1);
    if ($num1 > 0) {
        $_SESSION['equiptypealready'] = "ข้อมูลซ้ำ";
        header("Location: equipment_type_manage.php");
    } else {

        $sql = "INSERT INTO equipment_type (equipment_type_name,image) 
        values ('$name','$image')";
        // execute query
        mysqli_query($conn, $sql);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $_SESSION['addequiptypesuc'] = "เพิ่มข้อมูลสำเร็จ";
            header("Location: equipment_type_manage.php");
        } else {
            $msg = "Failed to upload image";
        }
    }
}




?>