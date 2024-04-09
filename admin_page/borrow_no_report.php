<?php


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


?>

<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
background-position: center;
background-repeat: no-repeat;
background-size: cover; 
 ">
    <?php include('../include_admin/header.php'); ?>
    <div class="container">

        <main class="px-md-4 py-4">
            <br>
            <br>
            <br>
            <h1 class="h2">กราฟแสดงข้อมูลจำนวนการยืมอุกรณ์กีฬา</h1>
            <div class="card" style="background-color: 8FB7DB;">
                <h5 class="card-header">
                    ค้นหากราฟ
                </h5>
                <div class="card-body">
                    <form method="post">
                        <a class=" btn btn-primary " href="borrow_report.php">ข้อมูลการยืมอุปกรณ์กีฬา</a> <a class=" btn btn-primary" href="booking_report.php">ข้อมูลการจองสนามกีฬา</a>
                        <hr>
                        <a class=" btn btn-warning" href="borrow_no_report.php">ข้อมูลจำนวนอุปกรณ์กีฬาที่ยังไม่คืน</a>



                    </form>
                    <hr>
                    <form method="post">
                        <input class="btn btn-primary" type="submit" name="all" value="แสดงกราฟจากข้อมูลทั้งหมด">
                    </form>
                    <hr>
                    <form method="post">
                        ตั้งแต่ :
                        <input type="date" name="txtStartDate" required>
                        ถึง :
                        <input type="date" name="txtEndDate" required>
                        <input class="btn btn-primary" type="submit" name="search" value="ค้นหา">
                    </form>
                </div>
            </div>


            <div class="row my-4">
                <div class="col-10 col-md-10 col-lg-12 mb-lg-0">
                    <div class="card">
                        <h5 class="card-header" style="background-color: 8FB7DB;">กราฟ</h5>
                        <div class="card-body">
                            <?php

                            $con  = mysqli_connect("localhost", "root", "", "dbproject");



                            $msg = "ข้อมูลจำนวนอุปกณ์ที่ยังไม่คืนทั้งหมด";
                            $dataPoints = array();
                            $result = mysqli_query($con, "
                        SELECT equipment_type_id as x,count(borrow_id) as y FROM borrow
                        WHERE status = 0
                        GROUP BY equipment_type_id
                        ORDER BY equipment_type_id
                       ");

                            while ($row = mysqli_fetch_array($result)) {
                                $brand_id_row = $row['x'];
                                $brand_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$brand_id_row' ";
                                $brand_p_run = mysqli_query($con, $brand_p);
                                foreach ($brand_p_run as $brand_row) {
                                    $brandname = $brand_row['equipment_type_name'];
                                }

                                $amount[] = $row['y'];
                                array_push($dataPoints, array("label" => $brandname, "y" => $row['y']));
                            }
                            if (isset($_POST['search'])) {
                                $dataPoints = array();
                                $txtStartDate = $_POST['txtStartDate'];
                                $txtEndDate = $_POST['txtEndDate'];
                                $msgequipment = "ข้อมูลการยืมอุปกรณ์ ตั้งเเต่ ";
                                $msg = "$txtStartDate ถึง $txtEndDate";
                                $query = mysqli_query($con, "SELECT equipment_type_id as x,count(borrow_id) as y FROM borrow
                                WHERE end_date BETWEEN '$txtStartDate' and '$txtEndDate'
                                GROUP BY equipment_type_id
                                ORDER BY equipment_type_id
                           ");
                                $count = mysqli_num_rows($query);


                                while ($row = mysqli_fetch_array($query)) {
                                    $brand_id_row = $row['x'];
                                    $brand_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$brand_id_row' ";
                                    $brand_p_run = mysqli_query($con, $brand_p);
                                    foreach ($brand_p_run as $brand_row) {
                                        $brandname = $brand_row['equipment_type_name'];
                                    }
                                    $amount[] = $row['y'];
                                    array_push($dataPoints, array("label" => $brandname, "y" => $row['y']));
                                }
                            } else {

                                if (isset($_POST['all'])) {
                                    $msg = "ข้อมูลการยืมอุปกรณ์ทั้งหมด";
                                    $dataPoints = array();
                                    $result = mysqli_query($con, "
                                SELECT equipment_type_id as x,count(borrow_id) as y FROM borrow
                                WHERE status = 0
                                GROUP BY equipment_type_id
                                ORDER BY equipment_type_id");

                                    while ($row = mysqli_fetch_array($result)) {
                                        $brand_id_row = $row['x'];
                                        $brand_p = "SELECT * FROM equipment_type WHERE equipment_type_id = '$brand_id_row' ";
                                        $brand_p_run = mysqli_query($con, $brand_p);
                                        foreach ($brand_p_run as $brand_row) {
                                            $brandname = $brand_row['equipment_type_name'];
                                        }

                                        $amount[] = $row['y'];
                                        array_push($dataPoints, array("label" => $brandname, "y" => $row['y']));
                                    }
                                }
                            }
                            ?>

                            <!DOCTYPE html>
                            <html lang="en">

                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Graph</title>
                            </head>

                            <body>
                                <?php
                                @ini_set('display_errors', '0');
                                if ($count == "0") {
                                    echo 'ไม่มีข้อมูล';
                                } else {
                                ?>
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

                            </body>

                            <script type="text/javascript">
                                window.onload = function() {

                                    var chart = new CanvasJS.Chart("chartContainer", {
                                        animationEnabled: true,
                                        theme: "light2",
                                        title: {
                                            text: "<?php echo $msgequipment . $msg; ?>"
                                        },
                                        axisY: {
                                            suffix: "",
                                            labelFontSize: 15,

                                        },
                                        axisX: {
                                            suffix: "",
                                            labelFontSize: 20,

                                        },
                                        data: [{
                                            type: "column",
                                            yValueFormatString: "#,##0\"\"",
                                            indexLabel: "{y}",
                                            indexLabelPlacement: "top",
                                            indexLabelFontColor: "black",
                                            indexLabelFontSize: "20",
                                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                        }]
                                    });
                                    chart.render();

                                }
                            </script>





                            </html>
                        <?php } ?>




                        </div>
                    </div>
                </div>



            </div>

            <div class="card" style="background-color: 8FB7DB;">
                <h5 class="card-header">
                    Export Excel
                </h5>
                <div class="card-body">
                    <form action="../report_no_borrow.php" method="post" enctype="multipart/form-data">
                        ตั้งแต่ :
                        <input type="date" name="start_date" required>
                        ถึง :
                        <input type="date" name="end_date" required>
                        <input type="submit" class="btn btn-primary" value="EXPORT">
                    </form>
                    <hr>
                    <form action="../reportall_no_borrow.php" method="post" enctype="multipart/form-data">
                        <input type="submit" class="btn btn-primary" value="EXPORT ข้อมูลทั้งหมด">
                    </form>
                </div>
            </div>
            <?php


            ?>
    </div>
</body>