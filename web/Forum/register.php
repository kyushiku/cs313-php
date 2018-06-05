
<?php
require("db.php");
$user = htmlspecialchars($_GET["users_id"]);
?>
<!DOCTYPE>
<html>
<form action="create_user.php" method="POST">
<div>Username:</div><input type="text" name="username"><br>
<div>First and Last name:</div><input type="text" name="name"><br>
<div>Password:</div><input type="text" name="pass"><br>

<input type="submit" value="Add User">
</form>
</html>