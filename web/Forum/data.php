<?php
require("db.php");
$db = get_db();
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

$query = "SELECT title,users_id, desc_text, id FROM threads";
$statement = $db->prepare($query);
$statement->execute();
$threads = $statement->fetchALL(PDO::FETCH_ASSOC);

$query2 = "SELECT comm_text, users_id, threads_id, comment_date FROM comments";
$statement1 = $db->prepare($query2);
$statement1->execute();
$comm = $statement1->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
   <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
    <link rel="stylesheet" href = "style.css">
</head>
<body>
    <a style="font-size:28px" href = "data.php">PUBG Forum</a>
    <a href='SignOut.php' id='signOut' class='uk-button uk-button-text uk-position-top-right'>Sign Out!</a>
    <div id="username"> 
     Welcome! <?= $username ?><br /><br />
    </div>
    
    <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#">Categories</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="categories.php?category=1">News</a></li>
                        <li><a href="categories.php?category=2">Troubleshoot</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class ="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
            <a href="thread.php">New Thread</a>
            </li>
        </ul>
    </div>
</nav>

<?php
foreach($threads as $thread)
{
    $thread_id = $thread['id'];
    $title = $thread['title'];
    $comments = $thread['desc_text'];
    $author = $thread['users_id'];
    
echo "<div class='uk-card uk-card-default'>
    <div class='uk-card-header'>
        <div class='uk-grid-small uk-flex-middle' uk-grid>
            <div class='uk-width-expand'>
                <h3 class='uk-card-title'> $title </h3>
                <p class='uk-text-meta uk-margin-remove-top'><time datetime='2016-04-01T19:00'>$author</time></p>
            </div>
        </div>
    </div>
    <div class='uk-card-body'>
        <p> $comments </p>
    </div>
    <div class='uk-card-footer'>
        <form action='comment.php' method = 'POST'>
        <input type='hidden' name='threads_id' value='$thread_id'>
        <input type = 'submit' value = 'Comments' class ='uk-button uk-button-text'>
        </form>
    </div>
</div>";

foreach($comm as $comment)
{
    $text = $comment['comm_text'];
    $author = $comment['users_id'];
    $t_id = $comment['threads_id'];
    if ($t_id == $thread_id){
    echo"
    <div id='comment'>
        <div class='uk-card uk-card-default uk-card-small uk-card-body'>
            <h3 class='uk-card-title'>Small</h3>
            <p>$text</p>
        </div>
    </div>
    ";
    }
}
}
?> 
</body>
</html>