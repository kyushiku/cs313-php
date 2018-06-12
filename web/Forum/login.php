
<?php
require("db.php");
$user = htmlspecialchars($_GET["users_id"]);
session_start();
if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
}
else
{
    header("Location: data.php");
	die(); // we always include a die after redirects.
}
?>

<!DOCTYPE>
<html>
<head>
<script src="js/uikit.min.js"></script>
<script src="js/uikit-icons.min.js"></script>
<link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<form action="validate.php" method="POST">
<div>Username:</div><input type="text" name="username"><br>
<div>Password:</div><input type="password" name="pass"><br>

<input type="submit" value="Login">
</form>
<a href='register.php' class='uk-button uk-button-text'>Register Here!</a>

</html>