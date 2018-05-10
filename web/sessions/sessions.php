<!DOCTYPE>
<html>
<?php

session_start();
$count = "session-count";
$sessionCount = 0;
if (isset($_SESSION[$count])){
    $_SESSION[$count]++;
}
else {
    $_SESSION[$count] = 0;
}
$sessionCount = $_SESSION[$count];
?>

<body>
Sessions are happening.. <?php echo $sessionCount; ?>
</body>

</html>