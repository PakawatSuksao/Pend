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


include('../connect/conn.php');
$id = $_GET['id'];

$Stadiumresult = mysqli_query($conn, "select * from stadium_type where stadium_type_id = '$id'");
$Stadium = mysqli_fetch_array($Stadiumresult);
?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <style>
        .sidebar-nav ul li a {
            font-size: 26px;
            text-decoration: none;
            display: block;
            padding: 6px 10px;
            transition: 0.5s;
        }

        .sidebar-nav ul li a:hover {
            background-color: #eeeeee;
            border-radius: 4px;
        }

        .sidebar-nav .offcanvas {
            width: 265px;
            border: none;
        }

        .sidebar-nav .offcanvas ul li a span {
            font-size: 18px;
            position: relative;
            top: -4px;
            transition: 0.5s;
        }

        .sidebar-nav .offcanvas.show ul li a:hover span {
            padding-left: 10px;
        }

        .sidebar-nav .dropdown-toggle::after {
            position: relative;
            top: 3px;
        }


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
    <div class="sidebar-nav">
        <nav class="navbar navbar-dark fixed-top" style="background-color: 3D5B95;">
            <div class="container">
                <!-- Mobile Menu Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Menus List -->
                <div class="offcanvas offcanvas-start shadow " style="background-color: 3D5B95;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                            <center>
                                <a class="navbar-brand" href="#"><b><i><img src="../images/logo.png"></i></b></a>
                            </center>
                            <center>
                                <a class="navbar-brand" href="#"><b><i>
                                            <font>R</font>RMUTT
                                        </i></b></a>
                            </center>
                            <center>
                                <a class="navbar-brand" href="#"><b><i>ระบบจองสนามกีฬา</i></b> </a>
                            </center>
                            <hr>
                            <li><a href="return_equipment.php">
                                    <font color="white"> <i class="fas fa-exchange"></i></font> <span class="item-text">
                                        <font color="white">รับคืนอุปกรณ์</font>
                                    </span>
                                </a></li>
                            <li><a href="approve_stadium.php">
                                    <font color="white"><i class="fas fa-check-circle"></i> </font><span class="item-text">
                                        <font color="white">อนุมัติการจอง</font>
                                    </span>
                                </a></li>
                            <li><a href="stadium_type.php">
                                    <font color="white"><i class="fas fa-pen"></i> </font><span class="item-text">
                                        <font color="white">จองสนาม</font>
                                    </span>
                                </a></li>
                            <!-- <li><a href="stadium_type.php">
								<font color="white"><i class="fas fa-pen"></i> </font><span class="item-text">
									<font color="white">จองสนามกีฬา</font>
								</span>
							</a></li> -->
                            <li><a href="booking_list.php">
                                    <font color="white"><i class="fas fa-database"></i> </font><span class="item-text">
                                        <font color="white">ข้อมูลการจองสนาม</font>
                                    </span>
                                </a></li>
                            <li><a href="borrow_list.php">
                                    <font color="white"><i class="fas fa-database"></i> </font><span class="item-text">
                                        <font color="white">ข้อมูลการยืมอุปกรณ์</font>
                                    </span>
                                </a></li>
                            <li><a href="stadium_manage.php">
                                    <font color="white"><i class="fas fa-whistle"></i></font> <span class="item-text">
                                        <font color="white">จัดการข้อมูลสนาม</font>
                                    </span>
                                </a></li>
                            <li><a href="equipment_manage.php">
                                    <font color="white"><i class="fas fa-futbol"></i></font> <span class="item-text">
                                        <font color="white">จัดการข้อมูลอุปกรณ์</font>
                                    </span>
                                </a></li>
                            <li><a href="member_manage.php">
                                    <font color="white"><i class="fas fa-user-cog"></i> </font><span class="item-text">
                                        <font color="white">จัดการข้อมูลผู้ใช้</font>
                                    </span>
                                </a></li>
                            <li><a href="borrow_report.php">
                                    <font color="white"><i class="fas fa-chart-bar"></i></font> <span class="item-text">
                                        <font color="white">รายงาน</font>
                                    </span>
                                </a></li>
                        </ul>
                    </div>
                </div>

                <div class="btn-group">
                    <a href="#" class="dropdown-toggle text-white text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="usericon"><i class="bi bi-person-circle"></i></span>
                        <span class="textnone"><?php if (isset($_SESSION['username'])) : ?> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['surname']; ?> <?php endif ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <form method="POST" action="profile.php">
                            <li><button class="dropdown-item" type="submit"><i class=" bi-lock-fill"></i> ข้อมูลส่วนตัว</button></li>
                        </form>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <form method="POST" action="logout.php">
                            <li><button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</button></li>
                        </form>
                    </ul>
                </div>


            </div>
        </nav>
    </div>
</body>

</html>




<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>
    <style>
        /*-- Navigation Hover Effects --*/
        .bs4header a.nav-link::before {
            content: '';
            display: block;
            width: 0px;
            height: 2px;
            background: #fff;
            transition: 0.2s;
        }

        .bs4header a.nav-link:hover::before {
            width: 100%;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#checkBtn').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if (!checked) {
                    alert("You must check at least one checkbox.");
                    return false;
                }

            });
        });
    </script>



    <script>
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;

        }

        var result = $.get("fetch-event.php", {
            id: <?php echo $id; ?>
        }, function(data, status) {

            console.log(JSON.parse(data))

            result = JSON.parse(data).map((value) => {
                let date = new Date(value.end_date);

                return {
                    title: value.stadium_name + ' ' + value.firstname + ' ' + value.surname,
                    start: value.start_date,
                    end: date.addDays(1),
                    color: value.color,
                }

            })

            console.log(result)
            return result;
        });


        $(document).ready(function() {

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: result,
                displayEventTime: false,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },


                selectable: true,
                selectHelper: true,

                // select: function(start, end, allDay) {
                //     var title = prompt('Event Title:');

                //     if (title) {
                //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                //         $.ajax({
                //             url: 'add-event.php',
                //             data: 'title=' + title + '&start=' + start + '&end=' + end,
                //             type: "POST",
                //             success: function(data) {
                //                 displayMessage("Added Successfully");
                //             }
                //         });
                //         calendar.fullCalendar('renderEvent', {
                //                 title: title,
                //                 start: start,
                //                 end: end,
                //                 allDay: allDay
                //             },
                //             true
                //         );
                //     }
                //     calendar.fullCalendar('unselect');
                // },
                // events: [
                //     {
                //         title: "TEST", start_time: "2022-02-13", end_time: "2022-02-15"
                //     },{
                //         title: "TEST", date: "2022-03-14"
                //     }
                // ],
                // editable: true,
                // eventDrop: function(event, delta) {
                //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                //     $.ajax({
                //         url: 'edit-event.php',
                //         data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                //         type: "POST",
                //         success: function(response) {
                //             displayMessage("Updated Successfully");
                //         }
                //     });
                // },
                eventClick: function(calEvent, jsEvent, view) {

                    alert('Event: ' + calEvent.title);



                    // change the border color just for fun
                    $(this).css('border-color', 'red');

                }



            });
        });

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function() {
                $(".success").fadeOut();
            }, 1000);
        }
    </script>
</head>
<br><br>
<?php if (isset($_SESSION['user_check'])) : ?>
    <center>
        <div style="font-size: 25px;" class="alert alert-danger user_check">
            <?php
            echo $_SESSION['user_check'];
            unset($_SESSION['user_check']);
            ?>
        </div>
    </center>
<?php endif ?>
<?php if (isset($_SESSION['status_check'])) : ?>
    <center>
        <div style="font-size: 25px;" class="alert alert-danger user_check">
            <?php
            echo $_SESSION['status_check'];
            unset($_SESSION['status_check']);
            ?>
        </div>
    </center>
<?php endif ?>
<?php if (isset($_SESSION['date_check'])) : ?>
    <center>
        <div style="font-size: 25px;" class="alert alert-danger user_check">
            <?php
            echo $_SESSION['date_check'];
            unset($_SESSION['date_check']);
            ?>
        </div>
    </center>
<?php endif ?>
<?php if (isset($_SESSION['biger'])) : ?>
    <center>
        <div style="font-size: 25px;" class="alert alert-danger user_check">
            <?php
            echo $_SESSION['biger'];
            unset($_SESSION['biger']);
            ?>
        </div>
    </center>
<?php endif ?>

<br><br>
<center>
    <h1> ตารางการจอง<?php echo $Stadium['stadium_type_name']; ?> </h1>
</center>

<main class="px-md-4 py-5">
    <div class="container">
        <center>
            <h4>ดูรายละเอียดสนาม</h4>
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM stadium where stadium_type_id = '$id' order by stadium_name asc ");
            while ($row = $sql->fetch_assoc()) {
            ?>
                <a class="btn btn-primary" href="stadium_details.php?id=<?php echo $row['stadium_id']; ?>"><?php echo $row['stadium_name']; ?> |
                    <?php $status = $row['status'];
                    if ($status == 1) {
                        echo "<font color='#3BF552'>เปิด</font>";
                    } else {
                        echo "<font color='red'>ปิด</font>";
                    }
                    ?></a>
            <?php
            }
            ?>
        </center>
        <hr>
        <div style="border-radius: 5px" class="row bg-white p-4">
            <div class="col-md-9 col-sm-12">
                <div class="response"></div>
                <div id='calendar'></div>
            </div>
            <div class="col-md-3 col-sm-12 justify-content-center">
                <b>สถานะการจอง</b>
                <br>
                <div>
                    <a href="javascript:;" class="btn btn-outline-dark px-3 py-3" style="border-radius: 0;"></a> ว่าง
                </div>
                <div>
                    <a href="javascript:;" class="btn btn-success px-3 py-3 " style="border-radius: 0;"></a> ถูกจองเเล้ว
                </div>
                <div>
                    <a href="javascript:;" class="btn btn-warning px-3 py-3 " style="border-radius: 0;"></a> รอการอนุมัติ
                </div>
                <hr>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#booking_1">
                        จองสนามกีฬา 1 วัน
                    </button>
                </div>
                <hr>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#booking_multi">
                        จองสนามกีฬาหลายวัน
                    </button>
                </div>
                <hr>
                <div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="booking_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    include('../connect/conn.php');
                    $sql = "SELECT * FROM stadium_type where stadium_type_id = '$id'";
                    $query = mysqli_query($conn, $sql);

                    $result1 = mysqli_fetch_array($query);
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $result1['stadium_type_name'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="save_booking.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="stadium_type_id" class="form-control" value="<?php echo $result1['stadium_type_id']; ?>" required>
                            <?php
                            include('../connect/conn.php');
                            $sql1 = "SELECT * FROM stadium where stadium_id = '$id'";
                            $query1 = mysqli_query($conn, $sql1);
                            $result = mysqli_fetch_array($query1);
                            ?>
                            <select class="form-control" name="stadium_id" required>
                                <option value="">-- เลือกสนาม --</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM stadium where stadium_type_id = '$id' ");
                                while ($row = $sql->fetch_assoc()) {
                                ?>

                                    <option value="<?php echo $row["stadium_id"]; ?>"><?php echo $row["stadium_name"]; ?></option>

                                <?php
                                }
                                ?>
                            </select>
                            <br>
                            <center>วันที่</center>
                            <input type="date" name="date" value=" " class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
                            <center>
                                <div class="form-check form-check-inline">
                                    <input class="checkboxes form-check-input" type="checkbox" id="inlineCheckbox1" name="start_time" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">ช่วงเช้า</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="checkboxes form-check-input" type="checkbox" id="inlineCheckbox2" name="end_time" value="1">
                                    <label class="form-check-label" for="inlineCheckbox2">ช่วงบ่าย</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="checkboxes form-check-input" type="checkbox" id="inlineCheckbox2" name="over_time" value="1">
                                    <label class="form-check-label" for="inlineCheckbox2">ช่วงค่ำ</label>
                                </div>

                            </center>

                            <hr>
                            <br>
                            <input type="text" name="people" class="form-control" placeholder="จำวนวนคน" maxlength="10" required>
                            <br>
                            <input type="text" name="phone_number" class="form-control" placeholder="เบอร์โทร" maxlength="10" required>
                            <br>

                            <input type="text" name="note" class="form-control" placeholder="หมายเหตุ" maxlength="255" required>
                            <br>

                            <hr>
                            <font color="red">*</font>กรุณากรอกข้อมูลให้ถูกต้องก่อนบันทึกการจอง
                            <br>
                            <font color="red">*</font>ช่วงเช้า(8.30-12.00) ช่วงบ่าย(12.00-20.00)

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button class="btn btn-primary" type="submit" name="upload">บันทึกการจอง</button>
                    </div>
                </form>


            </div>
        </div>


    </div>
    <div class="modal fade" id="booking_multi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?php
                    include('../connect/conn.php');
                    $sql = "SELECT * FROM stadium_type where stadium_type_id = '$id'";
                    $query = mysqli_query($conn, $sql);

                    $result1 = mysqli_fetch_array($query);
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $result1['stadium_type_name'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="<?php if ($_SESSION['member_type'] == "user") { ?>save_booking_user.php  <?php } else { ?> save_booking.php <?php } ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="stadium_type_id" class="form-control" value="<?php echo $result1['stadium_type_id']; ?>" required>
                            <?php
                            include('../connect/conn.php');
                            $sql1 = "SELECT * FROM stadium where stadium_id = '$id'";
                            $query1 = mysqli_query($conn, $sql1);
                            $result = mysqli_fetch_array($query1);
                            ?>
                            <select class="form-control" name="stadium_id" required>
                                <option value="">-- เลือกสนาม --</option>
                                <?php
                                $sql = mysqli_query($conn, "SELECT * FROM stadium where stadium_type_id = '$id' ");
                                while ($row = $sql->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row["stadium_id"]; ?>"><?php echo $row["stadium_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <br>
                            <center>
                                <p>ตั้งเเต่วันที่วันที่</p>
                            </center>
                            <input type="hidden" name="start_time" value="1">
                            <input type="hidden" name="end_time" value="1">
                            <input type="hidden" name="over_time" value="1">
                            <input type="date" name="start_date" value="" class="form-control" required>
                            <center>ถึง </center>
                            <input type="date" name="end_date" value="" class="form-control" required>
                            <hr>
                            <br>
                            <input type="text" name="people" class="form-control" placeholder="จำวนวนคน" maxlength="10" required>
                            <br>
                            <input type="text" name="phone_number" class="form-control" placeholder="เบอร์โทร" maxlength="10" required>
                            <br>
                            <input type="text" name="note" class="form-control" placeholder="หมายเหตุ" maxlength="255" required>
                            <br>

                            <hr>
                            <font color="red">*</font>กรุณากรอกข้อมูลให้ถูกต้องก่อนบันทึกการจอง
                            <br>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button class="btn btn-primary" type="submit" name="upload">บันทึกการจอง</button>
                    </div>
                </form>


            </div>
        </div>


    </div>
    <br>

    </body>

</html>