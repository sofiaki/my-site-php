<?php require 'myCookieSet.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>MySite</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	
	<link rel="stylesheet" href="mysite.css">
		<!--Bootstrap bundle-->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	
	<!--Javascript password length check -->
	<script type="text/javascript" src="script/validateEmails.js"></script>
	<!--Javascript email validation -->
	<script type="text/javascript" src="script/validatePasswords.js"></script>
	
</head>
<body>
	<header>
	<div class="container-fluid">
            <?php require 'myCookieCheck.php';?>
		<div class="row" id="headerdiv">
		<!--Logo-->
			<div class="col-lg-3 align-self-center">
				<a href="./login.php"><img  class="mylogo" src="images/logo2.png"  alt="logo"></a>
			</div>
			<div class="col-lg-6 text-center">
				<p class="header-title">MySite</p><p class="header-p">A sample site made with bootstrap and custom CSS</p>
			</div>
			<!--Check for logged member-->
			<div class="col-lg-3 logged">
				<?php 
					if(isset($_SESSION['name'])){
						echo $_SESSION['name'].' '.$_SESSION['surname'].
						'</br>
						<a href="./logout.php">Logout</a>';
					}
					else echo '<a href="./login.php">Login</a>';
					?>
                                          
			</div>
		</div>	
	<!--Menu-->
		<div class="row mymenu">
			<div class="col-lg-12 p-0">
				<ul class="nav nav-pills nav-fill ">
					<li class="nav-item ">
						<a href="./login.php" class="nav-link" >Home</a>
					</li>

					<li class="nav-item">
						<a href="./login.php" class=" nav-link text-decoration-none text-dark">Courses</a>
					</li>
					<!--Dropdown menu-->
					<li class="nav-item dropdown">
						<a class="nav-link text-dark" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">Staff</a>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="./login.php">Professors</a>      
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="./login.php">Administration</a>
						</div>
					<li class="nav-item">
						<a href="./login.php" class="nav-link">Study Regulation</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	</header>