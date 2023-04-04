<?php
    session_start();
    include "db.php";
    include "tables.php";
    include "class.php";
    $db = new Database();
    $app = new UserClass();
?>