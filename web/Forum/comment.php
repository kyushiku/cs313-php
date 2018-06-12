<?php
require("db.php");
//$title = htmlspecialchars($_GET["threads_id"]);
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
<input type="hidden" name="threads_id" value="<?php echo $_POST['thread_id']; ?>d">
<br><br>
<input type="submit" value="Comment">
</form>
</body>
</html>