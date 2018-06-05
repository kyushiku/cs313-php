
<?php
require("db.php");
$user = htmlspecialchars($_GET["users_id"]);
?>
<!DOCTYPE>
<html>
<form action="create_user.php" method="POST">
<input type="hidden" name="users_id" value="<?php echo $title; ?>">
<input type="text" name="username"><br>
<input type="text" name="name"><br>
<input type="text" name="pass"><br>

<input type="submit" value="Add User">
</form>
</html>