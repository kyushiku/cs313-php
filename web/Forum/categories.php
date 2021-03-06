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
$category = htmlspecialchars($_GET['category']);

$query = "SELECT threads.title, threads.desc_text, threads.categories_id FROM threads";
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
    <h1>PUBG Forum</h1>
     <div class="uk-position-top-right"> 
     Welcome! <?= $username ?><br /><br />
    </div>
    
    <nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#">News</a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li><a href="categories.php?category=1">News</a></li>
                        <li><a href="categories.php?category=2">Troubleshoot</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="#">Troubleshooting</a></li>
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
    $categorie_id = $thread['categories_id'];
    if($category == $categorie_id)
    {
echo "<div class='uk-card uk-card-default'>
    <div class='uk-card-header'>
        <div class='uk-grid-small uk-flex-middle' uk-grid>
            <div class='uk-width-expand'>
                <h3 class='uk-card-title uk-margin-remove-bottom'> $title </h3>
                <p class='uk-text-meta uk-margin-remove-top'><time datetime='2016-04-01T19:00'>April 01, 2016</time></p>
            </div>
        </div>
    </div>
    <div class='uk-card-body'>
        <p> $comments </p>
    </div>
    <div class='uk-card-footer'>
        <form>
        <a href = 'comment.php' class ='uk-button uk-button-text'>Comments </a>
        </form>
    </div>
</div>";
    }

foreach($comm as $comment)
{
    $text = $comment['comm_text'];
    $author = $comment['users_id'];
    $t_id = $comment['threads_id'];
    if ($t_id == $thread_id){
    echo"
    <article class='uk-comment'>
    <header class='uk-comment-header uk-grid-medium uk-flex-middle' uk-grid>
        <div class='uk-width-expand'>
            <h4 class='uk-comment-title uk-margin-remove'><a class='uk-link-reset' href='#'>Author</a></h4>
            <ul class='uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top'>
                <li><a href='#'>12 days ago</a></li>
                <li><a href='#'>Reply</a></li>
            </ul>
        </div>
    </header>
    <div class='uk-comment-body'>
        <p>$text</p>
    </div>
</article>";
    }
}
}
?> 
<a href='SignOut.php' class='uk-button uk-button-text'>Sign Out!</a>
</body>
</html>