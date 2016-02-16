<?php
session_start();


?>

<html>
<head>
	<title>Log in for the wall</title>
	<h1> Welcome to The Great Wall :) </br>
	<h3> Please register or log in below </h3> 
</head>
<body>

	<!-- Login session start -->
<?php
if(isset($_SESSION['invalid']))
{
	echo $_SESSION['invalid'];
	unset($_SESSION['invalid']);
}


?>

<form method="post" action="process.php">
	<fieldset>
		<legend><h4>LOG IN</h4></legend>
		<h5>Email: <input type="email" name="email"></h5>
		<h5>Password: <input type="password" name="password"></h5>
		<!-- <p><button>Log in here!</button></p> -->
		<input id='submit_box' type='submit' value='Log in Now!'>
		<h5><input type="hidden" name="login"></h5>

	</fieldset>


<!-- log in session end -->

</form>

	<!-- Registration session start-->

<?php
if (isset($_SESSION['user_registered']))
{
 	echo $_SESSION['user_registered'];
 	unset($_SESSION['user_registered']);
 }



 ?>


<form method="post" action="process.php">
	<fieldset>
		<legend><h4>REGISTRATION</h4></legend>
		<label><h5>First Name: <input type="text" name="first_name"></h5>
		<label><h5>Last Name: <input type="text" name="last_name"></h5>
		<label><h5>Email: <input type="email" name="email"></h5>
		<label><h5>Password: <input type="password" name="password"></h5>
		<input id='submit_box' type='submit' value='Register Here!'>
		<label><input type="hidden" name="registration"></p>
	</fieldset>
</form>
<!-- registration session end -->



</body>
</html>