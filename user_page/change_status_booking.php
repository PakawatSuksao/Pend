<?php
include('../connect/conn.php');

session_start();

if (isset($_POST['delete_btn'])) {

    $booking_id = $_POST['delete_id'];
    $stadium_id = $_POST['delete_id1'];

    $query = "UPDATE booking set status = 2 , color = null where booking_id = '$booking_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['cancelbookingsuc'] = "ยกเลิกการจองเรียบร้อยแล้ว";
        header('Location: booking_list.php');
    } else {
        $_SESSION['cancelbookingerr'] = "ไม่มีสามารถยกเลิการจองได้";
        header('Location: booking_list.php');
    }
}
