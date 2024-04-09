<?php

session_start();

if ($_SESSION['member_id'] == "") {
    $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header('location: ../login.php');
}

if ($_SESSION['member_type'] == "admin") {
    $_SESSION['msg'] = "หน้าสำหรับผู้ใช้";

    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองสนามกีฬา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        .centered {
            position: absolute;
            text-align: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            backdrop-filter: blur(50px);
        }

        b {
            text-shadow: 2px 2px 5px #000000;
        }

        h1 {
            height: 500%;
            color: #FFF;
            padding-top: 0px;
            font-size: 100px;
            line-height: 100px;
            padding-bottom: 25px;
            text-transform: uppercase;
            font-weight: 700;
            text-shadow: 3px 3px 2px #000000;
        }

        div.card {
            border: 5px solid black;

            background-image: url(f_t.jpg);
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


    <div class="album py-5">
        <center>
            <h1>สนามกีฬา</h1>
        </center>
        <br>
        <div class="container">
            <div class="row">
                <?php
                include('../connect/conn.php');
                $sql = "SELECT * FROM stadium_type  ";
                $query = mysqli_query($conn, $sql);

                while ($result = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-md-3">
                        <div class="pb-4">
                            <a href="booking.php?id=<?= $result['stadium_type_id'] ?>">
                                <div class="card">
                                    <img src="../images/<?php echo $result['image']; ?>" while="100%" height="216" />

                                    <div class="centered">
                                        <font color="white" size="5"><b class="text-center "><?php echo $result['stadium_type_name']; ?></b></font>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>