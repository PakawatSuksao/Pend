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

if (isset($_POST['updatetype_btn']))
    $id = $_POST['updatetype_id'];
$query = "SELECT * FROM stadium_type WHERE stadium_type_id = '$id'";
$query_run = mysqli_query($conn, $query);

?>
<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
            <h1> แก้ไขข้อมูลประเภทสนาม </h1>
        </center>
        <main class="   px-md-4 py-5">
            <div class="card bg-white p-4 table-responsive">
                <form method="POST" action="update_stadium.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php
                            foreach ($query_run as $row) {
                            ?>
                                <input type="hidden" name="updatetype_id" value="<?php echo $row['stadium_type_id']; ?>" required>
                                ชื่อประเภทสนาม
                                <input maxlength="50" type="text" name="name" class="form-control" value="<?php echo $row['stadium_type_name'] ?>" required>
                                <br>

                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="stadium_type_manage.php">ปิด</a>
                                    <button class="btn btn-primary" type="submit" name="updatetypebtn">บันทึก</button>
                                </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <form method="POST" action="update_stadium.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">


                                <img width="400" height="250" src='../images/<?php echo $row['image'] ?>'>
                                <br>
                                รูปภาพประเภทสนาม
                                <br>
                                <input type="hidden" name="updatetype_id" value="<?php echo $row['stadium_type_id']; ?>" required>
                                <input type="hidden" name="size" class="form-control" value="1000000">
                                <input type="file" name="image" class="form-control" required>
                                <br>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="upload">อัพโหลด</button>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>




</body>

</html>