<?php  
    session_start(); 
     $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $msg="";
    if(isset($_POST["adcgtr"]) && ($_POST["adcgtr"]==="ct")){
    $connn = new mysqli($servername, $username, $password,$db);
// Check connection
 if ($connn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $name=$_POST["cnt"];
    $u_id=$_SESSION["u_id"];
    $p_id=$_GET["id"];
   
    $psql = "INSERT INTO comments (body, user_id, post_id) VALUES ('".$name."','$u_id','$p_id')";
        
        if($connn->query($psql) === TRUE){
       header("location:viewpost.php?id=$p_id");
        $connn->close();   
   }else{
        echo "Error: " . mysqli_error($connn);
        $connn->close();   
   }
       

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Posts By Category</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="wmi.php" class="navbar-brand">Socisl forum</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="wmi.php" class="nav-link active"> Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="post.php" class="nav-link">Posts</a>
          </li>
          <li class="nav-item px-2">
            <a href="categories.php" class="nav-link">Categories</a>
          </li>
           
           <?php if($_SESSION["u_type"]=='1'){?>
             <li class="nav-item px-2">
            <a href="users.php" class="nav-link">Users</a>
          </li>
      <?php  }?>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i> <?php echo $_SESSION["u_name"]; ?>
            </a>
            <div class="dropdown-menu">
              <a href="profile.php" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Profile
              </a>
              <a href="editprofile.php" class="dropdown-item">
                <i class="fa fa-user-circle"></i> Edit Profile
              </a>
             
            </div>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fa fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-book"></i> Post</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
       
       <div class="col-md-9">
        <?php
         $id=$_GET["id"];
     $conn = new mysqli($servername, $username, $password,$db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    $getpostid_sql = "SELECT post_id FROM post_ctgr WHERE ctgr_id='".$id."'";
           
    $getpostid_result = $conn->query($getpostid_sql);
          
   while($row = $getpostid_result->fetch_assoc()){
           $getaApost="SELECT * FROM post WHERE id='".$row["post_id"]."'";
            $getaApost_result=$conn->query($getaApost);
            while($rowEach=$getaApost_result->fetch_assoc()){ 
                 if($rowEach["valid"]==='1'){?>
                    <div class="card mb-3">
                      <img class="card-img-top" src="img/<?php echo $rowEach["image"]?>" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $rowEach["title"];?></h5>
                        <p class="card-text"><?php echo $rowEach["content"]; ?></p>
                         <a href="viewpost.php?id=<?php echo $rowEach["id"];?>" class="btn btn-info">Details</a>
                            <p class="card-text"><small class="text-muted"><?php echo $rowEach["time"]?></small></p>
                            
                      </div>
                    </div>
                <?php }
            }
   } $conn->close();
           ?>
          
         <!-- COMMENT MODAL -->           
      
        </div>
      </div>
    </div>
  </section>

  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2019 socialForum</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
</body>
</html>
