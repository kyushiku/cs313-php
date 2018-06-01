<?php
$title = htmlspecialchars($_POST["title"]);
$content = htmlspecialchars($_POST["desc_text"]);

// echo "Course: $courseId\n";
// echo "date: $date\n";
// echo "content: $content\n";
require("db.php");
$db = get_db();
$query = "INSERT INTO threads (title, desc_text) VALUES (:title, :desc_text)";
$statement = $db->prepare($query);
$statement->bindValue(":title", $title, PDO::PARAM_INT);
$statement->bindValue(":desc_text", $content, PDO::PARAM_STR);
$statement->bindValue(":date", $date, PDO::PARAM_STR);
$statement->execute();
header("Location: courseDetails.php?course_id=$title");
die();
?>