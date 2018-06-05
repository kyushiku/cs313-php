
<?php
require("db.php");
?>
<!DOCTYPE>
<html>
<head></head>
<body>
<?php
$user = htmlspecialchars($_POST["username"]);
$pass = htmlspecialchars($_POST["pass"]);
$passwordHash = password_hash($pass, PASSWORD_DEFAULT);

$db = get_db();
$query = "INSERT INTO users (username, pass) VALUES (:username, :pass)";
$statement = $db->prepare($query);
$statement->bindValue(":username", $user, PDO::PARAM_STR);
$statement->bindValue(":pass", $pass, PDO::PARAM_STR);
$statement->execute();
header("Location: data.php");
?>
</body>

</html>