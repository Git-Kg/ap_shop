<?php
  session_start();
  require("../config/config.php");
  require("../config/common.php");

  if(empty($_SESSION['user_id'] ) || empty($_SESSION['logged_in']))
  {
    header("Location:admin/login.php");
  }

  if($_POST)
  {
    $name = xss_Clean($_POST['name']);
    $email = xss_Clean( $_POST['email']);
    $password = xss_Clean($_POST['password']);
    $role = $_POST['role'];
    if(empty($_POST['role'])){
        $role = 0;
    }else{
        $role = 1;
    }

    $sql = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $sql->bindParam("email",$email,PDO::PARAM_STR);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    if($user){
        echo "<script> alert('email is already exists !')</script>";
    }else{
        $passHash = password_hash($password,PASSWORD_BCRYPT);
        $sql = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $sql->bindParam(1, $name, PDO::PARAM_STR);
        $sql->bindParam(2, $email, PDO::PARAM_STR);
        $sql->bindParam(3, $passHash, PDO::PARAM_STR);
        $sql->bindParam(4, $role, PDO::PARAM_INT);
        $result = $sql->execute();
        
        if($result){
            echo "<script> alert('New User is added'); window.location.href = 'user_list.php' ; </script>";
        }
    }
  }
  
?>
  <!-- Header call header.php-->
  <?php include('header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col text-center mt-3">
              <h2 style="font-family: 'Noto Serif', serif; color:blue">Add New User </h2>
          </div>
        </div>

        <!-- Add content form -->
        <div class="row">

          <div class="col">

            <form class="" action="" method= POST>

              <!-- CSRF Token -->
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
              <!--/ CSRF Token -->

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="" required>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label >Admin Role : </label>
                    <input type="checkbox" name="role" value="1">
                </div>

                    
                <div class="col mt-4">
                    <input type="submit" class="btn btn-primary mr-4" value="SUBMIT">
                    <a href="user_list.php" class="btn btn-success">Back</a>
                </div>

            </form>

          </div>

      </div>
        <!-- /.row -->


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include('footer.php'); ?>
