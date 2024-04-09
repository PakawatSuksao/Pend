<?php
include('../connect/conn.php');

session_start();

if (isset($_POST['delete_btn'])) {

    $borrow_id = $_POST['delete_id'];
    $equipment_id = $_POST['delete_id1'];

    $query = "UPDATE borrow set status = 2 where borrow_id = '$borrow_id'";
    $query_run = mysqli_query($conn, $query);

    $query1 = "UPDATE equipment set status = 1 where equipment_id = '$equipment_id'";
    $query_run1 = mysqli_query($conn, $query1);

    if ($query_run) {
        if ($query_run1) {
            $_SESSION['cancelborrowsuc'] = "ยกเลิกการยืมเรียบร้อยแล้ว";
            header('Location: borrow_list.php');
        } else {
            $_SESSION['cancelborrowerr'] = "ไม่มีสามารถยกเลิการยืมได้";
            header('Location: borrow_list.php');
        }
    } else {
        $_SESSION['cancelborrowsucerr'] = "ไม่มีสามารถยกเลิการยืมได้";
        header('Location: borrow_list.php');
    }
}
