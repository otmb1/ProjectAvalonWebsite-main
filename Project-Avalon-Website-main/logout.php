<?php
	
	// Starting session
	session_start();
	
	// if statement that destroys the session and redirects user to the homepage
	if(session_destroy()){
		header("location: /");
	}

?>