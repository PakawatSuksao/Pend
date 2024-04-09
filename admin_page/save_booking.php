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
$color = "#28a745";

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
    $booking_check1 = "
SELECT *
FROM booking  
where stadium_id = '$stadium_id' and ('$start_date' BETWEEN start_date and end_date) and ('$end_date' BETWEEN start_date and end_date) 
and (start_time = '$start_time' or end_time = '$end_time' or over_time = '$over_time') and (status = 1 or status = 0)
";
    echo $booking_check1;
    $result1 = mysqli_query($conn, $booking_check1);
    $num1 = mysqli_num_rows($result1);
    if ($num1 > 0) {
        $_SESSION['user_check'] = "ช่วงเวลานั้นถูกจองเเล้ว";
        header("Location: booking.php?id=$stadium_type_id");
    } else {
        // if($start_time >= 5 and $end_time <= 5){

        // }
        $day = date("Y-m-d", strtotime("-1 day"));

        if ($start_date <= $day || $end_date <= $day) {
            $_SESSION['date_check'] = "ไม่สามารถจองย้อนหลังได้";
            header("Location: booking.php?id=$stadium_type_id");
        } else { {

                $query = "INSERT INTO booking (member_id,start_date,end_date,start_time,end_time,over_time,phone_number,note,stadium_id,stadium_type_id,document,people,status,color) 
                 values ('$member_id','$start_date','$end_date','$start_time','$end_time','$over_time','$phone_number','$note','$stadium_id','$stadium_type_id','$filename','$people','1','$color')";
                $query_run = mysqli_query($conn, $query);


                if ($query_run) {
                    $_SESSION['bookingsuc'] = "จองสำเร็จ";
                    header("Location: booking_list.php");
                } else {
                    $_SESSION['bookingerr'] = "เพิ่มข้อมูลไม่สำเร็จ";
                    header("Location: stadium.php?id=$stadium_type_id");
                }
            }
        }
    }
}
