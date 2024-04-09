<?php
include('../connect/conn.php');

session_start();

if (isset($_POST['delete_btn'])) {
    date_default_timezone_set("Asia/Bangkok");
    $member_id = $_POST['member_id'];
    $end_date = date("Y-m-d");
    $end_time =  date("H:i:s");
    $borrow_id = $_POST['delete_id'];

    $equipment_id = $_POST['delete_id1'];
    $penalty = ((strtotime(date("Y-m-d")) - strtotime($_POST['delete_id2'])) / 86400) * 5;

    $query = "UPDATE borrow set status = 1 , end_date = '$end_date' , end_time = '$end_time' , penalty = '$penalty' where borrow_id = '$borrow_id'";
    $query_run = mysqli_query($conn, $query);


    $query1 = "UPDATE equipment set status = 1 where equipment_id = '$equipment_id'";
    $query_run1 = mysqli_query($conn, $query1);



    if ($query_run) {
        if ($query_run1) {
            $_SESSION['returnsuc'] = "คืนอุปกรณ์เรียบร้อยแล้ว";
            header("Location: return_equipment.php");
        } else {
            $_SESSION['returnerr'] = "ไม่มีสามารถคืนอุปกร์ได้";
            header("Location: return_equipment.php");
        }
    } else {
        $_SESSION['returnerr'] = "ไม่มีสามารถคืนอุปกร์ได้";
        header("Location: return_equipment.php");
    }
}
