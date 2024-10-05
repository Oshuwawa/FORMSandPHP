<?php 
session_start();

// Check if submitBtn exists
if(isset($_POST['submitBtn'])) {

	// Get the first name and password from the form
	$userName = $_POST['userName'];
	$password = md5($_POST['password']);

	// Check if a user is already logged in
	if (isset($_SESSION['userName'])) {

		// If the logged-in user is different from the one trying to log in
		if ($_SESSION['userName'] !== $userName) {
			// Display error message but keep the current session
			$_SESSION['error'] = "User {$_SESSION['userName']} is already logged in. You may log in again, or wait for them to log out.";
		}
	} else {
		// If no user is logged in, set the session variables for the new user
		$_SESSION['userName'] = $userName;
		$_SESSION['password'] = $password;

		// Clear any existing error messages
		unset($_SESSION['error']);
	}

	// Go back to index.php
	header('Location: index.php');
}
?>
