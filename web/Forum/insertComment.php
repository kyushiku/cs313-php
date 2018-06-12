<?php
include 'data.php';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //someone is calling the file directly, which we don't want
    echo 'This file cannot be called directly.';
}
else
{
    //check for sign in status
    if(!isset($_SESSION['username']))
    {
        echo 'You must be signed in to post a reply.';
    }
    else
    {
    $text = htmlspecialchars($_POST["comm_text"]);
    $user_id = htmlspecialchars($_POST["users_id"]);
    $thread_id = htmlspecialchars($_POST["threads_id"]);
    $date = date("m/d/Y");

    require("db.php");
    $db = get_db();
    $query = "INSERT INTO comments (comm_text, users_id, threads_id, comment_date) VALUES (:text, :user_id, :thread_id, :date)";
    $statement = $db->prepare($query);
    $statement->bindValue(":text", $text, PDO::PARAM_STR);
    $statement->bindValue(":user_id", $user_id, PDO::PARAM_STR);
    $statement->bindValue(":thread_id", $thread_id, PDO::PARAM_INT);
    $statement->bindValue(":date", $date, PDO::PARAM_STR);
    $statement->execute();
    header("Location: data.php");
    die();
    }

}
 ?>