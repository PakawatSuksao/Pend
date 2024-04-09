<?php

session_start();

if ($_SESSION['member_id'] == "") {
  $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
  header('location: ../login.php');
}

if ($_SESSION['member_type'] == "admin") {
  $_SESSION['msg'] = "หน้าสำหรับผู้ใช้";
  exit();
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: ../login.php");
}


include('../connect/conn.php');
$id = $_GET['id'];
$sql = "SELECT * FROM stadium where stadium_id = $id  ";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query)
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รายละเอียดสนาม</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

  <style>
    h1 {
      color: #FFF;
      text-shadow: 3px 3px 2px #000000;
    }
  </style>
</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
  <?php include('../include/header.php'); ?>
  <br>

  <center>
    <h1> ข้อมูลสนาม </h1>
    <br><br>
  </center>
  <center>
    <div class="card text-white" style="width: 30rem; background-color: #3D5B95;">
      <img class="card-img-top" src="../images/<?php echo $result['image']; ?>" alt="Card image cap">
      <div class="card-body">
        <h2 class="card-title text-center"><?php
                                            $std_id_row = $result['stadium_type_id'];
                                            $std_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$std_id_row'";
                                            $std_p_run = mysqli_query($conn, $std_p);

                                            foreach ($std_p_run as $std_row) {
                                              echo $std_row['stadium_type_name'];
                                            } ?></h2>
        </h5>
        <ul>

          <li class="card-title text-left">ชื่อสนาม: <span><?php echo $result['stadium_name']; ?></span></li>
          <li class="card-title text-left">สถานที่ตั้ง: <span><?php echo $result['location']; ?></span></li>
          <li class="card-title text-left">จำนวนคนที่รองรับ: <span><?php echo $result['people']; ?></span></li>
          <li class="card-title text-left">เวลาที่เปิดให้บริการ: <span><?php echo $result['start_time']; ?> - <?php echo $result['end_time']; ?></span></li>

        </ul>
      </div>
    </div>
    <br>
    <a class="btn btn-secondary" href="booking.php?id=<?php echo $result['stadium_type_id']; ?>">ย้อนกลับ</a>
    <hr>
  </center>




</body>

</html>