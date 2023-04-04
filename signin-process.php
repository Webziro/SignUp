<?php
    include "include/init.php";
    if(isset($_POST['signin'])){
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        //print_r($_POST); die();
        $signinresult = $app->Login($email, $password);
        if ($signinresult['status']==0) {
            $_SESSION['msg']=$signinresult['message'];
            header("location: signin.php");
        } else {
            $_SESSION['userId']=$signinresult['userid'];
            header("location: ../reportprortal.php");
        }       
        
    }else{
        header("location:signin.php");
    }
    
?>