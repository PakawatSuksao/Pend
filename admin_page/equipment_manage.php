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

$perpage = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;
$result = mysqli_query($conn, "select * from equipment order by status asc limit {$start} , {$perpage}");
?>

<html>
<title>จัดการข้อมูลอุปกรณ์กีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        h1 {
            color: FFF;
            text-shadow: 3px 3px 2px #000000;

        }

        .text-center {
            font-size: 18px;
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
    <?php if (isset($_SESSION['uploadquipsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['uploadquipsuc'];
                unset($_SESSION['uploadquipsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['addequipsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['addequipsuc'];
                unset($_SESSION['addequipsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['delequipsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['delequipsuc'];
                unset($_SESSION['delequipsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['updateuquipsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['updateuquipsuc'];
                unset($_SESSION['updateuquipsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['quipalready'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['quipalready'];
                unset($_SESSION['quipalready']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nim_equip'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nim_equip'];
                unset($_SESSION['nim_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nz_equip'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nz_equip'];
                unset($_SESSION['nz_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nt_equip'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_equip'];
                unset($_SESSION['nt_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nu_equip'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_equip'];
                unset($_SESSION['nt_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>
    <br>

    <center>
        <h1> จัดการข้อมูลอุปกรณ์กีฬา </h1>
    </center>
    <main class="   px-md-4 py-5">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addequipment">
                เพิ่มข้อมูลอุปกรณ์กี่ฬา
            </button>
            <a href="equipment_type_manage.php" class="btn btn-primary">จัดการประเภทอุปกรณ์</a>
        </div>
        <hr>
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่ออุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> หมายเลขซีเรียล </th>
                        <th class="text-center f-s-10 px-1" nowrap> รูปภาพ</th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะอุปกรณ์</th>
                        <th class="text-center f-s-10 px-1" nowrap> แก้ไขข้อมูล</th>
                        <th class="text-center f-s-10 px-1" nowrap> ลบข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php



                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <?php
                            $std_id_row = $row['equipment_type_id'];
                            $std_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$std_id_row'";
                            $std_p_run = mysqli_query($conn, $std_p); ?>


                            <td class="text-center f-s-10 px-1"> <?php echo $row['equipment_name']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($std_p_run as $std_row) {
                                                                        echo $std_row['equipment_type_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['serialnumber']; ?></td>
                            <td class="text-center f-s-10 px-1"> <img width="80" height="80" src='../images/<?php echo $row['image'] ?>'> </td>
                            <td class="text-center f-s-10 px-1"> <?php $status = $row['status'];
                                                                    if ($status == 0) {
                                                                        echo "<font color='#dc3545'><b>ถูกยืม</b> </font>";
                                                                    }
                                                                    if ($status == 1) {
                                                                        echo "<font color='#28a745'><b>อุปกรณ์ยังอยู่</b> </font>";
                                                                    }
                                                                    if ($status == 2) {
                                                                        echo "<font color='#FFC107'><b>ชำรุด</b> </font>";
                                                                    }

                                                                    ?></td>
                            <td>
                                <?php
                                if ($status == 0) {
                                } else {
                                ?>
                                    <form action="edit_equipment.php" method="post">
                                        <input type="hidden" name="update_id" value="<?php echo $row['equipment_id']; ?>">
                                        <button type="submit" name="update_btn" class="btn btn-primary"> แก้ไขข้อมูล</button>
                                    </form>
                                <?php  } ?>
                            </td>
                            <td>
                                <?php
                                if ($status == 0) {
                                } else {
                                ?>
                                    <form action="delete_equipment.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['equipment_id']; ?>">
                                        <button class="btn btn-danger " type="submit" name="delete_btn">ลบข้อมูล</button>
                                    </form>
                                <?php  } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>


        <div class="modal fade" id="addequipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลอุปกรณ์กีฬา</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="save_equipment.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <?php
                                include('../connect/conn.php');
                                $sql = "SELECT * FROM equipment_type ";
                                $query = mysqli_query($conn, $sql);
                                ?>
                                <select class="form-control" name="equipment_type_id" required>
                                    <option value="">-- เลือกประเภทอุปกร์กีฬา --</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM equipment_type");
                                    while ($row = $sql->fetch_assoc()) {
                                    ?>

                                        <option value="<?php echo $row["equipment_type_id"]; ?>"><?php echo $row["equipment_type_name"]; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input maxlength="100" type="text" name="name" class="form-control" placeholder="ชื่ออุปกรณ์กีฬา" required>
                                <br>
                                <input maxlength="30" type="text" name="serialnumber" class="form-control" placeholder="หมายเลขซีเรียล" required>
                                <br>
                                รูปภาพอุปกรณ์
                                <br>

                                <input type="hidden" name="size" class="form-control" value="1000000">
                                <input type="file" name="image" class="form-control" required>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-primary" type="submit" name="upload">บันทึก</button>
                        </div>

                    </form>


                </div>
            </div>
            <br>

        </div>
        <br>


        <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#table11').DataTable();
            });
        </script>

</body>

</html>