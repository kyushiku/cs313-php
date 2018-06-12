<?php
require("db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<body>
<form action="insertComment.php" method="POST">
<textarea name="comm_text" placeholder="Content"></textarea>
<br><br>
<input type="submit" value="Add Thread">
</form>
</body>
</html>