<?php
include('../connect/conn.php');

session_start(); 

if (isset($_POST['delete_btn'])) {

        $member_id = $_POST['delete_id'];
        $query = "DELETE FROM member WHERE member_id = '$member_id'";
        
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['delmembersuc'] = "ลบข้อมูลผู้ใช้สำเร็จ";
            header('Location: member_manage.php');
        } else {
            $_SESSION['delmembererr'] = "ไม่มีสามารถยกเลิการจอกได้";
            header('Location: member_manage.php');
        }
      }
    
    
  
    


?>
