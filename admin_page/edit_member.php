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

if (isset($_POST['edit_btn']))
    $id = $_POST['edit_id'];
$query = "SELECT * FROM member WHERE member_id = '$id'";
$query_run = mysqli_query($conn, $query);

?>
<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <style>
        h1 {
            color: FFF;
            text-shadow: 3px 3px 2px #000000;

        }
    </style>
</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
    <?php include('../include_admin/header.php'); ?>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <center>
            <h1> แก้ไขข้อมูลผู้ใช้ </h1>
        </center>
        <main class="   px-md-4 py-5">
            <div class="card bg-white p-4 table-responsive">
                <form method="POST" action="update_member.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php
                            foreach ($query_run as $row) {
                            ?>
                                <input type="hidden" name="edit_id" value="<?php echo $row['member_id']; ?>" required>
                                <input type="text" name="name" class="form-control" value="<?php echo $row['firstname'] ?>" required>
                                <br>
                                <input type="text" name="surname" class="form-control" value="<?php echo $row['surname'] ?>" required>
                                <br>
                                <input type="text" name="phone_number" class="form-control" value="<?php echo $row['phone_number'] ?>" required>
                                <br>
                                <input type="text" name="faculty" class="form-control" value="<?php echo $row['faculty'] ?>" required>
                                <br>
                                <input type="text" name="agency" class="form-control" value="<?php echo $row['agency'] ?>" required>
                                <br>
                                <input type="text" name="mbHouseNum" class="form-control" value="<?php echo $row['mbHouseNum'] ?>" required>
                                <br>
                                <input type="text" name="mbProvince" class="form-control" value="<?php echo $row['mbProvince'] ?>" required>
                                <br>
                                <input type="text" name="mbCity" class="form-control" value="<?php echo $row['mbCity'] ?>" required>
                                <br>
                                <input type="text" name="mbDistrict" class="form-control" value="<?php echo $row['mbDistrict'] ?>" required>
                                <br>
                                <input type="text" name="mbPostcode" class="form-control" value="<?php echo $row['mbPostcode'] ?>" required>
                                <br>

                                <select name="status" class="form-control">
                                    <option value="<?php $status = $row['member_type'];
                                                    echo $status;
                                                    ?>">
                                        <?php
                                        echo $status; ?>
                                    </option>
                                    <?php
                                    if ($status == 'admin') {
                                    ?>
                                        <option value="user">บุคคลทั่วไป</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="admin">ผู้ดูแลระบบ</option>
                                    <?php
                                    } {
                                    ?>
                                        <option value="student">นักศึกษา</option>
                                    <?php
                                    } {
                                    ?>
                                        <option value="student">อาจารย์</option>
                                    <?php
                                    }
                                    ?>
                                    <option value="user">บุคคลทั่วไป</option>
                                </select>
                                <br>
                            <?php } ?>
                            <div class="modal-footer">
                                <a class="btn btn-secondary" href="member_manage.php">ปิด</a>
                                <button class="btn btn-primary" type="submit" name="updatebtn">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>



</body>

</html>