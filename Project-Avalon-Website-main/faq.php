<?php

// Starting session
session_start();

// if statement that redirects user to a session-supported related page if user is signed in
if(isset($_SESSION["Username"])) {
    header("Location: questions.php");
}

// Connecting to database
$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");
$db = mysqli_select_db($connect,"Users");

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
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<title>Legends of Avalon</title>
	</head>
	
	<body>
	<!-- Navigation Bar -->
	<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/"><img style="max-width:170px; margin-top: 7px;" src="Logo-crop.png"></a>
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
						$pwd = $_POST['Password'];
						
						$select = mysqli_query($connect,"select * from Users where Username = '$user' and Password = '$pwd'");
						
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
						<li class="nav-item"><a href="/" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="play.php" class="nav-link">Play</a></li>
						<li class="nav-item"><a href="communityhub.php" class="nav-link">Community</a></li>
						<li class="nav-item"><a href="leaderboard.php" class="nav-link">Leaderboard</a></li>
						<li class="nav-item"><a href="aboutus.php" class="nav-link">About Us</a></li>
						<li class="nav-item"><a href="faq.php" class="nav-link">FAQ</a></li>
					</ul>
				</nav>
			  </div>
			</div>
		</nav>
		
		<!-- Section that displays some common questions in regard to the game -->
		<div class="container-fluid bg-3 text-center">
			<b class="margin">FREQUENTLY ASKED QUESTIONS</b>
			<br></br>
			<br></br>
			<section class="faq-container">
				<div class="faq-one">
					<h1 class="faq-page">What is Legends of Avalon (LOA)?</h1>
					<div class="faq-body">
						<p>LOA is a gritty, turn-based medieval RPG which focuses mainly on RPS style combat with a potent but punishing magical twist.</p>
					</div>
				</div>
				<hr class="hr-line">
				<div class="faq-two">
					<h1 class="faq-page">How can I download the game?</h1>
					<div class="faq-body">
						<p>You can only DOWNLOAD this game once you have registered as a member of Legends of Avalon.</p>
					</div>
				</div>
				<hr class="hr-line">
				<div class="faq-three">
				<h1 class="faq-page">What is the development blog?</h1>
					<div class="faq-body">
						<p>The development blog is where we provide the community with more insight into the game with updates which we update weekly on the COMMUNITY page. </p>
					</div>
				</div>
				<hr class="hr-line">
				<div class="faq-four">
				<h1 class="faq-page">Can I access inventory from the game on the website?</h1>
					<div class="faq-body">
						<p>Yes and in order to view the inventory, you need to access the INVENTORY tab on your PROFILE page. </p>
					</div>
				</div>
			</section>
		</div>
		
		<!-- Call to JavaScript file -->
		<script src="script.js"></script>
		<!-- JavaScript that displays the answers to the questions once the expand button is clicked -->
		<script>
		var faq = document.getElementsByClassName("faq-page");
		var i;

		for (i = 0; i < faq.length; i++) {
			faq[i].addEventListener("click", function () {
				this.classList.toggle("active");

				var body = this.nextElementSibling;
				if (body.style.display === "block") {
					body.style.display = "none";
				} else {
					body.style.display = "block";
				}
			});
		}
		</script>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright ?? 2022 | Project Avalon</h2>
		</footer>
	</body>
</html>