<?php
session_start(); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $id=$_GET["id"];
    $t_id=$_GET["t_id"];
     $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    if($t_id =='1'){
        $sql = "UPDATE user SET type='0' WHERE id='".$id."'"; 
        $r=$conn->query($sql);
        $conn->close();
        header("location:users.php");
    }else{
     $sql = "UPDATE user SET type='1' WHERE id='".$id."'";   
         $r=$conn->query($sql);
        $conn->close();
         header("location:users.php");
    }

?>