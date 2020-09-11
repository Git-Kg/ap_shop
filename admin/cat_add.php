<?php
  session_start();
  require("../config/config.php");
  require("../config/common.php");

  if(empty($_SESSION['user_id'] ) || empty($_SESSION['logged_in']))
  {
    header("Location:index.php");
  }

  if($_POST)
  {
    $name = xss_Clean($_POST['name']);
    $description = xss_Clean($_POST['description']);
    $date = xss_Clean($_POST['created_at']);

       $sql = $pdo->prepare("INSERT INTO categories (name, description, created_at) VALUES (:name, :description, :date)");
       $sql->bindValue(":name",$name);
       $sql->bindValue(":description",$description);
       $sql->bindValue(":date",$date);
      

       $result = $sql->execute();

       if($result)
       {
         echo "<script> alert('New Category is Successful Added') , window.location.href='category.php';</script>";

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
                <h2 style="font-family: 'Noto Serif', serif; color:blue"> Add Category  </h2>
            </div>
       </div>

        <!-- Add content form -->
        <div class="row">

          <div class="col">

            <form class="" action="cat_add.php" method="POST" >
            <!-- CSRF Token -->
             <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <!--/ CSRF Token -->
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="" required>
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="5" ></textarea>
              </div>

              <div class="form-group">
                <label >Date</label>
                <input type="date" name = "created_at">
              </div>

              <div class="col mt-4">
                <input type="submit" class="btn btn-primary mr-4" value="SUBMIT">
                <a href="category.php" class="btn btn-success">Back</a>
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
