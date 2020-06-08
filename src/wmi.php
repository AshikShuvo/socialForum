<?php
    session_start(); 
    if($_SESSION["u_type"]== '1'){
            header("location:admin.php");
        }else{
            header("location:user.php");
        }
?>