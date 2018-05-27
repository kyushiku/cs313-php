<?php
try
{
    $dbUrl = getenv('DATABASE_URL');
    $dbopts = parse_url($dbUrl);
    
    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');
    
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1>PUBG Forum</h1>

    <ul>
<?php
$users = $_GET["users"];
$query = "SELECT u.name, u.pass FROM users u";
$statement = $db->prepare($query);
$statement->bindValue(":users", $users, PDO::PARAM_STR);
$statement->execute();
foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $users)
{
    $name = $users["name"];
    $pass = $users["pass"];
    
    echo "<li>$name ($pass) - Rated $pass</li>";
}
?>
    </ul>

</body>
</html>