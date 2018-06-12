
<!DOCTYPE>
<html>
<head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<body>
<?php
//require("password.php");
// get the data from the POST
$username = $_POST['username'];
$password = $_POST['pass'];
if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: login.php");
	die(); // we always include a die after redirects.
}
// Let's not allow HTML in our usernames. It would be best to also detect this before
// submitting the form and preven the submission.
$username = htmlspecialchars($username);
// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// Connect to the database
require("db.php");
$db = get_db();
$query = 'INSERT INTO login(username, password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
// **********************************************
// NOTICE: We are submitting the hashed password!
// **********************************************
$statement->bindValue(':password', $hashedPassword);
$statement->execute();
// finally, redirect them to the sign in page
header("Location: login.php");
die(); 
?>
</body>

</html>