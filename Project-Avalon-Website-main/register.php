<?php

// if statement that collects data inserted by the user
if(isset($_POST['insert'])){
	
	$Username = $_POST['Username'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$PNumber = $_POST['PNumber'];
	
	$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");
		
	$sql = "INSERT into Users (Username, Email, Password, PNumber) values ('$Username','$Email','$Password','$PNumber')";
	$result = mysqli_query($connect, $sql);
	
	
	// if statement that inserts data to the users table of the database
	if($result)
	{
		?>
		<div class="alert-confirm-register">
			<div class="alert alert-success fade in">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> You have successfully registered to <strong>Legends of Avalon!</strong>
			</div>
		</div>
		<?php
    }
    
    else{
        ?>
		<div class="alert-confirm-regfail">
			<div class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Incorrect information entered!</strong> Please try again.
			</div>
		</div>
		<?php
    }
	
}

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
		
		<!-- Section that allows users to enter their information in order to register to the website -->
		<div class="container-fluid bg-3 text-center">
			<div class="register-form">
				<h1 class="margin"><strong>REGISTER</strong></h1>
				 <form action="register.php" method="post">
					<div class="field">
					   <input type="email" name="Email" placeholder="Email Address" required>
					</div>
					<div class="field">
					   <input type="tel" name="PNumber" placeholder="Phone Number" pattern="[0-9]{11}" required>
					</div>
					<div class="field">
					   <input type="text" name="Username" placeholder="Username" required>
					</div>
					<div class="field">
					   <input type="password" id="password" name="Password" placeholder="Password" minlength="8" onkeyup="check();" required>
					</div>
					<div class="field">
					   <input type="password" id="c_password" name="C_Password" placeholder="Confirm Password" onkeyup="check();" required>
					</div>
					<p id="message"></p>
					<button type="submit" id="submit" name="insert" disabled>SIGN UP</button>
				 </form>
			 </div>
			<img src="pictures/loa-character.png" class="char-img" style="max-width:350px;">
		</div>
		<!-- JavaScript that disables the submit button and prints an error message when the password does not match but prints a success message when it does -->
		<script>
			var btnSubmit = document.getElementById("submit");
			var check = function(){
				if (document.getElementById("password").value == document.getElementById("c_password").value) {
					document.getElementById("message").style.color = '#0f0';
					document.getElementById("message").innerHTML = '<span><i class="bi bi-check-circle-fill"></i>Password Matches !</span>';
					btnSubmit.disabled = false;
				} else {
					document.getElementById("message").style.color = '#ff3f34';
					document.getElementById("message").innerHTML = '<span><i class="bi bi-exclamation-circle-fill"></i>Password Does Not Match !</span>';
					btnSubmit.disabled = true;
				}
			}
		</script>
		<!-- Call to JavaScript file -->
		<script src="script.js"></script>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright © 2022 | Project Avalon</h2>
		</footer>
	</body>
</html>