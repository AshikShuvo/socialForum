<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $msg="";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database

if(isset($_POST["submit"]) && ($_POST["submit"]=="rg")){
    $name=$email=$pw=$cpw=$pr_pic="";
    $name=$_POST["name"];
    $email=$_POST["email"];
    $pw=$_POST["pw"];
    $pr_pic=$_POST["pr_pic"];
    $sql = "INSERT INTO user (name, email, password,pr_pic)VALUES('$name','$email','$pw','$pr_pic')";
    if ($conn->query($sql) === TRUE) {
        header("location:index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}else if(isset($_POST["login"]) && ($_POST["login"]=="lg")){
    $email=$_POST["email"];
    $pw=$_POST["pw"];
    $sql="select * FROM user WHERE  email='".$email."' AND password='".$pw."' limit 1";
    $result=$conn->query($sql);
    if($result->num_rows == '1'){
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["u_name"]=$row["name"];
        $_SESSION["u_email"]=$row["email"];
        $_SESSION["u_id"]=$row["id"];
        $_SESSION["u_type"]=$row["type"];
        $_SESSION["u_pic"]=$row["pr_pic"];
        $_SESSION["u_bio"]=$row["bio"];
        if($_SESSION["u_type"]== '1'){
            header("location:admin.php");
        }else{
            header("location:user.php");
        }
            
        
        
    }
    
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.php" class="navbar-brand">SocialForum</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
         
          
          
          
        </ul>
      </div>
    </div>
  </nav>

  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-home"></i> Home</h1>
        </div>
      </div>
    </div>
  </header>
  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUserModal">
            <i class="fa fa-plus"></i> Register Your Self
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fa  fa-arrow-right"></i> Log In
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
              <div class="row" 
         style="height: 400px; background:transparent url('img/home.jpg') no-repeat center center /cover">
      <div class="col-lg-12">
      </div>
    </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Posts</h3>
              <h1 class="display-4">
                <i class="fa fa-pencil"></i> 4
              </h1>
              
            </div>
          </div>

          <div class="card text-center bg-success text-white mb-3">
            <div class="card-body">
              <h3>Categories</h3>
              <h1 class="display-4">
                <i class="fa fa-folder-open-o"></i> 6
              </h1>
             
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
          <p class="lead text-center">Copyright &copy; 2019  Social Forum</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post"action="index.php">
            <div class="form-group">
              <label for="title">email</label>
              <input type="text" class="form-control"name="email">
            </div>
             <div class="form-group">
              <label for="title">Password</label>
              <input type="password" class="form-control"name="pw">
            </div>
             <div class="modal-footer">
         <button class="btn btn-dark" >close</button>
         <button class="btn btn-success" type="submit"value="lg"name="login">Login</button>

        </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Register User</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post"action="index.php">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control"name="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control"name="email">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control"name="pw">
            </div>
            <div class="form-group">
              <label for="name">Confirm Password</label>
              <input type="password" class="form-control"name="cpw">
            </div>
            <div class="form-group">
              <label for="name">Profile Pic</label>
              <input type="text" class="form-control"name="pr_pic">
            </div>
            <button class="btn btn-primary" type="submit"value="rg"name="submit">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'editor1' );
  </script>
</body>
</html>
