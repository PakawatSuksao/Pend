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


$result = mysqli_query($conn, "select * from equipment_type order by equipment_type_name ");

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
    <?php if (isset($_SESSION['uploadquiptypesuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['uploadquiptypesuc'];
                unset($_SESSION['uploadquiptypesuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['addequiptypesuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['addequiptypesuc'];
                unset($_SESSION['addequiptypesuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['delequiptypesuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['delequiptypesuc'];
                unset($_SESSION['delequiptypesuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['equiptypesuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['equiptypesuc'];
                unset($_SESSION['equiptypesuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['equipalready'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['equipalready'];
                unset($_SESSION['equipalready']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nim_equiptype'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nim_equip'];
                unset($_SESSION['nim_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nz_equiptype'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nz_equiptype'];
                unset($_SESSION['nz_equip']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nt_equiptype'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_equiptype'];
                unset($_SESSION['nt_equiptype']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nu_equiptype'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_equiptype'];
                unset($_SESSION['nt_equiptype']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>
    <center>
        <h1> จัดการข้อมูลอุปกรณ์กีฬา </h1>
    </center>
    <main class="   px-md-4 py-5">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addequipment_type">
                เพิ่มประเภทอุปกรณ์
            </button>
            <a href="equipment_manage.php" class="btn btn-secondary">กลับ</a>
        </div>
        <hr>
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่อประเภทอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> รูปภาพอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {




                    ?>
                        <tr>


                            <td class="text-center f-s-10 px-1"> <?php echo $row['equipment_type_name']; ?></td>
                            <td class="text-center f-s-10 px-1"> <img width="50" height="50" src='../images/<?php echo $row['image'] ?>'></td>

                            <td>
                                <form action="edit_equipment_type.php" method="post">
                                    <input type="hidden" name="updatetype_id" value="<?php echo $row['equipment_type_id']; ?>">
                                    <button type="submit" name="updatetype_btn" class="btn btn-primary"> แก้ไขข้อมูล</button>
                                </form>
                            </td>
                            <td>
                                <form action="delete_equipment_type.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['equipment_type_id']; ?>">
                                    <button type="submit" name="delete_btn" class="btn btn-danger"> ลบข้อมูล</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <div class="modal fade" id="addequipment_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลอุปกรณ์</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="save_equipment_type.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="text" name="name" class="form-control" placeholder="ชื่อประเภทอุปกรณ์" required>
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