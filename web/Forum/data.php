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
   <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css">
</head>
<body>
    <h1>PUBG Forum</h1>
     <div class="uk-position-top-right"> 
    <?php
        foreach ($db->query('SELECT name FROM users') as $users)
        {
        $name = $users["name"];
            if ($name == 'Emma Fisher')
            {
            echo "Welcome! "$name;
            }
        }
    ?>
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
</nav>

 <div class="uk-card uk-card-default">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom">UPCOMING!!!</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p>
            <?php
            foreach ($db->query('SELECT "text" FROM threads') as $threads)
            {
                $text = $threads["text"];
                echo  $text;
            }
            ?>
        </p>
    </div>
    <div class="uk-card-footer">
        <a href="#" class="uk-button uk-button-text">Comments</a>
    </div>
</div>
    
</body>
</html>