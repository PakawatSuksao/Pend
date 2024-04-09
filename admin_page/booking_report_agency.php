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
$conn  = mysqli_connect("localhost", "root", "", "dbproject");
$result_equipmenmt_type = mysqli_query($conn, "select * from stadium_type");

?>

<html>
<title>จองสนามกีฬา</title>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
    <div class="container">
        <main class="px-md-4 py-4">

            <br>
            <br>
            <br>
            <h1 class="h2">กราฟแสดงข้อมูลจำนวนการจองสนามกีฬา</h1>
            <div class="card " style="background-color: 8FB7DB;">
                <h5 class="card-header">
                    ค้นหากราฟ
                </h5>
                <div class="card-body">
                    <form method="post">
                        <a class="btn btn-primary" href="borrow_report.php">ข้อมูลการยืมอุปกรณ์กีฬา</a>

                    </form>
                    <hr>

                    <a class="btn btn-primary" href="booking_report.php">ข้อมูลการจองสนามกีฬา</a>
                    <hr>

                    <form method="post">
                        <select class=" my-2 mx-1 mb-lg-0 col-sm-2" name="report_id" required>
                            <option value="">-- เลือกประเภทสนามกีฬา --</option>
                            <?php

                            while ($row_equipment_type = mysqli_fetch_array($result_equipmenmt_type)) {
                            ?>
                                <option value="<?php echo $row_equipment_type['stadium_type_id'] ?>"><?php echo $row_equipment_type['stadium_type_name'] ?></option>
                            <?php } ?>

                        </select>
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
                        <h5 class="card-header " style="background-color: 8FB7DB;">กราฟ</h5>
                        <div class="card-body">
                            <?php

                            if (isset($_POST['search'])) {
                                $dataPoints = array();
                                $id = $_POST['report_id'];

                                $txtStartDate = $_POST['txtStartDate'];
                                $txtEndDate = $_POST['txtEndDate'];
                                $msg = "$txtStartDate ถึง $txtEndDate";
                                $query = mysqli_query($conn, "SELECT stadium_type_id, member_id as x,count(booking_id) as y FROM booking
                            WHERE start_date BETWEEN '$txtStartDate' and '$txtEndDate' and stadium_type_id = '$id'  
                            GROUP BY member_id
                            ORDER BY stadium_type_id
                            ");
                                $count = mysqli_num_rows($query);


                                while ($row = mysqli_fetch_array($query)) {
                                    $brand_id_row = $row['x'];
                                    $brand_p = "SELECT * FROM member WHERE member_id = '$brand_id_row' ";
                                    $brand_p_run = mysqli_query($conn, $brand_p);
                                    foreach ($brand_p_run as $brand_row) {
                                        $brandname = $brand_row['agency'];
                                    }
                                    $brand_id_row = $row['stadium_type_id'];
                                    $brand_p = "SELECT * FROM stadium_type WHERE stadium_type_id = '$brand_id_row' ";
                                    $brand_p_run = mysqli_query($conn, $brand_p);
                                    foreach ($brand_p_run as $brand_row) {
                                        $brandname1 = $brand_row['stadium_type_name'];
                                    }

                                    array_push($dataPoints, array("label" => $brandname, "y" => $row['y']));
                                }
                            }




                            ?>
                            <?php
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
                                            text: "<?php echo $brandname1; ?> <?php echo $msg; ?> "

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


    </div>
    <?php


    ?>
</body>