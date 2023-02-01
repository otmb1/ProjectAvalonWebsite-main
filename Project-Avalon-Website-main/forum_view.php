<?php

// Starting session
session_start();

// if statement that redirects user to the forum error page if user is not signed in
if(!isset($_SESSION["Username"])) {
    header("Location: forum_error.php");
}

$userID = $_SESSION['UUID'];

// Connecting to database
$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");

// if statement that inserts a comment entered by the user on a specific thread to the database
if(isset($_POST['insert'])){
	
	$comment_data = $_POST['CommentData'];
	$comment_data = str_replace("<", "&lt;", $comment_data);
    $comment_data = str_replace(">", "&gt;", $comment_data);
	$thread_id = $_GET['id'];
	$comment_user = $_SESSION['UUID'];
	
	$connect = mysqli_connect("playavalon.co.uk", "donotfai_website_access", "F{=GU+?EJAf$", "donotfai_project_avalon", "3306");
		
	$sql = "INSERT INTO `forum_comments` (`CommentData`, `ThreadID`, `CommentUser`) VALUES ('$comment_data', '$thread_id', '$comment_user')";
	$result = mysqli_query($connect, $sql);
	
	if($result)
	{
		?>
		<div class="alert-confirm-register">
			<div class="alert alert-success fade in">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Success!</strong> Comment has been posted to the thread!
			</div>
		</div>
		<?php
    }
    
    else{
        ?>
		<div class="alert-confirm-regfail">
			<div class="alert alert-danger fade in">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Error!</strong> Please try again.
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
		
		<!-- Section that displays the forum thread that was selected by the user as well as the comments on that thread that are stored in the database which is possible through the 2 SQL statements below -->
		<div class="container-fluid bg-2 text-center">
			<h1 class="margin"><strong>FORUM THREAD</strong></h1>
			<div class="index-content">
				<div class="container my-4">
					<?php
						$thread_id = $_GET['id'];
						$query = "SELECT * from forum_threads WHERE ThreadID=$thread_id";
						$result = mysqli_query($connect,$query);
						while($row = mysqli_fetch_assoc($result)){
							$threadUserID = $row['ThreadUserID'];
							$query2 = "SELECT Username FROM Users WHERE UUID=$threadUserID";
							$result2 = mysqli_query($connect, $query2);
							$row2 = mysqli_fetch_assoc($result2);
							$username = $row2['Username'];
					?>
					<div class="jumbotron">
						<h2><?php echo $row['ThreadTitle']?></h2>
						<hr class="my-4">
						<p><?php echo $row['ThreadDesc']?></p>
						<p>Posted on: <em><?php echo $row['ThreadDate']?></em></p>
						<p style="color:#E2CA02;"><em><?php echo $username ?></em></p>
					</div>
					<?php } ?>
				</div>
				
				<?php echo'
				<div class="container-comment">
					<h2 class="py-2"><strong>Post a Comment</strong></h2> 
						<form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Type your comment</label>
								<textarea type="text" class="form-control" id="CommentData" name="CommentData" rows="3" required></textarea>
							</div>
							<button type="submit" class="btn btn-success" name="insert">Post Comment</button>
						</form> 
				</div>';
				?>
				
				<br></br>
				<?php
					$thread_id = $_GET['id'];
					$query = "SELECT * from forum_comments WHERE ThreadID=$thread_id";
					$result = mysqli_query($connect,$query);
					$noResult = true;
					while($row = mysqli_fetch_assoc($result)){
						$noResult = false;
						$comment_id = $row['CommentID'];
						$comment_data = $row['CommentData']; 
						$comment_date = $row['CommentDate']; 
						$comment_user = $row['CommentUser'];
						$query2 = "SELECT Username FROM Users WHERE UUID=$comment_user";
						$result2 = mysqli_query($connect, $query2);
						$row2 = mysqli_fetch_assoc($result2);
						$username = $row2['Username'];
					
					
					echo '<div class="jumbotron jumbotron-fluid">
							<div class="container">
							   <p class="display-4" align="left" style="color:#E2CA02;">'. $comment_date . '</p>
							   <p class="display-4" align="left" >'. $comment_data . '</p>
							   <p class="display-4" align="left" ><i>'. $username . '</i></p>
							</div>
						</div>';
					}
				
					if($noResult){
					echo '<div class="jumbotron jumbotron-fluid">
							<div class="container">
								<p class="display-4">No Comments Found</p>
								<p class="lead"> Be the first person to comment</p>
							</div>
						 </div>';
					}
				 ?>
				</a>
			</div>
		</div>
		<!-- Call to JavaScript file -->
		<script src="script.js"></script>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright © 2022 | Project Avalon</h2>
		</footer>
	</body>
</html>