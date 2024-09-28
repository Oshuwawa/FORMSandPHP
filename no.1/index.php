<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	 <!-- The form submits to the same page using GET method -->
	<form action="testGet.php" method="GET">

		<!-- Input field for the username. Take note of the value stored in the name attribute -->
		<p>A<input type="text" placeholder="value here" name="num1"></p>
		<p>B<input type="text" placeholder="value here" name="num2"></p>
		<p>C<input type="text" placeholder="value here" name="num3"></p>
		<!-- Submit button -->
		<p><input type="submit" value="Submit" name="getDisc"></p>
	</form>
</body>
</html>