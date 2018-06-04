
<?php
require("db.php");
$title = htmlspecialchars($_GET["threads_id"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="insert.php" method="POST">
<input type="hidden" name="threads_id" value="<?php echo $title; ?>">
<input type="text" name="title">
<input type="date" name="date"><br>
<textarea name="content" placeholder="Content"></textarea>

<br><br>
<input type="submit" value="Add Thread">
</form>

</body>
</html>