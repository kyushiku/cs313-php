
<?php
require("db.php");
?>
<!DOCTYPE>
<html>
<head>
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
if (password_verify($pass, $realPass)){
    echo "real pass!!";
}
else {
    echo "nope";
}
//header("Location: data.php");
?>
</body>

</html>