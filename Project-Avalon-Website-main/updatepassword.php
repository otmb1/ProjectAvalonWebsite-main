<?php

// Starting session
session_start();

// if statement that redirects user to homepage if user is not signed in
if(!isset($_SESSION["Username"])) {
    header("Location: index.php");
}

// Connecting to database
$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");

// if statement that collects the passwords inserted by the user
if(isset($_POST['update'])) {
	$o_password = $_POST['o_password'];
	$n_password = $_POST['n_password'];
	$cn_password = $_POST['cn_password'];
	$UUID = $_SESSION['UUID'];
	
	$select = mysqli_query($connect, "SELECT Password FROM Users where UUID = '$UUID' AND Password = '$o_password'");		
	
	$fetch = mysqli_fetch_array($select);
	$passwordfetch = $fetch['Password'];
	
	// if statement that updates the database based on the passwords entered by the user only if the current password matches the password fetched on the database and the new password matches the confirmation field
	if ($o_password == $passwordfetch) {
		$result = mysqli_query($connect, "UPDATE Users SET Password = '$n_password' where UUID = '$UUID'");
		if($result){
			
		}
		else {
			?>
			<div class="alert-confirm-regfail">
				<div class="alert alert-danger fade in">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Failed To Update Password!</strong> Please try again later.
				</div>
			</div>
			<?php
		}
	?>	
	<div class="alert-confirm-register">
		<div class="alert alert-success fade in">
			<a href="#" class="close" data-dismiss="alert">&times;</a>
			<strong>Success!</strong> Your password has been updated!
		</div>
	</div>
		<?php
		
	}
	else {
		?>
		<div class="alert-confirm-regfail">
			<div class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Incorrect Current Password!</strong> Please try again.
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
		
		<!-- Section that allows users to update their password with a confirmation check -->
		<div class="container-fluid bg-3 text-center">
			<div class="register-form">
				<h1 class="margin"><strong>UPDATE PASSWORD</strong></h1>
				 <form action="updatepassword.php" method="post">
					<div class="field">
					   <input type="password" id="o_password" name="o_password" placeholder="Current Password" required>
					</div>
					<div class="field">
					   <input type="password" id="n_password" name="n_password" placeholder="New Password" minlength="8" onkeyup="check();" required>
					</div>
					<div class="field">
					   <input type="password" id="cn_password" name="cn_password" placeholder="Confirm New Password" onkeyup="check();" required>
					</div>
					<p id="message"></p>
					<button type="submit" id="submit" name="update" disabled>UPDATE</button>
				 </form>
			 </div>
			<img src="pictures/loa-character.png" class="char-img" style="max-width:350px;">
		</div>
		<!-- JavaScript that disables the submit button and prints an error message when the password does not match but prints a success message when it does -->
		<script>
			var btnSubmit = document.getElementById("submit");
			var check = function(){
				if (document.getElementById("n_password").value == document.getElementById("cn_password").value) {
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