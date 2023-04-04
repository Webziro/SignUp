<?php
    include "init.php";
    if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];
        if($app->getUserProfile($userId)!=0){
            $userProfile=$app->getUserProfile($userId);
        }
    }
?>
