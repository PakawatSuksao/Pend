<?php
session_start();
include('../connect/conn.php');
if (isset($_POST['updatetypebtn'])) {
    $id = $_POST['updatetype_id'];
    $name = $_POST['name'];
    $check_brand = "
	SELECT  *
	FROM stadium_type
	WHERE stadium_type_name = '$name' and stadium_type_id != '$id'
	";

    $result = mysqli_query($conn, $check_brand);
    $num = mysqli_num_rows($result);
    echo $num;
    if ($num > 0) {
        $_SESSION['stadiumtypealready'] = "ประเภทสนามซ้ำ";
        header('Location: stadium_type_manage.php');
    } else {
        $query = "UPDATE stadium_type SET stadium_type_name = '$name' where stadium_type_id='$id'";
        $query_run = mysqli_query($conn, $query);


        if ($query_run) {
            $_SESSION['updatestadiumtypesuc'] = "เเก้ไขข้อมูลเรียบร้อยแล้ว";
            header('Location: stadium_type_manage.php');
        } else {
            $_SESSION['updatesterr'] = "ไม่มีการเเก้ไขข้อมูล";
        }
    }
}
?>
<?php
include('../connect/conn.php');
if (isset($_POST['updatestbtn'])) {
    $id = $_POST['updatest_id'];
    $name = $_POST['name'];
    $stadium_type_id = $_POST['stadium_type_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $people = $_POST['people'];
    $location = $_POST['location'];
    $status = $_POST['status'];
    
    
    $check_stadium = "
	SELECT  stadium_name,stadium_type_id
	FROM stadium
	WHERE stadium_name = '$name' and stadium_type_id = '$stadium_type_id' and stadium_id != '$id'
	";

    $result3 = mysqli_query($conn, $check_stadium);
    $num3 = mysqli_num_rows($result3);
    if ($num3 > 0) {
        $_SESSION['stadiumalready'] = "ชื่อสนามสนามภายในประเภทเดียวกันซ้ำ";
        header("Location: stadium_manage.php");
    } else {
        $query = "UPDATE stadium SET stadium_name = '$name' , stadium_type_id = '$stadium_type_id' , start_time = '$start_time' 
        , end_time = '$end_time' , people = '$people' , location = '$location' , status = '$status'
        where stadium_id='$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['updatestadiumsuc'] = "เเก้ไขข้อมูลเรียบร้อยแล้ว";
            header('Location: stadium_manage.php');
        } else {
            $_SESSION['updatestadiumerr'] = "ไม่มีการเเก้ไขข้อมูล";
        }
    }
}
?>

<?php

include('../connect/conn.php');
if (isset($_POST['upload'])) {
    $id = $_POST['updatetype_id'];
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $_SESSION['yim_stadiumtype'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
        $uploadOk = 1;
        header('Location: stadium_type_manage.php');
    } else {
        $_SESSION['nim_stadiumtype'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
        $uploadOk = 0;
        header('Location: stadium_type_manage.php');
    }
    if ($_FILES["image"]["size"] > 50000000) {
        $_SESSION['nz_stadiumtype'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
        $uploadOk = 0;
        header('Location: stadium_type_manage.php');
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['nt_stadiumtype'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
        header('Location: stadium_type_manage.php');
    }
    if ($uploadOk == 0) {
        $_SESSION['nu_stadiumtype'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
        header('Location: stadium_type_manage.php');
        // if everything is ok, try to upload file
    } else {
        $sql = "UPDATE stadium_type SET image = '$image' where stadium_type_id='$id'";
        // execute query
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION['updatestadiumtypesuc'] = "อัพโหลดรูปภาพประเภทสนามกีฬาสำเร็จ";
                header('Location: stadium_type_manage.php');
            } else {
                $_SESSION['addmembererr'] = "อัพโหลดรูปภาพไม่สำเร็จ";
               
            }
        }
    }
}
?>

<?php

include('../connect/conn.php');
if (isset($_POST['upload_st'])) {
    $id = $_POST['update_id'];
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $_SESSION['yim_stadium'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
        $uploadOk = 1;
        header('Location: stadium_manage.php');
    } else {
        $_SESSION['nim_stadium'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
        $uploadOk = 0;
        header('Location: stadium_manage.php');
    }
    if ($_FILES["image"]["size"] > 50000000) {
        $_SESSION['nz_stadium'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
        $uploadOk = 0;
        header('Location: stadium_manage.php');
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['nt_stadium'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
        header('Location: stadium_manage.php');
    }
    if ($uploadOk == 0) {
        $_SESSION['nu_stadium'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
        header('Location: stadium_manage.php');
        // if everything is ok, try to upload file
    } else {
        $sql = "UPDATE stadium SET image = '$image' where stadium_id='$id'";
        // execute query
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION['uploadstadiumsuc'] = "อัพโหลดรูปภาพสนามกีฬาสำเร็จ";
                header('Location: stadium_manage.php');
            } else {
                $_SESSION['addmembererr'] = "อัพโหลดรูปภาพไม่สำเร็จ";
               
            }
        }
    }
}
?>