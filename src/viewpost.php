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
  <title>view A Poost</title>
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
         $idGet=$_GET["id"];
        
             $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
         $sql="SELECT * FROM post WHERE id='".$idGet."'";
         $result= $result=$conn->query($sql);
          if($result->num_rows == '1'){
              $row = $result->fetch_assoc();
              $sql1="SELECT * FROM user_post WHERE post_id='".$idGet."'";
               $rowC=$conn->query($sql1);
                $rowCid=$rowC->fetch_assoc();
              $sql2="select * FROM user WHERE id='".$rowCid["user_id"]."'";
              $rowCNamef=$conn->query($sql2);
              $rowCName=$rowCNamef->fetch_assoc();}  
           $conn->close();
          

           ?>
               <div class="card mb-3">
  <img class="card-img-top" src="img/<?php echo $row["image"]?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["title"];?></h5>
    <h5 class="card-title">Posted By <?php echo $rowCName["name"];?></h5>
    <p class="card-text"><small class="text-muted"><?php echo $row["time"]?></small></p>
    <p class="card-text"><?php echo $row["content"]; ?></p>
    
    
  </div>
</div>
        <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCommentModal">
            <i class="fa fa-plus"></i> Add Comment
          </a>
         <?php
            $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
         $sqlt="SELECT * FROM comments WHERE post_id='".$idGet."'";
         $result= $result=$conn->query($sqlt);
          if($result->num_rows >'0'){
              while($row = $result->fetch_assoc()){
              $pcid=$row["user_id"];
             $sqlnm="SELECT name,pr_pic FROM user WHERE id='".$pcid."'";
                $pcn=$conn->query($sqlnm);
                $pcnm=$pcn->fetch_assoc();
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                       <img src="img/<?php echo $pcnm["pr_pic"]; ?>" class="rounded-circle float-left img-fluid" alt="Cinque Terre">
                        <h5 class="card-title"><?php echo $pcnm["name"]; ?></h5>
                         <p class="card-text"><?php echo $row["body"]; ?></p>
                    </div>
                </div>
                <h4></h4> <br>
                <h3></h3> 
              
           <?php  }  }
           $conn->close();
          

           ?>
         <!-- COMMENT MODAL -->
  <div class="modal fade" id="addCommentModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Comment</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post"action="viewpost.php?id=<?php echo $_GET["id"];?>">
            <div class="form-group">
              <label for="Comment">Comment</label>
              <input type="text" class="form-control"name="cnt">
            </div>
            <button class="btn btn-success" type="submit"value="ct"name="adcgtr">Add</button>

          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
          
            
      
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
