<?php
$title = htmlspecialchars($_POST["title"]);
$content = htmlspecialchars($_POST["desc_text"]);
$category = htmlspecialchars($_POST["categories_id"]);
$user_id = htmlspecialchars($_SESSION["users_id"]);

require("db.php");
$db = get_db();
$query = "INSERT INTO threads (title, desc_text, categories_id, users_id) VALUES (:title, :desc_text, :category ,:user_id)";
$statement = $db->prepare($query);
$statement->bindValue(":title", $title, PDO::PARAM_INT);
$statement->bindValue(":desc_text", $content, PDO::PARAM_STR);
$statement->bindValue(":category", $category, PDO::PARAM_INT);
$statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
$statement->execute();
header("Location: data.php");
die();
?>