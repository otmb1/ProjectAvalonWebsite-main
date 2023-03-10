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
		
		<div class="container-fluid bg-3 text-center">
			<h1 class="margin"><strong>STATISTICS</strong></h1>
			<!-- Section that displays the user's player data in table format as well as the player's number of battles played, number of wins and win percentage rate from the database which is possible through the 4 SQL statements below -->
			<h3 style="margin-top: 50px;"><strong>MY PLAYER DATA :</strong></h3>
			<table class="content-table">
			  <thead>
				<tr>
				  <th width="20%" style="text-align:center;">Class</th>
				  <th width="10%" style="text-align:center;">Level</th>
				  <th width="30%" style="text-align:center;">Experience (XP)</th>
				  <th width="15%" style="text-align:center;">Role</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
						$sql = "SELECT * FROM PlayerData where UUID = '$userID'";
						$result = mysqli_query($connect,$sql);
						$noResult = true;
						while($row = mysqli_fetch_assoc($result))
						{
							$noResult = false;
							$sql2 = "SELECT Winner, count(Winner) as wins FROM Battles where Winner = '$userID'";
							$result2 = mysqli_query($connect, $sql2);
							$row2 = mysqli_fetch_assoc($result2);
							$winnerCount = $row2['wins'];
							$sql3 = "SELECT Player1, count(Player1) as P1games FROM Battles where Player1 = '$userID'";
							$result3 = mysqli_query($connect, $sql3);
							$row3 = mysqli_fetch_assoc($result3);
							$p1GamesCount = $row3['P1games'];
							$sql4 = "SELECT Player2, count(Player2) as P1games FROM Battles where Player2 = '$userID'";
							$result4 = mysqli_query($connect, $sql4);
							$row4 = mysqli_fetch_assoc($result4);
							$p2GamesCount = $row4['P1games'];
							$gamesCount = $p1GamesCount + $p2GamesCount;
							$winPercentage = 100 * $winnerCount / $gamesCount;
							
						    echo '<tr>
								   <td>'.$row['Class'].'</td>
								   <td>'.$row['Level'].'</td>
								   <td><strong>'.$row['Experience'].'</strong></td>
								   <td style="text-transform:uppercase">'.$row['Role'].'</td>
								  </tr>
								  
								  <table class="pdata-table">
									  <tbody>
										<tr>
										  <th style="text-align:center;">Battles</th>
										  <td>'.$gamesCount.'</td>
										</tr>
										<tr>
										  <th width="150px" style="text-align:center;">Wins</th>
										  <td width="150px">'.$winnerCount.'</td>
										</tr>
										<tr>
										  <th style="text-align:center;">Win Rate (%)</th>
										  <td>'.$winPercentage.'%</td>
										</tr>
									  </tbody>
									</table>';
						}
								
						if($noResult){
							  echo '<tr>
									  <td>N/A</td>
									  <td>N/A</td>
									  <td>N/A</td>
									  <td>N/A</td>
									</tr>';
						}
						?>
			  </tbody>
			</table>
			<br></br>
			
			<!-- Section that displays the user's battle history from the game which is possible through the 4 SQL statements below -->
			<h3 style="margin-top: 50px;"><strong>BATTLE HISTORY :</strong></h3>
			<table class="content-table">
			  <thead>
				<tr>
				  <th width="20%" style="text-align:center;">Player 1</th>
				  <th width="10%" style="text-align:center;">Player 2</th>
				  <th width="30%" style="text-align:center;">Winner</th>
				  <th width="10%" style="text-align:center;">Turn Count</th>
				  <th width="20%" style="text-align:center;">Date</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
						$sql = "SELECT * FROM Battles WHERE Player1 = '$userID' or Player2 = '$userID' ORDER BY TimeFinished DESC";
						$result = mysqli_query($connect,$sql);
						$noResult = true;
						while($row = mysqli_fetch_assoc($result))
						{
							$noResult = false;
							$GameMode = $row['GameMode'];
							$Player1 = $row['Player1']; 
							$Player2 = $row['Player2']; 
							$Winner = $row['Winner'];
							$TurnCount = $row['TurnCount'];
							$Date = $row['TimeFinished'];
							$query2 = "SELECT Username FROM Users WHERE UUID=$Player1";
							$result2 = mysqli_query($connect, $query2);
							$row2 = mysqli_fetch_assoc($result2);
							$username1 = $row2['Username'];
							$query3 = "SELECT Username FROM Users WHERE UUID=$Player2";
							$result3 = mysqli_query($connect, $query3);
							$row3 = mysqli_fetch_assoc($result3);
							$username2 = $row3['Username'];
							$query4 = "SELECT Username FROM Users WHERE UUID=$Winner";
							$result4 = mysqli_query($connect, $query4);
							$row4 = mysqli_fetch_assoc($result4);
							$winnerName = $row4['Username'];
					
					
					  echo '<tr>
							  <td>'.$username1.'</td>
							  <td>'.$username2.'</td>
							  <td><strong>'.$winnerName.'</strong></td>
							  <td>'.$TurnCount.'</td>
							  <td>'.$Date.'</td>
							</tr>';
						}
				
				if($noResult){
					  echo '<tr>
							  <td>N/A</td>
							  <td>N/A</td>
							  <td>N/A</td>
							  <td>N/A</td>
							  <td>N/A</td>
							</tr>';
					}
					?>
			  </tbody>
			</table>
			
		</div>
		  <!-- Call to JavaScript file -->
		  <script src="script.js"></script>
		</div>
		<!-- Footer -->
		<footer class="footer bg-4 text-center">
			<h2>Copyright ?? 2022 | Project Avalon</h2>
		</footer>
	</body>
</html>