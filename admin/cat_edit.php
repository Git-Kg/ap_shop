<?php
  session_start();
  require("../config/config.php");
  require("../config/common.php");

  if(empty($_SESSION['user_id'] ) || empty($_SESSION['logged_in']))
  {
    header("Location:index.php");
  }

  if(isset($_POST['id']))
  {
        $name = xss_Clean($_POST['name']);
        $description = xss_Clean($_POST['description']);
        $id = xss_Clean($_POST['id']);
   
       $sql = $pdo->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
       $sql->bindParam(1, $name, PDO::PARAM_STR);
       $sql->bindParam(2, $description, PDO::PARAM_STR);
       $sql->bindParam(3, $id, PDO::PARAM_INT);
      
       $result = $sql->execute();

       if($result)
       {
         echo "<script> alert(' Category Updated ') , window.location.href='category.php';</script>";
       }
     }
  
?>
  <!-- Header call header.php-->
  <?php include('header.php'); ?>

 <!-- from category.php / get edit id query -->
  <?php 
    $id = xss_Clean($_GET['id']);
    $sql = $pdo->prepare("SELECT * FROM categories WHERE id =:id");
    $sql->bindParam(":id",$id,PDO::PARAM_INT);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
  ?>

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

            <form class="" action="cat_edit.php" method="POST" >
            <!-- CSRF Token -->
             <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            <!--/ CSRF Token -->
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo xss_Clean($result['name']) ?>" >
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="5" ><?php echo xss_Clean($result['description']) ?></textarea>
              </div>
               
              <div class="col mt-4">
                <input type="submit" class="btn btn-primary mr-4" value="UPDATE">
                <a href="category.php" class="btn btn-success">Back</a>
              </div>

                <input type="hidden" name = "id" value = "<?php echo xss_Clean($result['id']) ?>">

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
