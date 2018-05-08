<!DOCTYPE>
<html>
   <?php
    echo $_POST["name"];
    echo "<a href=\"mailto:" . $_POST["email"] . "\">mail</a>"
    echo $_POST["class"];
    echo $_POST["comments"];
    
    ?> 
</html>