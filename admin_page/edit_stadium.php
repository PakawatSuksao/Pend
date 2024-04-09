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

if (isset($_POST['update_btn']))
    $id = $_POST['update_id'];
$query = "SELECT * FROM stadium WHERE stadium_id = '$id'";
$query_run = mysqli_query($conn, $query);

?>
<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
            <h1> แก้ไขข้อมูลประเภทสนาม </h1>
        </center>
        <main class="   px-md-4 py-5">
            <div class="card bg-white p-4">
                <form method="POST" action="update_stadium.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php

                            foreach ($query_run as $row) {

                                $stadium_type_id_row = $row['stadium_type_id'];
                                $stadium_type_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$stadium_type_id_row'";
                                $stadium_type_p_run = mysqli_query($conn, $stadium_type_p);
                                foreach ($stadium_type_p_run as $stadium_type_row) {
                                    $stadium_type_name = $stadium_type_row['stadium_type_name'];
                                }

                            ?>
                                <input type="hidden" name="updatest_id" value="<?php echo $row['stadium_id']; ?>" required>
                                ชื่อสนาม
                                <input maxlength="55" type="text" name="name" class="form-control" value="<?php echo $row['stadium_name'] ?>" required>
                                <br>
                                เลือกประเภทสนาม
                                <select class="form-control" name="stadium_type_id" required>

                                    <option value="<?php echo $row["stadium_type_id"]; ?>"><?php echo $stadium_type_name; ?></option>

                                    <?php

                                    $sql = mysqli_query($conn, "SELECT * FROM stadium_type");
                                    while ($row1 = $sql->fetch_assoc()) {
                                    ?>



                                        <option value="<?php echo $row1["stadium_type_id"]; ?>"><?php echo $row1["stadium_type_name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                เวลาเปิดให้บริการ
                                <input type="time" name="start_time" class="form-control" value="<?php echo $row['start_time'] ?>" required>
                                <br>
                                เวลาปิดให้บริการ
                                <input type="time" name="end_time" class="form-control" value="<?php echo $row['end_time'] ?>" required>
                                <br>
                                จำนวนคนที่รองรับ
                                <input type="text" name="people" class="form-control" value="<?php echo $row['people'] ?>" required>
                                <br>
                                ที่ตั้ง
                                <input maxlength="100" type="text" name="location" class="form-control" value="<?php echo $row['location'] ?>" required>
                                <br>
                                สถานะ
                                <select class="form-control" name="status" required>


                                    <?php
                                    $status = $row['status'];
                                    if ($status == 0) {
                                    ?>
                                        <option value="0">ปิด</option>
                                        <option value="1">เปิด</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $status = $row['status'];
                                    if ($status == 1) {
                                    ?>
                                        <option value="1">เปิด</option>

                                        <option value="0">ปิด</option>
                                    <?php
                                    }
                                    ?>





                                </select>
                                <br>


                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="stadium_manage.php">ปิด</a>
                                    <button class="btn btn-primary" type="submit" name="updatestbtn">บันทึก</button>
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
                                รูปภาพอุปกรณ์
                                <br>
                                <input type="hidden" name="update_id" value="<?php echo $row['stadium_id']; ?>" required>
                                <input type="hidden" name="size" class="form-control" value="1000000">
                                <input type="file" name="image" class="form-control" required>
                                <br>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="upload_st">อัพโหลด</button>
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