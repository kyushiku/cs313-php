
<?php
require("db.php");
?>
<!DOCTYPE>
<html>
<head></head>
<body>
<?php
$username = htmlspecialchars($_POST["username"]);
$name = htmlspecialchars($_POST["name"]);
$pass = htmlspecialchars($_POST["pass"]);
$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

$db = get_db();
$query = "INSERT INTO users (username, name, pass) VALUES (:username, :name, :pass)";
$statement = $db->prepare($query);
$statement->bindValue(":username", $username, PDO::PARAM_STR);
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->bindValue(":pass", $passwordHash, PDO::PARAM_STR);
$statement->execute();
header("Location: data.php");
?>
</body>

</html>