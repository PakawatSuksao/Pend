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


$result = mysqli_query($conn, "select * from member ");

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
    <?php if (isset($_SESSION['addmembersuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['addmembersuc'];
                unset($_SESSION['addmembersuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['updatemembersuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['updatemembersuc'];
                unset($_SESSION['updatemembersuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['delmembersuc'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-success user_check">
                <?php
                echo $_SESSION['delmembersuc'];
                unset($_SESSION['delmembersuc']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <?php if (isset($_SESSION['memberalready'])) : ?>
        <center>
            <div style="font-size: 25px;" class="alert alert-danger user_check">
                <?php
                echo $_SESSION['memberalready'];
                unset($_SESSION['memberalready']);
                ?>
            </div>
        </center>
    <?php endif ?>
    <br>


    <center>
        <h1> จัดการข้อมูลผู้ใช้ </h1>
    </center>
    <main class="   px-md-4 py-5">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmember">
                เพิ่มข้อมูลผู้ใช้
            </button>
        </div>
        <hr>
        <div class="card bg-white p-4 table-responsive">
            <table id="table11" class="table table-bordered table-striped mb-0" style="background-color: DEF1FA;">
                <thead class="thead" style="background-color: 8FB7DB;">
                    <tr>

                        <th class="text-center f-s-10 px-1" nowrap> ชื่อ </th>
                        <th class="text-center f-s-10 px-1" nowrap> นามสกุล </th>
                        <th class="text-center f-s-10 px-1" nowrap> ชื่อผู้ใช้ </th>
                        <th class="text-center f-s-10 px-1" nowrap> เบอร์โทร </th>
                        <th class="text-center f-s-10 px-1" nowrap> คณะ </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะภาพ </th>
                        <th class="text-center f-s-10 px-1" nowrap> สถานะ </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                        <th class="text-center f-s-10 px-1" nowrap> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {




                    ?>
                        <tr>


                            <td class="text-center f-s-10 px-1"> <?php echo $row['firstname']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['surname']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['username']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['phone_number']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['faculty']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['agency']; ?></td>
                            <td class="text-center f-s-10 px-1"> <?php echo $row['member_type']; ?></td>


                            <td class="text-center f-s-10 px-1">
                                <form action="edit_member.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['member_id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-primary"> แก้ไขข้อมูล</button>
                                </form>
                            </td>
                            <td class="text-center f-s-10 px-1">
                                <form action="delete_member.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['member_id']; ?>">
                                    <button type="submit" name="delete_btn" class="btn btn-danger"> ลบข้อมูล</button>
                                </form>

                            </td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

        <div class="modal fade" id="addmember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลผู้ใช้</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="save_member.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="ชื่อ" required>
                                <br>
                                <input type="text" name="surname" class="form-control" placeholder="นามสกุล" required>
                                <br>
                                <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
                                <br>
                                <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                                <br>
                                <input type="text" name="phone_number" class="form-control" placeholder="เบอร์โทร" required>
                                <br>
                                <select name="faculty" class="form-control">
                                    <option>-- คณะ --</option>
                                    <option value="คณะศิลปศาสตร์">คณะศิลปศาสตร์</option>
                                    <option value="คณะครุศาสตร์อุตสาหกรรม">คณะครุศาสตร์อุตสาหกรรม</option>
                                    <option value="คณะเทคโนโลยีการเกษตร">คณะเทคโนโลยีการเกษตร</option>
                                    <option value="คณะวิศวกรรมศาสตร์">คณะวิศวกรรมศาสตร์</option>
                                    <option value="คณะบริหารธุรกิจ">คณะบริหารธุรกิจ</option>
                                    <option value="คณะเทคโนโลยีคหกรรมศาสตร์">คณะเทคโนโลยีคหกรรมศาสตร์</option>
                                    <option value="คณะศิลปกรรมศาสตร์">คณะศิลปกรรมศาสตร์</option>
                                    <option value="คณะเทคโนโลยีสื่อสารมวลชน">คณะเทคโนโลยีสื่อสารมวลชน</option>
                                    <option value="คณะวิทยาศาสตร์และเทคโนโลยี">คณะวิทยาศาสตร์และเทคโนโลยี</option>
                                    <option value="คณะสถาปัตยกรรมศาสตร์">คณะสถาปัตยกรรมศาสตร์</option>
                                    <option value="คณะการแพทย์บูรณาการ">คณะการแพทย์บูรณาการ</option>
                                    <option value="คณะพยาบาลศาสตร์">คณะพยาบาลศาสตร์</option>
                                </select>
                                <br>
                                <select name="agency" class="form-control">
                                    <option>-- สถานะ --</option>
                                    <option value="ผู้ใช้ทั่วไป">ผู้ใช้ทั่วไป</option>
                                    <option value="นักศึกษา">นักศึกษา</option>
                                    <option value="อาจารย์">อาจารย์</option>
                                </select>
                                <br>
                                <input type="text" name="mbHouseNum" class="form-control" placeholder="บ้านเลขที่" required>
                                <br>
                                <input type="text" name="mbProvince" class="form-control" placeholder="จังหวัด" required>
                                <br>
                                <input type="text" name="mbCity" class="form-control" placeholder="อำเภอ" required>
                                <br>
                                <input type="text" name="mbDistrict" class="form-control" placeholder="ตำบล" required>
                                <br>
                                <input type="text" name="mbPostcode" class="form-control" placeholder="รหัสไปรษณีย์" required>
                                <br>
                                <select name="status" class="form-control">
                                    <option>-- สถานะ --</option>
                                    <option value="User">ผู้ใช้ทั่วไป</option>
                                    <option value="student">นักศึกษา</option>
                                    <option value="Admin">ผู้ดูแลระบบ</option>
                                </select>
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