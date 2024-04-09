<?php
include('../connect/conn.php');

session_start();

if ($_SESSION['member_id'] == "") {
    $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header('location: ../login.php');
}

if ($_SESSION['member_type'] == "admin") {
    $_SESSION['msg'] = "หน้าสำหรับนักศึกษา";
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}

$member_id = $_SESSION['member_id'];


$result = mysqli_query($conn, "select * from borrow where member_id = '$member_id' ORDER BY status asc ");

?>

<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <style>
        h1 {
            color: #FFF;
            text-shadow: 3px 3px 2px #000000;
        }

        .text-center {
            font-size: 18px;
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
    <?php include('../include/header.php'); ?>
    <?php if (isset($_SESSION['borrowsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['borrowsuc'];
                unset($_SESSION['borrowsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>

    <?php if (isset($_SESSION['cancelborrowsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['cancelborrowsuc'];
                unset($_SESSION['cancelborrowsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>
    <center>
        <h1> ข้อมูลการยืมอุปกรณ์ </h1>
    </center>
    <main class="px-md-4 py-5">
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่อผู้ยืม </th>
                        <th class="text-center f-s-10 px-1" nowrap> ชื่ออุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่ยืม </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่คืน </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่ต้องคืน</th>
                        <th class="text-center f-s-10 px-1" nowrap> หมายเหตุ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ค่าปรับ </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะการยืม </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $table_index = 0;
                    while ($row = mysqli_fetch_array($result)) {

                        $equipment_id_row = $row['equipment_id'];
                        $equipment_p = "SELECT * FROM equipment WHERE equipment_id = '$equipment_id_row'";
                        $equipment_p_run = mysqli_query($conn, $equipment_p);

                        $equipment_type_id_row = $row['equipment_type_id'];
                        $equipment_type_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$equipment_type_id_row'";
                        $equipment_type_p_run = mysqli_query($conn, $equipment_type_p);

                        $mem_id_row = $row['member_id'];
                        $mem_p = "SELECT * FROM member WHERE member_id = '$mem_id_row'";
                        $mem_p_run = mysqli_query($conn, $mem_p);


                    ?>
                        <tr>

                            <td class="text-center f-s-10 px-1"> <?php foreach ($mem_p_run as $mem_row) {
                                                                        echo $mem_row['firstname'];
                                                                    } ?> <?php foreach ($mem_p_run as $mem_row) {
                                                                                echo $mem_row['surname'];
                                                                            } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($equipment_p_run as $equipment_row) {
                                                                        echo $equipment_row['equipment_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($equipment_type_p_run as $equipment_type_row) {
                                                                        echo $equipment_type_row['equipment_type_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['start_date']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['end_date']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['date_to_return']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['note']; ?></td>
                            <td class="text-center f-s-10 px-1"><?php if (((strtotime(date("Y-m-d")) - strtotime($row['date_to_return'])) / 86400) * 5 > 0) {
                                                                    echo ((strtotime(date("Y-m-d")) - strtotime($row['date_to_return'])) / 86400) * 5;
                                                                } else echo 0 ?> </td>
                            <td class="text-center f-s-10 px-1"> <?php $status = $row['status'];
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
                            <td>

                                <?php
                                if ($status != 2 && $status != 1) { ?>
                                    <button data-toggle="modal" data-target="#confirm_<?= $table_index++ ?>" type="submit" class="btn btn-danger"> ยกเลิกการยืม</button>

                                <?php
                                }
                                ?>

                            </td>



                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php
            $result = mysqli_query($conn, "select * from borrow where member_id = '$member_id' ORDER BY status asc ");
            $modal_index = 0;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="modal fade" id="confirm_<?= $modal_index++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h1 class="text-center" size="50">ยกเลิกการยืม</h1>

                            </div>
                            <hr>
                            <form action="change_status_borrow.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $row['borrow_id']; ?>">
                                <input type="hidden" name="delete_id1" value="<?php echo $row['equipment_id']; ?>">

                                <center>
                                    <button class="btn btn-primary " type="submit" name="delete_btn">ยืนยัน</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                </center>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#table11').DataTable();
            });
        </script>
</body>

</html>