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
include('../connect/conn.php');
$id = $_SESSION['member_id'];
$query = "SELECT * FROM member WHERE member_id = '$id'";
$query_run = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>

<head>

    <title>profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .field {
            font-size: 18px;
        }
    </style>
</head>

<body style="background-image: url('../images/bg.jpg');
backdrop-filter: blur(5px);
background-repeat: no-repeat;
background-size: cover; 
 ">
    <?php include('../include/header.php'); ?>
    <br>
    <div class="container">
        <div id="content" class="card bg-white p-4 content content-full-width">
            <div class="profile">
                <div class="profile-header">
                    <div class="profile-header-cover"></div>
                    <div class="profile-header-content mb-2">
                        <!-- <div class="profile-header-img">
                        <img src="../images/user.png" alt="">
                     </div> -->
                        <!-- <div class="d-flex">
                        <div class="image_outer_container">
                           <div class="green_icon" style="cursor: pointer" id="btnCamera"><i class="fas fa-camera mt-1 ml-1 text-black" style="font-size: 30px"></i></div>
                           <div class="image_inner_container">
                              <img id="img_profile" src="img/profile/user.png">
                           </div>
                           <input type="file" id="my_profile" name="profileImage" style="display: none;">
                        </div>
                     </div> -->
                        <!-- END profile-header-img -->
                        <!-- BEGIN profile-header-info -->
                        <div class="profile-header-info">
                            <?php if (isset($_SESSION['username'])) : ?>
                                <h4 class="mt-0 mb-1"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['surname']; ?></h4>
                                <p class="mb-2"><?php echo $_SESSION['member_type']; ?></p>
                                <!-- <a href="#" class="btn btn-xs btn-yellow">แก้ไขรูป</a> -->
                            <?php endif ?>
                        </div>

                        <!-- END profile-header-info -->
                    </div>
                    <!-- END profile-header-content -->
                    <!-- BEGIN profile-header-tab -->

                    <!-- END profile-header-tab -->
                </div>
            </div>
            <!-- end profile -->
            <!-- begin profile-content -->

            <div class="profile-content px-2">
                <!-- begin table -->
                <div class="table-responsive form-inline">
                    <table class="table table-profile">
                        <thead>
                        </thead>
                        <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                            <?php
                            foreach ($query_run as $row) {
                            ?>
                                <tbody>

                                    <tr>
                                        <td class="field">ชื่อ</td>
                                        <td class="field"><input type="hidden" name="edit_id" value="<?php echo $row['member_id']; ?>" required>
                                            <input type="text" name="name" maxlength="20" style="width: auto;" class="form-control" value="<?php echo $row['firstname'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">นามสกุล</td>
                                        <td class="field"><input type="text" name="surname" maxlength="20" class="form-control" value="<?php echo $row['surname'] ?>" required></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">สถานะ</td>
                                        <td class="field"><input type="text" name="faculty" class="form-control" value="<?php echo $row['faculty'] ?>" required> </td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">สถานะ</td>
                                        <td class="field"><input type="text" name="agency" class="form-control" value="<?php echo $row['agency'] ?>" required> </td>
                                    </tr>
                                    <tr>
                                        <td class="field">เบอร์โทรศัพท์</td>
                                        <td class="field"> <input type="text" name="phone_number" minlength="10" maxlength="10" class="form-control" value="<?php echo $row['phone_number'] ?>" required> </i></td>
                                    </tr>
                                    <tr>
                                        <td class="field">บ้านเลขที่</td>
                                        <td class="field"> <input type="text" name="mbHouseNum" class="form-control" value="<?php echo $row['mbHouseNum'] ?>" required> </i></td>
                                    </tr>
                                    <tr>
                                        <td class="field">จังหวัด</td>
                                        <td class="field"> <input type="text" name="mbProvince" class="form-control" value="<?php echo $row['mbProvince'] ?>" required> </i></td>
                                    </tr>
                                    <tr>
                                        <td class="field">อำเภอ</td>
                                        <td class="field"> <input type="text" name="mbCity" class="form-control" value="<?php echo $row['mbCity'] ?>" required> </i></td>
                                    </tr>
                                    <tr>
                                        <td class="field">ตำบล</td>
                                        <td class="field"> <input type="text" name="mbDistrict" class="form-control" value="<?php echo $row['mbDistrict'] ?>" required> </i></td>
                                    </tr>
                                    <tr>
                                        <td class="field">รหัสไปรษณีย์</td>
                                        <td class="field"> <input type="text" name="mbPostcode" class="form-control" value="<?php echo $row['mbPostcode'] ?>" required> </i></td>
                                    </tr>

                                    <tr class="highlight">
                                        <td class="p-t-10 p-b-10 mx-auto text-center" colspan="2">
                                            <button type="submit" class="btn btn-primary width-150" name="updatebtn">บันทึก</button>
                                            <a class="btn btn-danger btn-white-without-border width-150 m-l-5" href="profile.php">ปิด</a>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </form>
                    </table>
                </div>
                <!-- end table -->
            </div>

            <!-- end profile-content -->
        </div>
        <!-- end #content -->

    </div>

</body>

</html>