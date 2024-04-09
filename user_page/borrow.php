<?php


include('../connect/conn.php');

session_start();

if ($_SESSION['member_id'] == "") {
    $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header('location: ../login.php');
}

if ($_SESSION['member_type'] != "student") {
    $_SESSION['msg'] = "หน้าสำหรับนักศึกษา";
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}

$id = $_SESSION['member_id'];
$equipment_type_id = $_GET['id'];

?>

<html>
<title>จัดการข้อมูลอุปกรณ์กีฬา</title>

<head>
    <title>Form with Signature Pad | E-Signature Pad using Jquery UI and PHP
        - bootstrapfriendly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="asset/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/css/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 400px;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }

        h1 {
            color: #FFF;
            text-shadow: 3px 3px 2px #000000;
        }
    </style>
</head>
<?php include('../include/header.php'); ?>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
    <?php if (isset($_SESSION['user_check_b'])) : ?>
        <center>
            <div class="alert alert-danger user_check">

                <?php
                echo $_SESSION['user_check_b'];
                unset($_SESSION['user_check_b']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['borrowalready'])) : ?>
        <center>
            <div class="alert alert-danger user_check">

                <?php
                echo $_SESSION['borrowalready'];
                unset($_SESSION['borrowalready']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>
    <br>
    <center>
        <h1> ยืมอุปกรณ์กีฬา </h1>
    </center>
    <main class=" px-md-4 py-5">
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: #DEF1FA;">
                <thead class="thead" style="background-color: #8FB7DB;">
                    <tr>
                        <th class="text-center f-s-10 px-1" nowrap> IDอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ชื่ออุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> หมายเลขซีเรียล </th>
                        <th class="text-center f-s-10 px-1" nowrap> รูปภาพ</th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะอุปกรณ์</th>
                        <th class="text-center f-s-10 px-1" nowrap> ยืม </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $query = "select * from equipment where status = 1 and equipment_type_id = '$equipment_type_id' order by status asc  ";
                    $result = mysqli_query($conn, $query);
                    $table_index = 0;

                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <?php
                            $eq_id_row = $row['equipment_type_id'];
                            $eq_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$eq_id_row'";
                            $eq_p_run = mysqli_query($conn, $eq_p);

                            $std_id_row = $id;
                            $std_p = "SELECT * FROM member WHERE member_id = '$std_id_row'";
                            $std_p_run = mysqli_query($conn, $std_p);
                            ?>


                            <td class="text-center f-s-10 px-1"> <?php echo $row['equipment_id']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['equipment_name']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($eq_p_run as $eq_row) {
                                                                        echo $eq_row['equipment_type_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['serialnumber']; ?></td>
                            <td class="text-center f-s-10 px-1"> <img width="50" height="50" src='../images/<?php echo $row['image'] ?>'> </td>
                            <td class="text-center f-s-10 px-1"> <?php
                                                                    $status = $row['status'];
                                                                    if ($status == 0) {
                                                                        echo "<font color='#dc3545'><b>ถูกยืม</b> </font>";
                                                                    }
                                                                    if ($status == 1) {
                                                                        echo "<font color='#28a745'><b>อุปกรณ์ยังอยู่</b> </font>";
                                                                    }
                                                                    if ($status == 2) {
                                                                        echo "<font color='#FFC107'><b>ชำรุด</b> </font>";
                                                                    }
                                                                    if ($status == 3) {
                                                                        echo "<font color='#FFC107'><b>ค่าปรับ</b> </font>";
                                                                    }

                                                                    ?></td>
                            <td>

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#borrow_<?= $table_index++ ?>">
                                    ยืมอุปกรณ์กีฬา
                                </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        <!-- Edit -->

        <?php
        $query = "select * from equipment where status = 1 and equipment_type_id = '$equipment_type_id' order by status asc";
        $result = mysqli_query($conn, $query);

        $modal_index = 0;
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="modal fade" id="borrow_<?= $modal_index++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">


                            <h5 class="modal-title" id="exampleModalLabel">ยืมอุปกรณ์กีฬา</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="save_borrow.php" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <?php

                                    ?>
                                    <input type="hidden" name="equipment_type_id" class="form-control" value="<?php echo $row['equipment_type_id']; ?>" required>
                                    <input type="hidden" name="equipment_id" class="form-control" value="<?php echo $row['equipment_id']; ?>" required>

                                    ชื่อผู้ยืม
                                    <input type="text" name="member_id" class="form-control" value="<?php foreach ($std_p_run as $std_row) {
                                                                                                        echo $std_row['firstname'];
                                                                                                    } ?> <?php
                                                                                                            foreach ($std_p_run as $std_row) {
                                                                                                                echo $std_row['surname'];
                                                                                                            } ?>" readonly required>

                                    ชื่ออุปกรณ์
                                    <input type="text" name="name" class="form-control" value="<?php echo $row['equipment_name']; ?>" readonly required>

                                    หมายเลขซีเรียล
                                    <input type="text" name="serialnumber" class="form-control" value="<?php echo $row['serialnumber']; ?>" readonly required>

                                    วันที่
                                    <input type="date" name="date" value="<?php echo date("Y-m-d") ?>" class="form-control" readonly required>
                                    เวลา
                                    <input type="time" name="start_time" value="<?php date_default_timezone_set("Asia/Bangkok");
                                                                                echo date("H:i:s") ?>" class="form-control" readonly required>
                                    หมายเหตุ
                                    <input type="text" name="note" class="form-control" required>


                                    รูปภาพรูปบัตรนักศึกษา
                                    <br>
                                    <input type="hidden" name="size" class="form-control" value="1000000">
                                    <input type="file" name="image" class="form-control" required>

                                    <br>
                                    <font color="red">*</font>กรุณามารับอุปกรณ์ก่อนเวลา 15 นาที <br>
                                    <font color="red">*</font>กรุณาคืนอุปกรณ์ภายในวันที่ยืม <br>
                                    <font color="red">*</font>หากคืนช้ากว่ากำหนดผู้ยืมต้องเสียค่าปรับ <br>
                                    <font color="red">*</font>ค่าปรับจะเริ่มคิดทันที่หากไม่คืนก่อน 00.00 น ของวันที่ยืม <br>

                                    <input type="radio" id="html" name="condi" required>
                                    <font size="2"> ยอมรับเงื่อนไขการใช้บริการ</font>
                                    <font size="2" color="red">*กรุณาอ่านก่อนยืมรับเงื่อนไข</font>
                                    <br>



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
        <?php } ?>

        <!-- End Edit -->
        <div class="modal fade" id="borrow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel">ยืมอุปกรณ์กีฬา</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="save_borrow.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <?php
                                $query = "select * from equipment order by status asc";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_array($result);
                                ?>
                                <input type="hidden" name="equipment_type_id" class="form-control" value="<?php echo $row['equipment_type_id']; ?>" required>
                                <input type="hidden" name="equipment_id" class="form-control" value="<?php echo $row['equipment_id']; ?>" required>

                                ชื่อผู้จอง
                                <input type="text" name="member_id" class="form-control" value="<?php foreach ($std_p_run as $std_row) {
                                                                                                    echo $std_row['member_name'];
                                                                                                } ?> <?php
                                                                                                        foreach ($std_p_run as $std_row) {
                                                                                                            echo $std_row['surname'];
                                                                                                        } ?>" readonly required>

                                ชื่ออุปกรณ์
                                <input type="text" name="name" class="form-control" value="<?php echo $row['equipment_name']; ?>" readonly required>

                                หมายเลขซีเรียล
                                <input type="text" name="serialnumber" class="form-control" value="<?php echo $row['serialnumber']; ?>" readonly required>

                                วันที่
                                <input type="date" name="date" value="<?php echo date("Y-m-d") ?>" class="form-control" readonly required>
                                เวลา
                                <input type="time" name="start_time" value="<?php date_default_timezone_set("Asia/Bangkok");
                                                                            echo date("H:i:s") ?>" class="form-control" readonly required>


                                หมายเหตุ
                                <input type="text" name="note" class="form-control" required>
                                <br>
                                <font color="red">*</font>กรุณามารับอุปกรณ์ก่อนเวลา 15 นาที <br>
                                <font color="red">*</font>กรุณาคืนอุปกรณ์ภายในวันที่ยืม


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button class="btn btn-primary" type="submit" name="upload">บันทึก</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>

        <br>

        <script type="text/javascript">
            var sig = $('#sig').signature({
                syncField: '#signature',
                syncFormat: 'PNG'
            });
            $('#clear').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature").val('');
            });
        </script>
</body>

</html>