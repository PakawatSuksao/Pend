<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $equipment_id = $_POST['delete_id'];
        $query = "DELETE FROM equipment WHERE equipment_id = '$equipment_id'";
        echo $query;
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['delequipsuc'] = "ลบข้อมูลสนามกีฬาสำเร็จ";
            header('Location: equipment_manage.php');
        } else {
            $_SESSION['delequiperr'] = "ไม่มีสามารถยกเลิการจอกได้";
            header('Location: equipment_manage.php');
        }
      }
    
    
  
    


?>
