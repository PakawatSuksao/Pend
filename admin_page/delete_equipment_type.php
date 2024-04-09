<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $equipment_type_id = $_POST['delete_id'];
        $query = "DELETE FROM equipment_type WHERE equipment_type_id = '$equipment_type_id'";
        echo $query;
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['delequiptypesuc'] = "ลบข้อมูลประเภทสนามกีฬาสำเร็จ";
            header('Location: equipment_type_manage.php');
        } else {
            $_SESSION['delequiptypeerr'] = "ไม่สามรถลบข้อมูลได้";
            header('Location: equipment_type_manage.php');
        }
      }
    
    
  
    


?>
