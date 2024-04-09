<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $stadium_type_id = $_POST['delete_id'];
        $query = "DELETE FROM stadium_type WHERE stadium_type_id = '$stadium_type_id'";
        echo $query;
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['delstadiumtypesuc'] = "ลบข้อมูลประเภทสนามกีฬาสำเร็จ";
            header('Location: stadium_type_manage.php');
        } else {
            $_SESSION['delstadiumtypeerr'] = "ไม่มีลบข้อมูลประเภทสนามกีฬาได้";
            header('Location: stadium_type_manage.php');
        }
      }
    
    
  
    


?>
