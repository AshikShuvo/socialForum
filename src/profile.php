<?php
        session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="wmi.php" class="navbar-brand">Social Forum</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
           
          </li>
          <li class="nav-item px-2">
          </li>
          <li class="nav-item px-2">
            
          </li>
          <li class="nav-item px-2">
           
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
                <i class="fa fa-gear"></i> Edit Profile
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
          <h1><i class="fa fa-user"></i> Profile</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="action" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mr-auto">
          <a href="wmi.php" class="btn btn-light btn-block">
            <i class="fa fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
        <div class="col-md-3">
         
        </div>
        <div class="col-md-3">
         
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- PROFILE -->
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Profile</h4>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="name">Name  :   </label>
                  <?php echo $_SESSION["u_name"];?>
                </div>
                <div class="form-group">
                  <label for="email">Email  :  </label>
                  <?php echo $_SESSION["u_email"];?>
                </div>
                <div class="form-group">
                  <label for="body">Bio  :</label><br>
                  <?php echo $_SESSION["u_bio"];?>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <h3>Your Avatar</h3>
          <img src="img/<?php echo $_SESSION["u_pic"]; ?>" alt="" class="d-block img-fluid mb-3">
         
        </div>
      </div>
    </div>
  </section>

  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; 2019 social forum</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- PASSWORD MODAL -->
  <div class="modal fade" id="passwordModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Change Password</h5>
          <button class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form>
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
          <button class="btn btn-primary" data-dismiss="modal">Update Password</button>
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
 