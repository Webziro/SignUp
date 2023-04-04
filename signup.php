<?php
include_once "include/init.php";
    if(isset($_POST['signup'])){
        $signupresult = $app->signUp($_POST);
        //print_r($_POST); die();
        if($signupresult['status']==0){
            $_SESSION['msg'] = $signupresult['message'];
            header("location: index.php");
        }else{
            $_SESSION['msg'] = "Account Created";
            header("location:signin.php");
        }
    }else{
        header("location: index.php");
    }
?>