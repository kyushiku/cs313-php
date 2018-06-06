
<?php
require("db.php");
?>
<!DOCTYPE>
<html>
<head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<body>
<?php
$username = htmlspecialchars($_POST["username"]);
$pass = htmlspecialchars($_POST["pass"]);


$db = get_db();
$query = "SELECT pass FROM users WHERE username = :username";
$statement = $db->prepare($query);
$statement->bindValue(":username", $username, PDO::PARAM_STR);
$statement->execute();
$realPass = $statement->fetch();


if (password_verify($pass, $realPass["pass"])){
    header("Location: data.php");
}
else {
    echo "Wrong Password";
}
?>
</body>

</html>