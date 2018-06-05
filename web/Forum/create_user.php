
<?php
require("db.php");
?>
<!DOCTYPE>
<html>
<head></head>
<body>
<?php
$username = htmlspecialchars($_POST["username"]);
$user = htmlspecialchars($_POST["user"]);
$pass = htmlspecialchars($_POST["pass"]);
$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

$db = get_db();
$query = "INSERT INTO users (username, user, pass) VALUES (:username, :user, :pass)";
$statement = $db->prepare($query);
$statement->bindValue(":username", $username, PDO::PARAM_STR);
$statement->bindValue(":user", $user, PDO::PARAM_STR);
$statement->bindValue(":pass", $pass, PDO::PARAM_STR);
$statement->execute();
header("Location: data.php");
?>
</body>

</html>