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
$query = "SELECT * FROM equipment WHERE equipment_id = '$id'";
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
            <h1> แก้ไขข้อมูลอุปกรณ์กีฬา </h1>
        </center>
        <main class="px-md-4 py-5">
            <div class="card bg-white p-4 table-responsive">
                <form method="POST" action="update_equipment.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?php

                            foreach ($query_run as $row) {
                                $equipment_type_id_row = $row['equipment_type_id'];
                                $equipment_type_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$equipment_type_id_row'";
                                $equipment_type_p_run = mysqli_query($conn, $equipment_type_p);
                                foreach ($equipment_type_p_run as $equipment_type_row) {
                                    $equipment_type_name = $equipment_type_row['equipment_type_name'];
                                }

                            ?>
                                <input type="hidden" name="updatest_id" value="<?php echo $row['equipment_id']; ?>" required>
                                ชื่ออุปกรณ์
                                <input type="text" name="name" class="form-control" value="<?php echo $row['equipment_name'] ?>" required>
                                <br>
                                เลือกประเภทอุปกร์กีฬา
                                <select class="form-control" name="equipment_type_id" required>
                                    <option value="<?php echo $row["equipment_type_id"]; ?>"><?php echo $equipment_type_name; ?>
                                    </option>
                                    <?php

                                    $sql = mysqli_query($conn, "SELECT * FROM equipment_type");
                                    while ($row1 = $sql->fetch_assoc()) {
                                    ?>

                                        <option value="<?php echo $row1["equipment_type_id"]; ?>"><?php echo $row1["equipment_type_name"]; ?>
                                        </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                หมายเลขซีเรียล
                                <input type="text" name="serialnumber" class="form-control" value="<?php echo $row['serialnumber'] ?>" required>
                                <br>
                                สถานะอุปกรณ์
                                <select class="form-control" name="status" required>


                                    <?php
                                    $status = $row['status'];
                                    if ($status == 0) {
                                    ?>

                                        <option value="1">อุปกรณ์ยังอยู่</option>
                                        <option value="2">ชำรุด</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $status = $row['status'];
                                    if ($status == 1) {
                                    ?>
                                        <option value="1">อุปกรณ์ยังอยู่</option>

                                        <option value="2">ชำรุด</option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $status = $row['status'];
                                    if ($status == 2) {
                                    ?>
                                        <option value="2">ชำรุด</option>
                                        <option value="1">อุปกรณ์ยังอยู่</option>


                                    <?php
                                    }
                                    ?>




                                </select>

                                <br>


                                <div class="modal-footer">
                                    <a class="btn btn-secondary" href="equipment_manage.php">ปิด</a>
                                    <button class="btn btn-primary" type="submit" name="updatestbtn">บันทึก</button>
                                </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <form method="POST" action="update_equipment.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">


                                <img width="150" height="150" src='../images/<?php echo $row['image'] ?>'>
                                <br>
                                รูปภาพอุปกรณ์
                                <br>
                                <input type="hidden" name="update_id" value="<?php echo $row['equipment_id']; ?>" required>
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