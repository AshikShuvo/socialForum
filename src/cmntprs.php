<?php
     
    if(isset($_POST["adcgtr"]) && ($_POST["adcgtr"]==="ct")){
    session_start(); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $conn = new mysqli($servername, $username, $password,$db);
// Check connection
         if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $name=$_POST["cnt"];
    $u_id=$_SESSION["u_id"];
    $p_id=$_GET["id"];
   
    $sql = "INSERT INTO comments (body, user_id, post_id) VALUES ( '$name', '$u_id', '$p_id')";
    $sql1="SELECT * FROM comments";
   if($conn->query($sql1) === TRUE){
        echo "yes";
        $conn->close();   
   }else{
        echo "no";
        $conn->close();   
   }
       

}
?>

   
    