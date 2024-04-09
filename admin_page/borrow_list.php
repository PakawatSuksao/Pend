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


$result = mysqli_query($conn, "select * from borrow where status != 2 order by status asc  ");
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
                        <th class="text-center f-s-10 px-1" nowrap> เบอร์โทร </th>
                        <th class="text-center f-s-10 px-1" nowrap> ชื่ออุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> ประเภทอุปกรณ์ </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่ยืม </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่คืน </th>
                        <th class="text-center f-s-10 px-1" nowrap> วันที่คิดค่าปรับ</th>
                        <th class="text-center f-s-10 px-1" nowrap> หมายเหตุ </th>
                        <th class="text-center f-s-10 px-1" nowrap> บัตรนักศึกษา </th>
                        <th class="text-center f-s-10 px-1" nowrap> ค่าปรับ </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะการยืม </th>


                    </tr>
                </thead>
                <tbody>
                    <?php
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
                            <td class="text-center f-s-10 px-1"> <?php foreach ($mem_p_run as $mem_row) {
                                                                        echo $mem_row['phone_number'];
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
                            <td class="text-center f-s-10 px-1"> <a href="read_image.php?id=<?php echo $row['borrow_id']; ?>" target="_blank"> <img class="zoom" width="100" height="100" src='../upload/<?php echo $row['image'] ?>'> </td>
                            <td class="field"><?php if (((strtotime(date("Y-m-d")) - strtotime($row['date_to_return'])) / 86400) * 5 > 0) {
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