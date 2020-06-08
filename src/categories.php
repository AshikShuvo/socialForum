<?php
    session_start(); 
   


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Category</title>
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
  <header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fa fa-folder"></i> Categories</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
   
  <!-- CATEGORIES -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Categories</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Action</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
               <?php
                       $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $db="cs480";
                       
                   $conn = new mysqli($servername, $username, $password,$db);
                  // Check connection
                  if ($conn->connect_error) {
                      die("Connection failed: " . $conn->connect_error);
                  } 
                  $sql="SELECT * FROM category";
                  $result=$conn->query($sql);
                   $i=1;
                  while($row=$result->fetch_assoc()){?>
                     <tr>
                  <td scope="row"><?php echo $i;?></td>
                  <td><?php echo $row["name"]; ?></td>
                   <td><a href="c_post.php?id=<?php echo $row["id"]; ?> " class="btn btn-success">
                                    <i class="fa fa-angle-double-right"></i> All Post
                                  </a></td>
                </tr>
                      
               <?php $i++;   }
                  $conn->close();
                ?>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2019 SocialForum</p>
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
