<?php
session_start(); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $id=$_GET["id"];
    $v_id=$_GET["v_id"];
     $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    if($v_id =='1'){
        $sql = "UPDATE post SET valid='0' WHERE id='".$id."'"; 
        $r=$conn->query($sql);
        $conn->close();
        header("location:post.php");
    }else{
     $sql = "UPDATE post SET valid='1' WHERE id='".$id."'";   
         $r=$conn->query($sql);
        $conn->close();
         header("location:post.php");
    }

?>