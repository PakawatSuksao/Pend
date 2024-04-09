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


$result = mysqli_query($conn, "select * from stadium order by stadium_type_id ");
?>

<html>
<title>จองสนามกีฬา</title>

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
    <?php if (isset($_SESSION['uploadstadiumsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['uploadstadiumsuc'];
                unset($_SESSION['uploadstadiumsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['addstadiumsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['addstadiumsuc'];
                unset($_SESSION['addstadiumsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['delstadiumsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['delstadiumsuc'];
                unset($_SESSION['delstadiumsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['updatestadiumsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['updatestadiumsuc'];
                unset($_SESSION['updatestadiumsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['stadiumalready'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['stadiumalready'];
                unset($_SESSION['stadiumalready']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nim_stadium'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nim_stadium'];
                unset($_SESSION['nim_stadium']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nz_stadium'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nz_stadium'];
                unset($_SESSION['nz_stadium']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nt_stadium'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_stadium'];
                unset($_SESSION['nt_stadium']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['nu_stadium'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['nt_stadium'];
                unset($_SESSION['nt_stadium']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>
    <br>
    <center>
        <h1> จัดการข้อมูลสนามกีฬา </h1>
    </center>
    <main class=" px-md-4 py-5">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addstadium">
                เพิ่มข้อมูลสนาม
            </button>

            <a href="stadium_type_manage.php" class="btn btn-primary  ">จัดการประเภทสนาม</a>

        </div>


        <hr>
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่อสนาม </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทสนาม </th>
                        <th class="text-center f-s-10 px-1" nowrap> รูปภาพ </th>
                        <th class="text-center f-s-10 px-1" nowrap> เวลาเปิดให้บริการ</th>
                        <th class="text-center f-s-10 px-1" nowrap> จำนวนคนที่รองรับ</th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานที่ตั้ง </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะ </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {

                        $std_id_row = $row['stadium_type_id'];
                        $std_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$std_id_row'";
                        $std_p_run = mysqli_query($conn, $std_p);


                    ?>
                        <tr>


                            <td class="text-center f-s-10 px-1"> <?php echo $row['stadium_name']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($std_p_run as $std_row) {
                                                                        echo $std_row['stadium_type_name'];
                                                                    } ?></td>

                            <td class="text-center f-s-10 px-1"> <img width="150" height="150" src='../images/<?php echo $row['image'] ?>'></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['start_time']; ?> - <?php echo $row['end_time']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['people']; ?> </td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['location']; ?> </td>
                            <td class="text-center f-s-10 px-1"> <?php $status = $row['status'];
                                                                    if ($status == 0) {
                                                                        echo "<font color='#ffc107'><b>ปิด</b> </font>";
                                                                    } else {
                                                                        echo
                                                                        "
                                            <font color='#28a745'><b> เปิด </b> </font>
                                            ";
                                                                    }

                                                                    ?></td>
                            <td>
                                <form action="edit_stadium.php" method="post">
                                    <input type="hidden" name="update_id" value="<?php echo $row['stadium_id']; ?>">
                                    <button type="submit" name="update_btn" class="btn btn-primary"> แก้ไขข้อมูล</button>
                                </form>
                            </td>
                            <td>
                                <form action="delete_stadium.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['stadium_id']; ?>">
                                    <button class="btn btn-danger " type="submit" name="delete_btn">ลบข้อมูล</button>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>


        <div class="modal fade" id="addstadium" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลสนาม</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="save_stadium.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <?php
                                include('../connect/conn.php');
                                $sql = "SELECT * FROM stadium_type ";
                                $query = mysqli_query($conn, $sql);
                                ?>


                                <select class="form-control" name="stadium_type_id" required>
                                    <option value="">-- เลือกประเภทสนาม --</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM stadium_type");
                                    while ($row = $sql->fetch_assoc()) {
                                    ?>

                                        <option value="<?php echo $row["stadium_type_id"]; ?>"><?php echo $row["stadium_type_name"]; ?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                <input maxlength="55" type="text" name="name" class="form-control" placeholder="ชื่อสนาม" required>
                                <br>
                                ช่วงเวลาเปิดให้บริการ
                                <br>
                                ตั้งเเต่ <input type="time" name="start_time" placeholder="" required>
                                ถึง
                                <input type="time" name="end_time" placeholder="" required>
                                <br>
                                <br>
                                <input type="text" name="people" class="form-control" placeholder="จำนวนคนที่รองรับ" required>
                                <br>
                                <p></p>
                                <input maxlength="100" type="text" name="location" class="form-control" placeholder="สถานที่ตั้ง" required>
                                <br>
                                รูปภาพสนาม
                                <br>

                                <input type="hidden" name="size" class="form-control" value="1000000">
                                <input type="file" name="image" class="form-control" required>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-primary" type="submit" name="upload">บันทึกการจอง</button>
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