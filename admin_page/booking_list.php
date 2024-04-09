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

$member_id = $_SESSION['member_id'];

$result = mysqli_query($conn, "select * from booking ");
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
    <br><br>
    <?php if (isset($_SESSION['bookingsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['bookingsuc'];
                unset($_SESSION['bookingsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['cancelbookingsuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['cancelbookingsuc'];
                unset($_SESSION['cancelbookingsuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>

    <center>
        <h1> ข้อมูลการจองสนาม </h1>
    </center>
    <main class="px-md-4 py-5">
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่อผู้จอง </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะผูจ้อง </th>
                        <th class="text-center f-s-10 px-1" nowrap> ชื่อสนาม </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทสนาม </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่เริม </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่สิ้นสุด </th>
                        <th class="text-center f-s-10 px-1" nowrap> ช่วงเวลาที่ใช้สนาม</th>
                        <th class="text-center f-s-10 px-1" nowrap> จำวนวนคน </th>
                        <th class="text-center f-s-10 px-1" nowrap> หมายเหตุ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ไม่อนุมัติเพราะ </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะการจอง </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>



                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $stadium_id_row = $row['stadium_id'];
                        $stadium_p = "SELECT * FROM stadium WHERE stadium_id = '$stadium_id_row'";
                        $stadium_p_run = mysqli_query($conn, $stadium_p);

                        $stadium_type_id_row = $row['stadium_type_id'];
                        $stadium_type_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$stadium_type_id_row'";
                        $stadium_type_p_run = mysqli_query($conn, $stadium_type_p);

                        $mem_id_row = $row['member_id'];
                        $mem_p = "SELECT * FROM member WHERE member_id = '$mem_id_row'";
                        $mem_p_run = mysqli_query($conn, $mem_p);

                        $app_id_row = $row['approve_id'];
                        $app_p = "SELECT * FROM approve WHERE approve_id = '$app_id_row'";
                        $app_p_run = mysqli_query($conn, $app_p);



                    ?>
                        <tr>

                            <td class="text-center f-s-10 px-1"> <?php foreach ($mem_p_run as $mem_row) {
                                                                        echo $mem_row['firstname'];
                                                                    } ?> <?php foreach ($mem_p_run as $mem_row) {
                                                                                echo $mem_row['surname'];
                                                                            } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($mem_p_run as $mem_row) {
                                                                        echo $mem_row['member_type'];
                                                                    } ?> </td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($stadium_p_run as $stadium_row) {
                                                                        echo $stadium_row['stadium_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($stadium_type_p_run as $stadium_type_row) {
                                                                        echo $stadium_type_row['stadium_type_name'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['start_date']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['end_date']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php $start_time = $row['start_time'];
                                                                    $end_time = $row['end_time'];
                                                                    $over_time = $row['over_time'];

                                                                    if ($start_time == 1 && $end_time == 1 && $over_time == 1) {
                                                                        echo "เต็มวัน";
                                                                    } else {
                                                                        if ($start_time == 1 && $end_time == 1) {
                                                                            echo "ช่วงเช้าและช่วงบ่าย";
                                                                        } else {
                                                                            if ($start_time == 1 && $over_time == 1) {
                                                                                echo "ช่วงเช้าและช่วงค่ำ";
                                                                            } else {
                                                                                if ($end_time == 1 && $over_time == 1) {
                                                                                    echo 'ช่วงบ่ายและช่วงค่ำ';
                                                                                } else {
                                                                                    if ($start_time == 1) {
                                                                                        echo 'ช่วงเช้า';
                                                                                    } else {
                                                                                        if ($end_time == 1) {
                                                                                            echo 'ช่วงบ่าย';
                                                                                        } else {
                                                                                            if ($over_time == 1) {
                                                                                                echo 'ช่วงค่ำ';
                                                                                            } else {
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['people']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['note']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php foreach ($app_p_run as $app_row) {
                                                                        echo $app_row['note'];
                                                                    } ?></td>
                            <td class="text-center f-s-10 px-1"> <?php $status = $row['status'];
                                                                    if ($status == 0) {
                                                                        echo "<font color='#ffc107'><b>รอการอนุมัติ</b> </font>";
                                                                    }
                                                                    if ($status == 1) {
                                                                        echo
                                                                        "
                                                                    <font color='#28a745'><b> อนุมัติ </b> </font>
                                                                    ";
                                                                    }
                                                                    if ($status == 2) {
                                                                        echo "<font color='red'><b>ยกเลิกการจอง</b> </font>";
                                                                    }
                                                                    if ($status == 3) {
                                                                        echo "<font color='red'><b>ไม่อนุมัติ</b> </font>";
                                                                    }


                                                                    ?></td>

                            <td class="text-center f-s-10 px-1">
                                <?php if ($row['status'] == 1) { ?>
                                    <form action="change_status_booking.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['booking_id']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"> ยกเลิกการจอง</button>
                                    </form>
                                <?php  } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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