<?php


include('../connect/conn.php');

session_start();

if ($_SESSION['member_id'] == "") {
  $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
  header('location: ../login.php');
}

if ($_SESSION['member_type'] != "admin") {
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

<html>
<title>รายละเอียดสนาม</title>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
  <?php include('../include_admin/header.php'); ?>
  <br>
  <br>
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