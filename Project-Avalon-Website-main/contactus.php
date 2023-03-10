<?php

session_start();

if(isset($_SESSION["Username"])) {
    header("Location: contact.php");
}

$connect = mysqli_connect("localhost", "root", "mysql", "avalon");
$db = mysqli_select_db($connect,"users");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="shortcut icon" type="favicon" href="pictures/favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<title>Legends of Avalon</title>
	</head>
	
	<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><img style="max-width:170px; margin-top: 7px;" src="Logo-crop.png"></a>
				</div>
				<div class="title"><div class="popup center">
				   <div class="dismiss-btn">
					 <button id="dismiss-popup-btn" style="margin-left: 500px;">
					   X
					 </button>
				   </div>
				   <?php
					if(isset($_POST['submit'])) {
						$user = $_POST['Username'];
						$pwd = md5($_POST['Password']);
						
						$select = mysqli_query($connect,"select * from users where Username = '$user' and Password = '$pwd'");
						
						$fetch = mysqli_fetch_array($select);
						$userfetch = $fetch['Username'];
						$pwdfetch = $fetch['Password'];	
						
						$usersIDfetch = $fetch['UUID'];
						$emailfetch = $fetch['Email'];
						$phonenumberfetch = $fetch['PNumber'];
						
						// if statement that allows user to sign in if the username and password they entered matches with the username and password stored in the database and redirects them to the home PHP page
						if ($user == $userfetch && $pwd == $pwdfetch) {
							$_SESSION['Username'] = $userfetch;
							$_SESSION['Password'] = $pwdfetch;
							
							$_SESSION['UUID'] = $usersIDfetch;
							$_SESSION['Email'] = $emailfetch;
							$_SESSION['PNumber'] = $phonenumberfetch;
							
							header("Location:home.php");
						}
						else {
							
							header("Location:login.php");
						}
					}

					?>
				   <div class="title">
					 LOGIN
				   </div>
				   <form class="login" action="index.php" method="post">
					  <label for="username">Username:</label><br>
					  <input type="text" id="Username" name="Username"><br>
					  <label for="password">Password:</label><br>
					  <input type="password" id="Password" name="Password">
				   <div class="login-btn">
					 <button type="submit" name="submit" id="login-popup-btn">
					   LOGIN
					 </button>
				   </div>
				   </form>
				   <div class="message">
					<p><br>Not a member?</br></p>
				   </div>
				   <div class="register-btn">
					 <button id="register-popup-btn"><a href="register.php">
					   CREATE ACCOUNT
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
						<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="play.php" class="nav-link">Play</a></li>
						<li class="nav-item"><a href="community.php" class="nav-link">Community</a></li>
						<li class="nav-item"><a href="aboutus.php" class="nav-link">About Us</a></li>
						<li class="nav-item"><a href="contactus.php" class="nav-link">Contact Us</a></li>
					</ul>
				</nav>
			  </div>
			</div>
		</nav>
		
		<div class="container-fluid bg-3 text-center">
			<b class="margin">CONTACT US</b>
			<h3 style="margin-top: 50px; font-weight:700;">Are you unsure about something? Please don???t hesitate to contact us!</h3>
			<h3 style="margin-top: 10px; font-weight:700;">Send us a message through the contact form below or you could directly contact our support team or development team members to report any issues:</h3>
			<section class="mb-4">
				<div class="row">
					<div class="contact">
						<form>
						  <p>
							<label>Username</label>
							<input type="text" name="username" required>
						  </p>
						  <p>
							<label>Email Address</label>
							<input type="email" name="email" required>
						  </p>
						  <p class="full">
							<label>Message</label>
							<textarea name="message" rows="5" required></textarea>
						  </p>
						  <p class="full">
							<button>Submit</button>
						  </p>
						</form>
					 </div>
				</div>
			</section>
		</div>
		<script src="script.js"></script>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright ?? 2021 | Project Avalon</h2>
		</footer>
		<!-- Footer -->
	</body>
</html>