<?php
//include 'data.php';
session_start();
if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
}
else
{
    header("Location: login.php");
	die(); // we always include a die after redirects.
}
    //check for sign in status
    if(!isset($_SESSION['username']))
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
    $text = htmlspecialchars($_POST["comm_text"]);
    //$user_id = htmlspecialchars($_SESSION['username']);
    $thread_id = htmlspecialchars($_POST["threads_id"]);
    //$date = date('Y/m/d');
    //$date = new DateTime($date);

    require("db.php");
    $db = get_db();
    $query = "INSERT INTO comments (comm_text, threads_id) VALUES (:text, :thread_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(":text", $text, PDO::PARAM_STR);
    //$statement->bindValue(":user_id", $user_id, PDO::PARAM_INT);
    $statement->bindValue(":thread_id", $thread_id, PDO::PARAM_INT);
   // $statement->bindValue(":date", $date, PDO::PARAM_STR);
    $statement->execute();
    header("Location: data.php");
    die();
    }
 ?>