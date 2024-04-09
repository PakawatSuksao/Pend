<?php
include('../connect/conn.php');
session_start();
$member_id = $_SESSION['member_id'];
$start_date = $_POST['date'];
$equipment_id = $_POST['equipment_id'];
$equipment_type_id = $_POST['equipment_type_id'];
$note = $_POST['note'];
$start_time = $_POST['start_time'];
$image = $_FILES['image']['name'];

$date_to_return = $start_date + 1;
$status = 0;




$check_status = "select * from equipment where status = '$status'";
$result1 = mysqli_query($conn, $check_status);
$num1 = mysqli_num_rows($result1);


if ($num1 > 0) {
  $check_user = "
	SELECT  *
	FROM borrow
	WHERE status = 0 and member_id = $member_id 
	";
  $result = mysqli_query($conn, $check_user);
  $num = mysqli_num_rows($result);
}


if ($num > 0) {
  $_SESSION['user_check_b'] = "ท่านได้มียืมอุปกณ์ครบตามจำนวนเเล้ว กรุณายกเลิกการยืมหรือคืนอุปกรณ์ก่อนทำรายการอีกครั้ง";
  header("Location: borrow.php?id=$equipment_type_id");
} else {



  $status_check_query = "SELECT * FROM equipment WHERE equipment_id='$equipment_id' ";
  $result3 = mysqli_query($conn, $status_check_query);
  $status_check = mysqli_fetch_assoc($result3);

  if ($status_check['status'] == 0) {
    $_SESSION['borrowalready'] = "อุปกรณ์นี้ถูกยืมเเล้ว";
    header("Location: borrow.php?id=$equipment_type_id");
  } else {

    $target_dir = "../upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      echo "ไฟล์ใหญ่เกินไป";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    $query = "INSERT INTO borrow (member_id,equipment_id,equipment_type_id,start_date,status,note,start_time,image,date_to_return) 
      values ('$member_id','$equipment_id','$equipment_type_id','$start_date','$status','$note','$start_time','$image'
      ,DATE_ADD('$start_date',INTERVAL 1 DAY))";
    $query_run = mysqli_query($conn, $query);

    $query1 = "UPDATE equipment set status = 0 where equipment_id = '$equipment_id'";
    $query_run1 = mysqli_query($conn, $query1);

    if ($query_run) {
      if ($query_run1) {
        $_SESSION['borrowsuc'] = "ยืมสำเร็จ";
        header("Location: borrow_list.php");
      } else {
        $_SESSION['borrowerr'] = "ยืมไม่สำเร็จ";
        echo $query;
      }
    } else {
      $_SESSION['adderr'] = "เพิ่มข้อมูลไม่สำเร็จ";
      echo $query;
    }
  }
}
