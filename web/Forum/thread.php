
<?php
require("db.php");
$title = htmlspecialchars($_GET["threads_id"]);
?>
<!DOCTYPE html>
<html>
<head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<body>
<form action="insert.php" method="POST">
<input type="hidden" name="threads_id" value="<?php echo $title; ?>">
<input type="text" name="title"><br>
<textarea name="desc_text" placeholder="Content"></textarea>

<br><br>
<input type="submit" value="Add Thread">
</form>

</body>
</html>