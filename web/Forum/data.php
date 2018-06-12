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

$query = "SELECT title, desc_text FROM threads";
$statement = $db->prepare($query);
// Bind any variables i need here
$statement->execute();
$threads = $statement->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
   <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
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
                        <li><a href="#">News</a></li>
                        <li><a href="#">Troubleshoot</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="#">Troubleshooting</a></li>
        </ul>
    </div>
    <div class ="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li>
            <a href="details.php">New Thread</a>
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
        <button class='uk-button uk-button-text'>Comments </button>
        </form>
    </div>
</div>";
}
?> 
<a href='SignOut.php' class='uk-button uk-button-text'>Sign Out!</a>
</body>
</html>