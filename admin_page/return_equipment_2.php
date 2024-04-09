<?php


include('../connect/conn.php');

session_start();

if ($_SESSION['member_id'] == "") {
    $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header('location: ../login.php');
}

if ($_SESSION['member_type'] != "admin") {
    $_SESSION['msg'] = "หน้าสำหรับผู้ดูแลระบบ";
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}


if (isset($_POST['search'])) {

    $id = $_POST['username'];
    $result = mysqli_query($conn, "select * from member where username = '$id'");

    $row = mysqli_fetch_array($result);

    if ($row['member_id'] == '') {
        $_SESSION['nodata'] = "ไม่มีข้อมูล";
        header("Location: return_equipment.php");
    } else {
        $member_id = $row['member_id'];
    }
    $result_borrow = mysqli_query($conn, "select * from borrow where member_id = '$member_id' and status != 2 order by status asc ");
}


?>

<html>
<title>คืนอุปกรณ์กีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        h1 {
            color: FFF;
            text-shadow: 3px 3px 2px #000000;

        }

        .zoom {
            padding: 3px;
            background-color: #000000;
            transition: transform .2s;
            /* Animation */
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }

        .zoom:hover {
            transform: scale(1.5);
            /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>

</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
/* Center and scale the image nicely */
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
    <?php include('../include_admin/header.php'); ?>

    <br>
    <br>
    <br>
    <br>
    <center>
        <h1> คืนอุปกรณ์กีฬา </h1>
    </center>
    <main class="   px-md-4 py-5">
        <div class="container">
            <div id="content" class="card bg-white p-4 content content-full-width">

                <div class="profile-content ">
                    <div class="table-responsive ">
                        <table class="table table-profile">
                            <thead>
                                <h4>ข้อมูลผู้ใช้</h4>

                            </thead>
                            <?php

                            foreach ($result as $row) {
                            ?>
                                <tbody>

                                    <tr>
                                        <td class="field">ชื่อ</td>
                                        <td><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="field">นามสกุล</td>
                                        <td><?php echo $row['surname']; ?></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">คณะ/หน่วยงาน</td>
                                        <td><?php echo $row['agency']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="field">เบอร์โทรศัพท์</td>
                                        <td><i class="fa fa-phone"> <?php echo $row['phone_number']; ?></i></td>
                                    </tr>

                                </tbody>
                            <?php } ?>
                        </table>
                        <br>
                        <div class="p-1">
                            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                                <thead class="thead" style="background-color: 8FB7DB;">
                                    <h5>รายการยืมอุปกรณ์</h5>
                                    <hr>
                                    <tr>

                                        <th class="field" nowrap> ชื่อุปกรณ์ </th>
                                        <th class="field" nowrap> ประเภทอุปกรณ์ </th>
                                        <th class="field" nowrap> หมายเหตุ </th>
                                        <th class="field" nowrap> วันเวลาที่ยืม </th>
                                        <th class="field" nowrap> วันที่ต้องคืน</th>
                                        <th class="field" nowrap> เวลาที่คืน</th>
                                        <th class="field" nowrap> บัตรนักศึกษา</th>
                                        <th class="field" nowrap> ค่าปรับ</th>
                                        <th class="field" nowrap> สถานะ </th>
                                        <th class="field" nowrap> </th>

                                    </tr>
                                </thead>

                                </thead>
                                <tbody>
                                    <?php
                                    $table_index = 0;
                                    while ($row_borrow = mysqli_fetch_array($result_borrow)) {
                                        $eq_id_row = $row_borrow['equipment_id'];
                                        $eq_p = "SELECT * FROM equipment WHERE 	
                                    equipment_id = '$eq_id_row'";
                                        $eq_p_run = mysqli_query($conn, $eq_p);

                                        $eqt_id_row = $row_borrow['equipment_type_id'];
                                        $eqt_p = "SELECT * FROM equipment_type WHERE 	
                                    equipment_type_id = '$eqt_id_row'";
                                        $eqt_p_run = mysqli_query($conn, $eqt_p);
                                    ?>
                                        <tr>


                                            <td class="field"><?php foreach ($eq_p_run as $eq_row) {
                                                                    echo $eq_row['equipment_name'];
                                                                } ?></td>
                                            <td class="field"><?php foreach ($eqt_p_run as $eqt_row) {
                                                                    echo $eqt_row['equipment_type_name'];
                                                                } ?></td>
                                            <td class="field"><?php echo $row_borrow['note']; ?></td>
                                            <td class="field"><?php echo $row_borrow['start_date']; ?> : <?php echo $row_borrow['start_time']; ?></td>
                                            <td class="field"><?php echo $row_borrow['date_to_return']; ?> : <?php echo $row_borrow['time_to_return']; ?></td>
                                            <td class="field"><?php echo $row_borrow['end_date']; ?> : <?php echo $row_borrow['end_time']; ?></td>
                                            <td class="text-center f-s-10 px-1"><a href="read_image.php?id=<?php echo $row_borrow['borrow_id']; ?>" target="_blank"> <img class="zoom" width="100" height="100" src='../upload/<?php echo $row_borrow['image'] ?>'> </td>
                                            <td class="field"><?php if (((strtotime(date("Y-m-d")) - strtotime($row_borrow['date_to_return'])) / 86400) * 5 > 0) {
                                                                    echo ((strtotime(date("Y-m-d")) - strtotime($row_borrow['date_to_return'])) / 86400) * 5;
                                                                } else echo 0 ?> </td>
                                            <td class="field"><?php $status = $row_borrow['status'];

                                                                if ($status == 0) {
                                                                    echo "<font color='#ffc107'><b>ยังไม่คืน</b> </font>";
                                                                }
                                                                if ($status == 1) {
                                                                    echo "<font color='#28a745'><b> คืนเเล้ว </b> </font>";
                                                                }
                                                                if ($status == 2) {
                                                                    echo "<font color='red'><b>ยกเลิกการยืม</b> </font>";
                                                                }
                                                                ?></td>


                                            <td class="field"><?php
                                                                if ($status != 2 && $status != 1) { ?>
                                                    <form action="change_status_borrow.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php $id = $member_id; ?>">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row_borrow['borrow_id']; ?>">
                                                        <input type="hidden" name="delete_id1" value="<?php echo $row_borrow['equipment_id']; ?>">
                                                        <input type="hidden" name="delete_id2" value="<?php echo $row_borrow['date_to_return']; ?>">
                                                        <button class="btn btn-primary " type="submit" name="delete_btn">คืน</button>
                                                    </form>

                                                <?php
                                                                }
                                                ?>
                                            </td>

                                        </tr>

                                    <?php } ?>
                                </tbody>

                            </table>
                            <!-- <?php
                                    $result_borrow = mysqli_query($conn, "select * from borrow where member_id = '$member_id' and status != 2 order by status asc ");
                                    $modal_index = 0;
                                    while ($row_borrow = mysqli_fetch_array($result_borrow)) {
                                    ?>
                                <div class="modal fade" id="confirm_<?= $modal_index++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h1 class="text-center" size="50">คืนอุปกรณ์กีฬา</h1>
                                            </div>
                                            <hr>
                                            <form action="change_status_borrow.php" method="post">
                                                
                                                <center>
                                                    <button class="btn btn-primary " type="submit" name="delete_btn">ยืนยัน</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                </center>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?> -->
                        </div>

                    </div>
                    <center>
                        <a href="return_equipment.php" class="btn btn-primary">ค้นหา</a>
                    </center>
                </div>
            </div>
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