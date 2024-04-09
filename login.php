<?php
include('connect/conn.php');
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<head>
  <style>
    * {
      margin: 0px;
      padding: 0px;
    }

    body {
      font-size: 120%;
      background: #F8F8FF;
      min-height: 100vh;
    }

    .header {
      width: 30%;
      margin: 180px auto 0px;
      color: white;
      background: #3D5B95;
      text-align: center;
      text-shadow: 3px 3px 2px #000000;
      border: 1px solid #B0C4DE;
      border-bottom: none;
      border-radius: 10px 0px 0px 0px;
      padding: 20px;
    }

    form,
    .content {
      width: 30%;
      margin: 0px auto;
      padding: 20px;
      border: 1px solid #B0C4DE;
      background: white;
      border-radius: 0px 0px 10px 10px;
    }

    .input-group {
      margin: 10px 0px 10px 0px;
    }

    .input-group label {
      display: block;
      text-align: left;
      margin: 3px;
    }

    .input-group input {
      height: 30px;
      width: 93%;
      padding: 5px 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid gray;
    }

    .btn {
      padding: 10px;
      font-size: 15px;
      color: white;
      background: #3D5B95;
      border: none;
      border-radius: 5px;

    }

    .error {
      width: 92%;
      margin: 0px auto;
      padding: 10px;
      border: 1px solid #a94442;
      color: #a94442;
      background: #f2dede;
      border-radius: 5px;
      text-align: left;
    }

    .success {
      width: 92%;
      margin: 0px auto;
      padding: 10px;
      border: 1px solid #3c763d;
      color: #3c763d;
      background: #dff0d8;
      border-radius: 5px;
      text-align: left;


    }
  </style>
</head>
<title>
  เข้าสู่ระบบ
</title>

<body style="background-image: url('./images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
  <div class="header">
    <h2>เข้าสู่ระบบ</h2>
  </div>
  <form method="post" action="check_login.php">
    <?php
    if (isset($_SESSION['loginerr'])) : ?>
      <div class="error error">
        <?php
        echo $_SESSION['loginerr'];
        unset($_SESSION['loginerr']);
        ?>
      </div>
    <?php endif ?>
    <?php
    if (isset($_SESSION['register_success'])) : ?>
      <div class="success success">
        <?php
        echo $_SESSION['register_success'];
        unset($_SESSION['register_success']);
        ?>
      </div>
    <?php endif ?>

    <div class="input-group">
      <label>ชื่อผู้ใช้</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
      <label>รหัสผ่าน</label>
      <input type="password" name="password" required>
    </div>
    <div>
      <font size="2">เงื่อนไขการใช้บริการ</font><br>
      <font size="2">1.กรุณาศึกษาข้อมูล เงื่อนไขการให้บริการสนามกีฬาก่อนจองสนาม</font><br>
      <font size="2">2.กรุณาศึกษาข้อมูล เงื่อนไขการยืมอุปกรณ์ก่อนยืมอุปกรณ์กีฬา</font><br>
      <font size="2">3.โปรดรักษาเวลาในการยืมอุปกรณ์และจองสนามกีฬา</font><br><br>

      <input type="radio" id="html" name="condi" required>
      <font size="2"> ยอมรับเงื่อนไขการใช้บริการ</font>
      <font size="2" color="red">*กรุณาศึกษาก่อนยืมรับเงื่อนไข</font>
    </div>
    <center>
      <div class="input-group">
        <button type="submit" class="btn" name="login_user">เข้าสู่ระบบ</button>
        <a class="btn btn-danger" style="background-color: red" href="index.html">ย้อนกลับ</a>
      </div>
      <p>
        สำหรับบุคคลภายนอก <a href="register.php">สมัครสมาชิก</a>
      </p>
    </center>
  </form>

</body>

</html>