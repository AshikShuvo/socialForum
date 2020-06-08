<?php  
    session_start(); 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db="cs480";
    $msg="";
// Create connection


// Create database

if(isset($_POST["adcgtr"]) && ($_POST["adcgtr"]==="ct")){
    $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
    $name="";
    $name=$_POST["name"];
    $sql = "INSERT INTO category (name)VALUES('$name')";
    
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $u_id=$_SESSION["u_id"];
        $nsql = "INSERT INTO user_ctgr (user_id,cgtr_id) VALUES ('$u_id','$last_id')";
        if($conn->query($nsql) === TRUE){
            $conn->close();
            header("location:admin.php");
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
     unset($_POST["adcgtr"]);
}else if(isset($_POST["post"]) && ($_POST["post"]=="pst")){
    $title=$_POST["title"];
    $c_id=$_POST["category"];
    $u_id=$_SESSION["u_id"];
    $image=$_POST["image"];
    $content=$_POST["editor1"];
     $conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   $jsql = "INSERT INTO post (title,image,content)VALUES('$title','$image','$content')"; 
    if($conn->query($jsql) === TRUE){
        $last_id = $conn->insert_id;
        $u_id=$_SESSION["u_id"];
        $lsql = "INSERT INTO user_post (user_id,post_id) VALUES ('$u_id','$last_id')";
        $msql="INSERT INTO post_ctgr (ctgr_id,post_id) VALUES ('$c_id','$last_id')";
         if(($conn->query($lsql) === TRUE) && ($conn->query($msql) === TRUE)){
            $conn->close();
            header("location:admin.php");
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Area</title>
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
          <li class="nav-item px-2">
            <a href="users.php" class="nav-link">Users</a>
          </li>
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
         <i class="fa fa-cog fa-spin fa-3x fa-fw margin-bottom"></i> <h4 class="pull-right pull-left">Admin Dashboard</h4>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPostModal">
            <i class="fa fa-plus"></i> Add Post
          </a>
        </div>
        <div class="col-md-3">
          <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
            <i class="fa fa-plus"></i> Add Category
          </a>
        </div>
        <div class="col-md-3">
          
        </div>
      </div>
    </div>
  </section>

  <!-- POSTS --> 
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
        <?php
         
     $conn = new mysqli($servername, $username, $password,$db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    $getpost_sql = "SELECT * FROM post";
    $getpost_result = $conn->query($getpost_sql);
            $conn->close();
   while($row = $getpost_result->fetch_assoc()){?>
           <?php if($row["valid"]==='1'){?>
          <div class="card mb-3">
  <img class="card-img-top" src="img/<?php echo $row["image"]?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row["title"];?></h5>
    <p class="card-text"><?php echo $row["content"]; ?></p>
     <a href="viewpost.php?id=<?php echo $row["id"];?>" class="btn btn-info">Details</a>
    <p class="card-text"><small class="text-muted"><?php echo $row["time"]?></small></p>
  </div>
</div>
      <?php }?>
         
      <?php   }?>
         

        </div>
        <div class="col-md-3">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <h3>Posts</h3>
              <h1 class="display-4">
               <?php
                      $conn = new mysqli($servername, $username, $password,$db);
                        // Check connection
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                            } 
                        $countpost_sql = "SELECT id FROM post";
                        $countctgr_sql = "SELECT id FROM category";
                        $countuser_sql = "SELECT id FROM user";
                        $getpostcount_result = $conn->query($countpost_sql);
                        $getctgrcount_result = $conn->query($countctgr_sql);
                        $getusercount_result = $conn->query($countuser_sql);
                        $conn->close();
                ?>
                <i class="fa fa-pencil"></i> <?php echo $getpostcount_result->num_rows ?>
              </h1>
              
            </div>
          </div>

          <div class="card text-center bg-success text-white mb-3">
            <div class="card-body">
              <h3>Categories</h3>
              <h1 class="display-4">
                <i class="fa fa-folder-open-o"></i><?php echo $getctgrcount_result->num_rows; ?>
              </h1>
             
            </div>
          </div>

          <div class="card text-center bg-warning text-white mb-3">
            <div class="card-body">
              <h3>Users</h3>
              <h1 class="display-4">
                <i class="fa fa-users"></i> <?php echo $getusercount_result->num_rows; ?>
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
          <p class="lead text-center">Copyright &copy; 2019 Social forum</p>
        </div>
      </div>
    </div>
  </footer>


  <!-- POST MODAL -->
  <div class="modal fade" id="addPostModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add Post</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post"action="admin.php">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control"name="title">
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select class="form-control"name="category">
               <?php
                $conn = new mysqli($servername, $username, $password,$db);
                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }   
                  $psql = "SELECT * FROM category";
                  $result = $conn->query($psql);
                  if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {?>
                          <option value="<?php echo $row['id']; ?>"> <?php echo $row["name"];?> </option>
                         
                    <?php  }
                      $conn->close();   
                  }
                ?>
              </select>
            </div>
             <div class="form-group">
              <label for="title">Image</label>
              <input type="text" class="form-control"name="image">
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <textarea name="editor1" class="form-control"></textarea>
            </div>
             <button class="btn btn-success" type="submit"value="pst"name="post">Post</button>

          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
      </div>
    </div>
  </div>


  <!-- CATEGORY MODAL -->
  <div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Add Category</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post"action="admin.php">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control"name="name">
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

  <!-- USER MODAL -->
  <div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control">
            </div>
            <div class="form-group">
              <label for="name">Confirm Password</label>
              <input type="password" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-warning" data-dismiss="modal">Save Changes</button>
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
