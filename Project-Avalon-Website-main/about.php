<?php

// Starting session
session_start();

// if statement that redirects user to homepage if user is not signed in
if(!isset($_SESSION["Username"])) {
    header("Location: index.php");
}

$userID = $_SESSION['UUID'];

// Connecting to database
$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");

?>
<!DOCTYPE html>
<html lang="en">
	<!-- Calls to Bootstrap, JQuery and the CSS file -->
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="shortcut icon" type="favicon" href="pictures/favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<title>Legends of Avalon</title>
	</head>
	
	<body>
		<!-- Navigation Bar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="home.php"><img style="max-width:170px; margin-top: 7px;" src="Logo-crop.png"></a>
				</div>
				<div class="title"><div class="popup center">
				   <div class="dismiss-btn">
					 <button id="dismiss-popup-btn" style="margin-left: 500px;">
					   X
					 </button>
				   </div>
				   <div class="title">
					 ACCOUNT
				   </div>
				   <div class="message">
					<p><br>Welcome, <?php echo $_SESSION['Username']; ?>!</br></p>
				   </div>
				   <?php
						// if statement that displays the admin option if the user is an admin
						$sql = "SELECT Role FROM PlayerData where UUID = '$userID'";
						$result = mysqli_query($connect,$sql);
						$row = mysqli_fetch_assoc($result);
						if($row["Role"]=="admin")
						{
					?>
					<div class="admin-btn">
					 <button id="admin-popup-btn"><a href="admin.php">
					   ADMINISTRATION
					 </button>
				   </div>
					<?php }
						  else
							{
						  
							}
						  ?>
				   <div class="account-btn">
					 <button id="account-popup-btn"><a href="account.php">
					   VIEW PROFILE
					 </button>
				   </div>
				   <div class="logout-btn">
					 <button id="logout-popup-btn"><a href="logout.php">
					   LOGOUT
					   </a>
					 </button>
				   </div>
				</div>
				<div class="nav-signup">
					<button type="button" id="open-popup-btn" class="bi bi-person-fill"></button>
				</div>
				<nav class="nav-menu">
					<div class="hamburger-menu">
						<div class="line line-1"></div>
						<div class="line line-2"></div>
						<div class="line line-3"></div>
					</div>
					
					<ul class="nav-list">
						<li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="download.php" class="nav-link">Play</a></li>
						<li class="nav-item"><a href="hubcommunity.php" class="nav-link">Community</a></li>
						<li class="nav-item"><a href="board.php" class="nav-link">Leaderboard</a></li>
						<li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
						<li class="nav-item"><a href="questions.php" class="nav-link">FAQ</a></li>
					</ul>
				</nav>
			  </div>
			</div>
		</nav>
		
		<!-- Section highlighting the team members and their roles -->
		<div class="container-fluid bg-3 text-center">
			<h1 class="margin"><strong>ABOUT US</strong></h1>
			<h3 style="margin-top: 50px;"><strong>MEET THE TEAM:</strong></h3>
			<div class="wrapper-grid">
				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Hamzah K.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Game Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">HamzahKhan@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Kishan G.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Game Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">KGodhania@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">John N.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Lead Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">john@playavalon.co.uk</p>
				</div>
			</div>
			<div class="wrapper-grid">
				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Ore D.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Full Stack Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">ODeru@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Daniel A.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">UI Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">DanAddow@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Trent E-C.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Document Specialist & Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">TEllisCalcott@playavalon.co.uk</p>
				</div>
			</div>
			<div class="wrapper-grid">
				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Shriya D.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Document Specialist</p>
				  <p class="aboutus-email" style="font-size: 13px;">sdora@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Sana A.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Document Specialist & Sound Design</p>
				  <p class="aboutus-email" style="font-size: 13px;">sana@playavalon.co.uk</p>
				</div>

				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Mubarek D.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Document Specialist & Web Designer</p>
				  <p class="aboutus-email" style="font-size: 13px;">MDaha@playavalon.co.uk</p>
				</div>
			</div>
			<div class="wrapper-grid">
				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Taran B.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">UI Graphics Designer</p>
				  <p class="aboutus-email" style="font-size: 13px;">TaranB@playavalon.co.uk</p>
				</div>
				<div class="container-aboutus">
				  <div class='banner-img'></div>
				  <img src="pictures/user1.png" alt='profile image' class="profile-img">
				  <h2 class="aboutus-name" style="font-size: 24px;">Abubakr S.</h2>
				  <p class="aboutus-description" style="font-size: 13px;">Developer</p>
				  <p class="aboutus-email" style="font-size: 13px;">Abubakr@playavalon.co.uk</p>
				</div>
			</div>
		</div>
		  <!-- Call to JavaScript file -->
		  <script src="script.js"></script>
		</div>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright © 2022 | Project Avalon</h2>
		</footer>
	</body>
</html>