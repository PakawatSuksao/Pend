<!-- <html lang="en">

<head>
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
			box-shadow: 0 0 4px rgba(0, 0, 0, .1);
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

		.navbar .nav-item.open>a {
			background: none !important;
		}

		.navbar .dropdown-menu {
			border-radius: 1px;
			border-color: #e5e5e5;
			box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
		}

		.navbar .dropdown-menu a {
			color: #777;
			padding: 8px 20px;
			line-height: normal;
		}

		.navbar .dropdown-menu a:hover,
		.navbar .dropdown-menu a:active {
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

		.navbar a.notifications,
		.navbar a.messages {
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

		.navbar .active a,
		.navbar .active a:hover,
		.navbar .active a:focus {
			background: transparent !important;
		}

		@media (min-width: 1200px) {
			.form-inline .input-group {
				width: 300px;
				margin-left: 30px;
			}
		}

		@media (max-width: 1199px) {
			.form-inline {
				display: block;
				margin-bottom: 10px;
			}

			.input-group {
				width: 100%;
			}

		}

		#calendar {
			width: 700px;
			margin: 0 auto;
		}

		.response {
			height: 60px;
		}

		.success {
			background: #cdf3cd;
			padding: 10px 60px;
			border: #c3e6c3 1px solid;
			display: inline-block;
		}
	</style>

	<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-xl navbar-light bg-light">
		<a href="#" class="navbar-brand"></i>RMUTT<b>ระบบจองสนามกีฬา</b></a>
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
			<div class="navbar-nav" id="myDIV">
				<a href="#" class="nav-item nav-link">Home</a>
				<a href="stadium_type.php" class="nav-item nav-link">จองสนามกีฬา</a>
				<?php if ($_SESSION['status'] == "student") : ?>
					<a href="equipment_type.php" class="nav-item nav-link">ยืมอุปกรณ์กีฬา</a>
				<?php endif ?>


			</div>

			<div class="navbar-nav ml-auto">
				<div class="nav-item dropdown  ">
					<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action fa fa-user-o"> <?php if (isset($_SESSION['username'])) : ?> <?php echo $_SESSION['member_name']; ?> <?php echo $_SESSION['surname']; ?> <?php endif ?> <b class="caret"></b></a>
					<div class="dropdown-menu">
						<a href="profile.php" class="dropdown-item"> ข้อมูลส่วนตัว</a>
						<a href="booking_list.php" class="dropdown-item"> ประวัติการจองสนาม</a>
						<?php if ($_SESSION['status'] == "student") : ?>
							<a href="borrow_list.php" class="dropdown-item"> ประวัติการยืมคืนอุปกณ์</a>
						<?php endif ?>
						<div class="dropdown-divider"></div>
						<a href="logout.php" class="dropdown-item"><i class="material-icons"></i> ออกจากระบบ</a>
					</div>
				</div>
			</div>
		</div>
	</nav>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
	<title>How To create Bootstrap 4 Navbar With Starter Template</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../user_page/asset/js/jquery.signature.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../user_page/asset/css/jquery.signature.css">



	<style>
		/*-- Navigation Hover Effects --*/
		.bs4header a.nav-link::before {
			content: '';
			display: block;
			width: 0px;
			height: 2px;
			background: #fff;
			transition: 0.2s;
			background-color: #3D5B95;
		}

		.bs4header a.nav-link:hover::before {
			width: 100%;
		}
	</style>
</head>

<body>
	<header class="bs4header" style="background-color:#3D5B95;">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
				<a class="navbar-brand" href="#"><b><i><img src="../images/logo.png" width="20"></i></b></a><a class="navbar-brand" href="#"><b><i>RMUTT ระบบจองสนามกีฬา</i></b></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="bs4navbar">
					<ul class="navbar-nav ml-auto">

						<li class="nav-item">
							<a href="stadium_type.php" class="nav-link" href="#"><i class="fas fa-pen"></i>&nbspจองสนามกีฬา</a>
						</li>
						<?php if ($_SESSION['member_type'] == "student") : ?>
							<li class="nav-item">
								<a href="equipment_type.php" class="nav-link" href="#"><i class="fas fa-table-tennis"></i>&nbspยืมอุปกรณ์กีฬา</a>
							</li>

						<?php endif ?>

						</li>
						<li class="dropdown">
							<button style="background-color : white;" class="btn btn-light dropdown-toggle ml-lg-5" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if (isset($_SESSION['username'])) : ?> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['surname']; ?> <?php endif ?></button>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="profile.php">ข้อมูลส่วนตัว</a>
								<a class="dropdown-item" href="booking_list.php">ประวัติการจองสนาม</a>
								<?php if ($_SESSION['member_type'] == "student") : ?>
									<a class="dropdown-item" href="borrow_list.php">ประวัติการยืมคืนอุปกณ์</a>
								<?php endif ?>
								<hr class="dropdown-divider">
								<a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

	<!-- Body Content Here -->

</body>

</html>