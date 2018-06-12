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
        //a real user posted a real reply
        $sql = "INSERT INTO 
                    comments(comm_text,
                          users_id,
                          threads_id,
                          comment_date) 
                VALUES ('" . $_POST['comm_text'] . "',
                    " . $_SESSION['username'] . ",
                        " . $_POST['threads_id'] . ",
                        NOW()";
                         
       // $result = mysql_query($sql);
                         
        //if(!$result)
        //{
        //    echo 'Your reply has not been saved, please try again later.';
        //}
        //else
        //{
        //    echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        //}
    }
}
 ?>