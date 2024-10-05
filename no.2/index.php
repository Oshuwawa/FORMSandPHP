<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php session_start(); ?>

	<h1>Sample Log in and Log out</h1>

	<?php
	// Display error message if a user is already logged in
	if (isset($_SESSION['error'])) {
		echo "<p style='color:red;'>{$_SESSION['error']}</p>";
		unset($_SESSION['error']); // Clear the error message after displaying
	}
	?>

	<?php if(isset($_SESSION['userName'])): ?>
		<!-- Show this section only if the user is logged in -->
		<h2>
			User logged in: <?php echo $_SESSION['userName']; ?>
		</h2>

		<h2>
			User password: <?php echo $_SESSION['password']; ?>
		</h2>

		
	<?php endif; ?>

	<form action="handleForm.php" method="POST">
		<p><input type="text" placeholder="Username" name="userName"></p>
		<p><input type="password" placeholder="Password here" name="password"></p>
		<p><input type="submit" value="Submit" name="submitBtn"></p>
	</form>
	<?php if(isset($_SESSION['userName'])): ?>
	<form action="unset.php" method="POST">
			<p><input type="submit" value="Logout" name="logoutBtn"></p>
		</form>
	<?php endif; ?>

</body>
</html>
