


<?php
include('../connect/conn.php');
session_start();

$msg = "";
// Get image name
$image = $_FILES['image']['name'];
// Get text
$name = $_POST['name'];
$serialnumber = $_POST['serialnumber'];
$equipment_type_id = $_POST['equipment_type_id'];

// $image = $_POST['image'];

$status = 1;


//image file directory
$target = "../images/" . basename($image);
$imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check !== false) {
    $_SESSION['yim_equip'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
    $uploadOk = 1;
    header("Location: equipment_manage.php");
} else {
    $_SESSION['nim_equip'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
    $uploadOk = 0;
    header("Location: equipment_manage.php");
}
if ($_FILES["image"]["size"] > 500000) {
    $_SESSION['nz_equip'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
    $uploadOk = 0;
    header("Location: equipment_manage.php");
}
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $_SESSION['nt_equip'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
    $uploadOk = 0;
    header("Location: equipment_manage.php");
}
if ($uploadOk == 0) {
    $_SESSION['nu_equip'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
    header("Location: equipment_manage.php");
    // if everything is ok, try to upload file
} else {



    $check_name = "
	SELECT  serialnumber
	FROM equipment
	WHERE serialnumber = '$serialnumber' 
	";

    $result1 = mysqli_query($conn, $check_name);
    $num1 = mysqli_num_rows($result1);
    if ($num1 > 0) {
        $_SESSION['equipalready'] = "หมายเลขซีเรียลซ้ำ";
        header("Location: equipment_manage.php");
    } else {
        $check_stadium = "
        SELECT  equipment_name,equipment_type_id
        FROM equipment
        WHERE equipment_name = '$name' and equipment_id != '$id'
        ";

        $result3 = mysqli_query($conn, $check_stadium);
        $num3 = mysqli_num_rows($result3);
        if ($num3 > 0) {
            $_SESSION['quipalready'] = "หมายเลขซีเรียลอุปกรณ์ซ้ำ";
            header("Location: equipment_manage.php");
        } else {
            $sql = "INSERT INTO equipment (equipment_name,equipment_type_id,serialnumber,image,status) 
        values ('$name','$equipment_type_id','$serialnumber','$image','$status')";

            mysqli_query($conn, $sql);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION['addequipsuc'] = "เพิ่มข้อมูลอุปกรณ์กีฬาสำเร็จ";
                header("Location: equipment_manage.php");
            } else {
                $msg = "Failed to upload image";
            }
        }
    }
}

?>