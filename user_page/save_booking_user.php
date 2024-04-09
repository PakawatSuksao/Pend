<?php
include('../connect/conn.php');
session_start();
$member_id = $_SESSION['member_id'];


if ($_POST['date']) {
    $start_date = $_POST['date'];
    $end_date = $_POST['date'];
}
if ($_POST['start_date']) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
}
$people = $_POST['people'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$over_time = $_POST['over_time'];
$phone_number = $_POST['phone_number'];
$note = $_POST['note'];
$stadium_id = $_POST['stadium_id'];
$stadium_type_id = $_POST['stadium_type_id'];
$color = "#ffc107";

$stadium_check1 = "
SELECT status
FROM stadium
where stadium_id = '$stadium_id' and status = 0
";
echo $stadium_check1;
$result2 = mysqli_query($conn, $stadium_check1);
$num2 = mysqli_num_rows($result2);
if ($num2 > 0) {
    $_SESSION['status_check'] = "สนามกีฬา ปิด กรุณาตรวจสอบสถานะสนามกีฬาเเล้วลองใหม่อีกครั้ง";
    header("Location: booking.php?id=$stadium_type_id");
} else {

    $filename = $_FILES['document']['name'];
    $destination = '../documents/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $file = $_FILES['document']['tmp_name'];
    $size = $_FILES['document']['size'];
    if (!in_array($extension, ['pdf'])) {
        $_SESSION['notpdf'] = "นามสกุลไฟล์จะต้องเป็น .pdf";
        header("Location: booking.php?id=$stadium_type_id");
    } elseif ($_FILES['document']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        $_SESSION['biger'] = "ขนาดไฟล์ใหญ๋เกินไป!";
        header("Location: booking.php?id=$stadium_type_id");
    } else {
        // move the uploaded (temporary) file to the specified destination

        $booking_check1 = "
        SELECT *
        FROM booking  
        where stadium_id = '$stadium_id' and ('$start_date' BETWEEN start_date and end_date) and ('$end_date' BETWEEN start_date and end_date) 
        and (start_time = '$start_time' or end_time = '$end_time' or over_time = '$over_time') and (status = 0 or status = 1)
        ";
        echo $booking_check1;
        $result1 = mysqli_query($conn, $booking_check1);
        $num1 = mysqli_num_rows($result1);
        if ($num1 > 0) {
            $_SESSION['user_check'] = "ช่วงเวลานั้นถูกจองเเล้ว";
            header("Location: booking.php?id=$stadium_type_id");
        } else {
            $day = date("Y-m-d", strtotime("+5 day"));

            if ($start_date <= $day || $end_date <= $day) {
                $_SESSION['date_check'] = "กรุณาจองล่วงหน้าอย่างน้อย 5 วัน";
                header("Location: booking.php?id=$stadium_type_id");
            } else {

                // $check_user = "
                // SELECT  *
                // FROM booking
                // WHERE status = 0 and member_id = $member_id 
                // ";
                // $result = mysqli_query($conn, $check_user);
                // $num = mysqli_num_rows($result);


                // if ($num > 0) {
                //     $_SESSION['user_check'] = "ท่านได้มีการจองสนามอยู่เเล้ว กรุณายกเลิกการจองก่อนทำรายการอีกครั้ง";
                //     header("Location: booking.php?id=$stadium_type_id");
                // } else {

                $query = "INSERT INTO booking (member_id,start_date,end_date,start_time,end_time,over_time,phone_number,note,stadium_id,stadium_type_id,document,people,color) 
                values ('$member_id','$start_date','$end_date','$start_time','$end_time','$over_time','$phone_number','$note','$stadium_id','$stadium_type_id','$filename','$people','$color')";
                $query_run = mysqli_query($conn, $query);

                if (move_uploaded_file($file, $destination)) {
                    if ($query_run) {
                        $_SESSION['bkusersuc'] = "จองสำเร็จ";
                        header("Location: booking_list.php");
                    }
                } else {
                    $_SESSION['bkusererr'] = "เพิ่มข้อมูลไม่สำเร็จ";
                    header("Location: stadium.php?id=$stadium_type_id");
                }
                // }
            }
        }
    }
}
