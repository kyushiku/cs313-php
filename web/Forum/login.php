
<?php
session_start();
$badLogin = false;
// First check to see if we have post variables, if not, just
// continue on as always.
if (isset($_POST['username']) && isset($_POST['pass']))
{
	// they have submitted a username and password for us to check
	$username = $_POST['username'];
	$password = $_POST['pass'];
	// Connect to the DB
	require("db.php");
	$db = get_db();
	$query = 'SELECT pass FROM users WHERE username=:username';
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$result = $statement->execute();
	if ($result)
	{
		$row = $statement->fetch();
		$hashedPasswordFromDB = $row['pass'];
		// now check to see if the hashed password matches
		if (password_verify($password, $hashedPasswordFromDB))
		{
			// password was correct, put the user on the session, and redirect to home
			$_SESSION['username'] = $username;
			header("Location: data.php");
			die(); // we always include a die after redirects.
		}
		else
		{
			$badLogin = true;
		}
	}
	else
	{
		$badLogin = true;
	}
}
// If we get to this point without having redirected, then it means they
// should just see the login form.
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
    <link rel="stylesheet" href = "style.css">
</head>

<body>
<div>

<?php
if ($badLogin)
{
	echo "Incorrect username or password!<br /><br />\n";
}
?>

<h1>Please sign in below:</h1>

<form id="mainForm" action="login.php" method="POST">
<fieldset class="uk-fieldset">
    <legend class="uk-legend">Please sign in below:</legend>
    <div class="uk-margin">
	<div>Username:</div><input type="text" name="username"><br>
    </div>
    <div>Password:</div><input type="password" name="pass"><br>

    <input type="submit" value="Sign In" />
</fieldset>

</form>

<br /><br />

Or <a href="register.php" class='uk-button uk-button-text'>Sign up</a> for a new account.

</div>

</body>
</html>