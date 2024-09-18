<?php
    define("HOST", "srv1465.hstgr.io");
    define("DB_NAME", "u943673575_punch");
    define("USER", "u943673575_gablex");
    define("PASS", "Punch.456");

    $db = new PDO("mysql:host=".HOST.";dbname=".DB_NAME, USER, PASS);
?>