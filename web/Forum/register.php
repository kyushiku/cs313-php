
<?php
require("db.php");
$user = htmlspecialchars($_GET["users_id"]);
?>
<!DOCTYPE>
<html>
<head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
    <link rel="stylesheet" href = "style.css">
</head>
<form action="create_user.php" method="POST">
<div>Username:</div><input type="text" name="username"><br>
<div>Password:</div><input type="text" name="pass"><br>

<input type="submit" value="Add User">
</form>
</html>