<?php
session_start();
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css">



<head>

  <style>
    * {
      margin: 0px;
      padding: 0px;
    }

    body {
      font-size: 120%;
      background: #F8F8FF;
    }

    .header {
      width: 30%;
      margin: 10px auto 0px;
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
      margin: 5px 0px 0px 0px;

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
      color: #3c763d;
      background: #dff0d8;
      border: 1px solid #3c763d;
      margin-bottom: 20px;
    }

    .custom-select {
      min-width: 350px;
    }

    select {
      appearance: none;
      /* safari */
      -webkit-appearance: none;
      /* other styles for aesthetics */
      height: 30px;
      width: 93%;
      font-size: 16px;
      padding: 5px 10px;
      background-color: #fff;
      border: 1px solid gray;
      border-radius: 5px;
      color: #000;
      cursor: pointer;
    }
  </style>
</head>
<title>

  สมัครสมาชิก
</title>

<body style="background-image: url('./images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
  <div class="header">
    <h2>กรอกข้อมูลเพื่อสมัครสมาชิก</h2>
  </div>
  <form method="post" action="save_register.php">

    <?php if (isset($_SESSION['ualready'])) : ?>
      <div class="error error">
        <h3>
          <?php
          echo $_SESSION['ualready'];
          unset($_SESSION['ualready']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <br>
    <?php if (isset($_SESSION['pnotmatch'])) : ?>
      <div class="error error">
        <h3>
          <?php
          echo $_SESSION['pnotmatch'];
          unset($_SESSION['pnotmatch']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <div class="input-group">
      <label>ชื่อ</label>
      <input type="text" name="firstname" maxlength="20" required>
    </div>
    <div class="input-group">
      <label>นามสกุล</label>
      <input type="text" name="surname" 2 maxlength="20" required>
    </div>
    <div class="input-group">
      <label>ชื่อผู้ใช้</label>
      <input type="text" name="username" minlength="8" maxlength="20" required>
    </div>
    <div class="input-group">
      <label>รหัสผ่าน</label>
      <input type="password" name="password" minlength="8" maxlength="20" required>
    </div>
    <div class="input-group">
      <label>ยืนยันรหัสผ่าน</label>
      <input type="password" name="c_password" minlength="8" maxlength="20" required>
    </div>
    <div class="input-group">
      <label>หมายเลขโทรศัพท์</label>
      <input type="tel" id="phone" name="phone_number" pattern="[0-9]{10}" required>
    </div>

    <div class="input-group">
      <label>คณะ</label>
      <select name="faculty">
        <option>-- คณะ --</option>
        <option value="คณะศิลปศาสตร์">คณะศิลปศาสตร์</option>
        <option value="คณะครุศาสตร์อุตสาหกรรม">คณะครุศาสตร์อุตสาหกรรม</option>
        <option value="คณะเทคโนโลยีการเกษตร">คณะเทคโนโลยีการเกษตร</option>
        <option value="คณะวิศวกรรมศาสตร์">คณะวิศวกรรมศาสตร์</option>
        <option value="คณะบริหารธุรกิจ">คณะบริหารธุรกิจ</option>
        <option value="คณะเทคโนโลยีคหกรรมศาสตร์">คณะเทคโนโลยีคหกรรมศาสตร์</option>
        <option value="คณะศิลปกรรมศาสตร์">คณะศิลปกรรมศาสตร์</option>
        <option value="คณะเทคโนโลยีสื่อสารมวลชน">คณะเทคโนโลยีสื่อสารมวลชน</option>
        <option value="คณะวิทยาศาสตร์และเทคโนโลยี">คณะวิทยาศาสตร์และเทคโนโลยี</option>
        <option value="คณะสถาปัตยกรรมศาสตร์">คณะสถาปัตยกรรมศาสตร์</option>
        <option value="คณะการแพทย์บูรณาการ">คณะการแพทย์บูรณาการ</option>
        <option value="คณะพยาบาลศาสตร์">คณะพยาบาลศาสตร์</option>
      </select>
    </div>

    <div class="input-group">
      <label>สถานะ</label>
      <select name="agency">
        <option>-- สถานะ --</option>
        <option value="ผู้ใช้ทั่วไป">ผู้ใช้ทั่วไป</option>
        <option value="นักศึกษา">นักศึกษา</option>
        <option value="อาจารย์">อาจารย์</option>
      </select>
    </div>
    <div class="input-group">
      <label>บ้านเลขที่</label>
      <input type="text" name="mbHouseNum" required>
    </div>
    <div class="input-group">
      <label>จังหวัด</label>
      <input type="text" name="mbProvince" required>
    </div>
    <div class="input-group">
      <label>อำเภอ</label>
      <input type="text" name="mbCity" required>
    </div>
    <div class="input-group">
      <label>ตำบล</label>
      <input type="text" name="mbDistrict" required>
    </div>
    <div class="input-group">
      <label>รหัสไปรษณีย์</label>
      <input type="text" name="mbPostcode" minlength="5" maxlength="5" required>
    </div>



    <center>
      <div class="input-group">
        <button type="submit" class="btn">สมัครสมาชิก</button>
        <a class="btn btn-danger" style="background-color: red" href="login.php">ย้อนกลับ</a>
      </div>
      <p>
        เป็นสมาชิกเเล้ว <a href="login.php">เข้าสู่ระบบ</a>
      </p>
    </center>

  </form>

</body>

</html>