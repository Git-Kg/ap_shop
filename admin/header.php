
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>My Shop</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,400;1,700&display=swap" rel="stylesheet">
  <!--Data Table  -->
  <link rel="stylesheet" href="plugins/bootstrap/datatable.css">
  <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/datatable.js"></script>

    <script>
        $(document).ready( function () {
         $('.tbdata').DataTable();
          } );
    </script>
  <!-- Data Table -->
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    <div class="row">
      <div class="col">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fa fa-bars" > </i> </a>
            </li>
          </ul>
        
        <marquee  direction="left " scrollamount="8">
            <span style="font-family: 'Noto Serif', serif; font-size:30px; color:red">  My $hop  </span>
        </marquee>

        </nav>
      </div>
     <div class="float-right mr-4"> <!-- logout button -->
       <a href="logout.php" class="btn btn-primary mt-2">Logout</a>
     </div>
   </div>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .5">
      <span class="brand-text font-weight-light">A Programmer</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/Dev.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['user_name']; ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="category.php" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Categories
                </p>
              </a>
           </li>

          <li class = "nav-item">
              <a href="product.php" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Products
                </p>
              </a>
          <li>

          <li class = "nav-item">
              <a href="user_list.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class = "nav-item">
              <a href="order_list.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  