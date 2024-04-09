<!-- <html lang="en"><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap All in One Navbar</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	background: #eeeeee;
}
.form-inline {
	display: inline-block;
}
.navbar-header.col {
	padding: 0 !important;
}
.navbar {		
	background: #fff;
	padding-left: 16px;
	padding-right: 16px;
	border-bottom: 1px solid #d6d6d6;
	box-shadow: 0 0 4px rgba(0,0,0,.1);
}
.nav-link img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin: -8px 0;
	float: left;
	margin-right: 10px;
}
.navbar .navbar-brand {
	color: #555;
	padding-left: 0;
	padding-right: 50px;
	font-family: 'Merienda One', sans-serif;
}
.navbar .navbar-brand i {
	font-size: 20px;
	margin-right: 5px;
}
.search-box {
	position: relative;
}	
.search-box input {
	box-shadow: none;
	padding-right: 35px;
	border-radius: 3px !important;
}
.search-box .input-group-addon {
	min-width: 35px;
	border: none;
	background: transparent;
	position: absolute;
	right: 0;
	z-index: 9;
	padding: 7px;
	height: 100%;
}
.search-box i {
	color: #a0a5b1;
	font-size: 19px;
}
.navbar .nav-item i {
	font-size: 18px;
}
.navbar .dropdown-item i {
	font-size: 16px;
	min-width: 22px;
}
.navbar .nav-item.open > a {
	background: none !important;
}
.navbar .dropdown-menu {
	border-radius: 1px;
	border-color: #e5e5e5;
	box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .dropdown-menu a {
	color: #777;
	padding: 8px 20px;
	line-height: normal;
}
.navbar .dropdown-menu a:hover, .navbar .dropdown-menu a:active {
	color: #333;
}	
.navbar .dropdown-item .material-icons {
	font-size: 21px;
	line-height: 16px;
	vertical-align: middle;
	margin-top: -2px;
}
.navbar .badge {
	color: #fff;
	background: #f44336;
	font-size: 11px;
	border-radius: 20px;
	position: absolute;
	min-width: 10px;
	padding: 4px 6px 0;
	min-height: 18px;
	top: 5px;
}
.navbar a.notifications, .navbar a.messages {
	position: relative;
	margin-right: 10px;
}
.navbar a.messages {
	margin-right: 20px;
}
.navbar a.notifications .badge {
	margin-left: -8px;
}
.navbar a.messages .badge {
	margin-left: -4px;
}	
.navbar .active a, .navbar .active a:hover, .navbar .active a:focus {
	background: transparent !important;
}
@media (min-width: 1200px){
	.form-inline .input-group {
		width: 300px;
		margin-left: 30px;
	}
}
@media (max-width: 1199px){
	.form-inline {
		display: block;
		margin-bottom: 10px;
	}
	.input-group {
		width: 100%;
	}
}
</style>
<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script></head> 
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-light">
	<a href="#" class="navbar-brand"></i>RMUTT<b>ระบบจองสนามกีฬา</b></a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<div class="navbar-nav" id="myDIV">
			<a href="#" class="nav-item nav-link">Home</a>
			<a href="return_equipment.php" class="nav-item nav-link">รับคืนอุปกรณ์</a>
			<a href="booking_list.php" class="nav-item nav-link">ข้อมูลการจองสนาม</a>
			<a href="borrow_list.php" class="nav-item nav-link">ข้อมูลการยืมอุปกรณ์</a>
			<a href="stadium_manage.php" class="nav-item nav-link">จัดการข้อมูลสนาม</a>
			<a href="equipment_manage.php" class="nav-item nav-link">จัดการข้อมูลอุปกรณ์กีฬา</a>
			<a href="borrow_report.php" class="nav-item nav-link">รายงาน</a>
			
		</div>
		   
		<div class="navbar-nav ml-auto">
			<div class="nav-item dropdown  ">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action fa fa-user-o"> <?php if (isset($_SESSION['username'])) : ?> <?php echo $_SESSION['name']; ?> <?php echo $_SESSION['surname']; ?> <?php endif ?>  <b class="caret"></b></a>
				<div class="dropdown-menu">
					<a href="profile.php" class="dropdown-item"> ข้อมูลส่วนตัว</a>
					<div class="dropdown-divider"></div>
					<a href="logout.php" class="dropdown-item"><i class="material-icons"></i> ออกจากระบบ</a>
				</div>
			</div>
		</div>
	</div>
</nav>

                            </body></html> -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
</style>


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