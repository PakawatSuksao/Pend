<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $booking_id = $_POST['delete_id'];
        $query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
        echo $query;
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['deletesuc'] = "ยกเลิกการจองเรียบร้อยแล้ว";
            header('Location: booking_list.php');
        } else {
            $_SESSION['nodelete'] = "ไม่มีสามารถยกเลิการจอกได้";
            header('Location: booking_list.php');
        }
      }

?>
