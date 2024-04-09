<?php
include('../connect/conn.php');
session_start();
$member_id = $_POST['member_id'];
$booking_id = $_POST['booking_id'];
$stadium_id = $_POST['stadium_id'];
$approve_date = $_POST['approve_date'];
$approve_time = $_POST['approve_time'];
$note = $_POST['note'];
$approve = $_POST['approve'];
$reject = $_POST['reject'];
if ($reject) {
    $msg = "การไม่";
}


$check_user = "
	SELECT  *
	FROM booking
	WHERE status != 0 and booking_id = '$booking_id'
	";
$result = mysqli_query($conn, $check_user);
$num = mysqli_num_rows($result);


if ($num > 0) {
    $_SESSION['status_check'] = "ไม่มีข้อมูลการจองนี้";
    header("Location: approve_stadium.php");
} else {

    $query = "INSERT INTO approve (approve_date,approve_time,booking_id,stadium_id,member_id,note) 
    values ('$approve_date','$approve_time','$booking_id','$stadium_id','$member_id','$note')";
    $query_run = mysqli_query($conn, $query);
    $approve_id = $conn->insert_id;
    if ($reject) {
        $query_approve = "UPDATE booking set status = 3, approve_id = '$approve_id' , color = null  where booking_id = '$booking_id'";
        $query_run_approve = mysqli_query($conn, $query_approve);
    }
    if ($approve) {


        $query_approve = "UPDATE booking set status = 1, approve_id = '$approve_id' , color = '#28a745' where booking_id = '$booking_id'";
        $query_run_approve = mysqli_query($conn, $query_approve);
    }



    if ($query_run) {
        $_SESSION['approvesuccess'] = $msg . "อนุมัติสำเร็จ";
        header("Location: approve_stadium.php");
    } else {
        $_SESSION['approveerr'] = "ไม่สำเร็จ";
        header("Location: approve_stadium.php");
    }
}
