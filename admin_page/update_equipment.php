<?php
session_start();
include('../connect/conn.php');
if (isset($_POST['updatetypebtn'])) {
    $id = $_POST['updatetype_id'];
    $name = $_POST['name'];
    $check_brand = "
	SELECT  *
	FROM equipment_type
	WHERE equipment_type_name = '$name' and equipment_type_id != '$id'
	";

    $result = mysqli_query($conn, $check_brand);
    $num = mysqli_num_rows($result);
    echo $num;
    if ($num > 0) {
        $_SESSION['equipalready'] = "ประเภทอุปกรณ์กีฬาซ้ำ";
        header('Location: equipment_type_manage.php');
    } else {
        $query = "UPDATE equipment_type SET equipment_type_name = '$name' where equipment_type_id='$id'";
        $query_run = mysqli_query($conn, $query);


        if ($query_run) {
            $_SESSION['equiptypesuc'] = "เเก้ไขข้อมูลประเภทอุปกรณ์กีฬาเรียบร้อยแล้ว";
            header('Location: equipment_type_manage.php');
        } else {
            $_SESSION['equiptypeerr'] = "ไม่มีการเเก้ไขข้อมูล";
        }
    }
}
?>
<?php
include('../connect/conn.php');
if (isset($_POST['updatestbtn'])) {
    $id = $_POST['updatest_id'];
    $name = $_POST['name'];
    $equipment_type_id = $_POST['equipment_type_id'];
    $serialnumber = $_POST['serialnumber'];
    $status = $_POST['status'];

    $check_serail = "
	SELECT  *
    FROM equipment
    WHERE serialnumber = '$serialnumber' and equipment_id != '$id'
	";

    $result3 = mysqli_query($conn, $check_serail);
    $num3 = mysqli_num_rows($result3);
    if ($num3 > 0) {
        $_SESSION['quipalready'] = "หมายเลขซีเรียลอุปกรณ์ซ้ำ";
        header("Location: equipment_manage.php");
    } else {

        $check_stadium = "
        SELECT  *
        FROM equipment
        WHERE equipment_name = '$name' and equipment_id != '$id'
        ";

        $result3 = mysqli_query($conn, $check_stadium);
        $num3 = mysqli_num_rows($result3);
        if ($num3 > 0) {
            $_SESSION['quipalready'] = "ข้อมูลอุปกรณ์ซ้ำ";
            header("Location: equipment_manage.php");
        } else {
            $query = "UPDATE equipment SET equipment_name = '$name' ,serialnumber = '$serialnumber' , equipment_type_id = '$equipment_type_id' , status = '$status'
            where equipment_id='$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $_SESSION['updateuquipsuc'] = "เเก้ไขข้อมูลเรียบร้อยแล้ว";
                header('Location: equipment_manage.php');
            } else {
                $_SESSION['updateuquiperr'] = "ไม่มีการเเก้ไขข้อมูล";
            }
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
        $_SESSION['yim_quiptype'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
        $uploadOk = 1;
        header('Location: equipment_type_manage.php');
    } else {
        $_SESSION['nim_quiptype'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
        $uploadOk = 0;
        header('Location: equipment_type_manage.php');
    }
    if ($_FILES["image"]["size"] > 50000000) {
        $_SESSION['nz_quiptype'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
        $uploadOk = 0;
        header('Location: equipment_type_manage.php');
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['nt_quiptype'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
        header('Location: equipment_type_manage.php');
    }
    if ($uploadOk == 0) {
        $_SESSION['nu_quiptype'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
        header('Location: equipment_type_manage.php');
        // if everything is ok, try to upload file
    } else {
        $sql = "UPDATE equipment_type SET image = '$image' where equipment_type_id='$id'";
        // execute query
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION['uploadquiptypesuc'] = "อัพโหลดรูปภาพประเภทอุปกรณ์กีฬาสำเร็จ";
                header('Location: equipment_type_manage.php');
            } else {
                $_SESSION['uloadquiptypeerr'] = "อัพโหลดรูปภาพไม่สำเร็จ";
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
        $_SESSION['yim_quip'] = "เป็นไฟล์รูปภาพ - " . $check["mime"] . ".";
        $uploadOk = 1;
        header('Location: equipment_manage.php');
    } else {
        $_SESSION['nim_quip'] = "ไฟล์ที่อัพโหลดเข้ามาไม่ใช่ ไฟล์รูปภาพ.";
        $uploadOk = 0;
        header('Location: equipment_manage.php');
    }
    if ($_FILES["image"]["size"] > 50000000) {
        $_SESSION['nz_quip'] = "ไฟล์ที่อัพโหลดมีขนาดใหญ่เกิน 5mb.";
        $uploadOk = 0;
        header('Location: equipment_manage.php');
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $_SESSION['nt_quip'] = "จำเป็นต้องมีนามสกุลไฟเป็น JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
        header('Location: equipment_manage.php');
    }
    if ($uploadOk == 0) {
        $_SESSION['nu_quip'] = "อัพโหลดไฟล์ไม่สำเร็จ.";
        header('Location: equipment_manage.php');
        // if everything is ok, try to upload file
    } else {
        $sql = "UPDATE equipment SET image = '$image' where equipment_id='$id'";
        // execute query
        $query = mysqli_query($conn, $sql);
        if ($query) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION['uploadquipsuc'] = "อัพโหลดรูปภาพอุปกร์ณกีฬาสำเร็จ";
                header('Location: equipment_manage.php');
            } else {
                $_SESSION['uploadquiperr'] = "อัพโหลดรูปภาพไม่สำเร็จ";
            }
        }
    }
}
?>