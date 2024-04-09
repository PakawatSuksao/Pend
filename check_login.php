<?php
session_start();
include('connect/conn.php');

$Username_m = mysqli_real_escape_string($conn, $_POST['username']);
$password_1 = mysqli_real_escape_string($conn, $_POST['password']);
$password_1 = md5($password_1);

$sql = "SELECT * FROM member WHERE username = '$Username_m'
and password = '$password_1'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if (!$result) {
    $_SESSION['loginerr'] = "ชื่อผู้ใช้หรือรหัสผ่านผิด";
    header("location:login.php");
} else {
    $_SESSION["member_id"] = $result["member_id"];
    $_SESSION["member_type"] = $result["member_type"];
    $_SESSION['username'] = $Username_m;
    $_SESSION['firstname'] = $result["firstname"];
    $_SESSION['surname'] = $result["surname"];
    $_SESSION['faculty'] = $result["faculty"];
    $_SESSION['agency'] = $result["agency"];
    $_SESSION['success'] = "เข้าสู่ระบบเรียบร้อยเเล้ว";
    session_write_close();
    if ($result["member_type"] == "admin") {
        header("location:admin_page/return_equipment.php");
    } else {
        header("location:user_page/stadium_type.php");
    }
}
mysqli_close($conn);
