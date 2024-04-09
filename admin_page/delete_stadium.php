<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $stadium_id = $_POST['delete_id'];
        $query = "DELETE FROM stadium WHERE stadium_id = '$stadium_id'";
        echo $query;
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['delstadiumsuc'] = "ลบข้อมูลสนามกีฬาสำเร็จ";
            header('Location: stadium_manage.php');
        } else {
            $_SESSION['delstadiumerr'] = "ไม่สามารถลบข้อมูลสนามกีฬาได้";
            header('Location: stadium_manage.php');
        }
      }
    
    
  
    


?>
