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
        $desc = xss_Clean( $_POST['description']);
        $price = xss_Clean($_POST['price']);
        $qty = xss_Clean($_POST['quantity']);
        $catId = xss_Clean($_POST['category']);

        $image = $_FILES['image']['name'];
        $type = $_FILES['image']['tmp_name'];
        $ext = pathinfo($image,PATHINFO_EXTENSION);
        $valid = array("png","jpg","jpeg");
        $uniFile = uniqid().".".$ext;
    
        if(in_array($ext,$valid)){    //find extension or upload extension 
        
            move_uploaded_file($type,"images/$uniFile") ; 
                                                
            $sql = $pdo->prepare("INSERT INTO products (name, description, price, image, quantity, category_id ) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bindParam(1, $name, PDO::PARAM_STR);
            $sql->bindParam(2, $desc, PDO::PARAM_STR);
            $sql->bindParam(3, $price, PDO::PARAM_STR);
            $sql->bindParam(4, $uniFile, PDO::PARAM_STR);
            $sql->bindParam(5, $qty, PDO::PARAM_INT);
            $sql->bindParam(6, $catId, PDO::PARAM_INT);
            $result = $sql->execute();
        
            if($result){
                echo "<script> alert(' Product is added'); window.location.href = 'product.php' ; </script>";
            }
        }else{
            echo "<script> alert('Invalid File extension. Image must be jpg, png or jpeg') </script> ";
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
              <h2 style="font-family: 'Noto Serif', serif; color:blue">Add New Product </h2>
          </div>
        </div>

        <!-- Add content form -->
        <div class="row">

          <div class="col">

            <form class="" action="" method= POST enctype="multipart/form-data">

              <!-- CSRF Token -->
              <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
              <!--/ CSRF Token -->

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>

               <div class="row">
                    <div class="col"> 
                        <div class="form-group">
                        <label>Price</label> <br>
                        <input type="number" name="price"  required class="form-control">
                        </div> 
                    </div>

                    <div class="col"> 
                        <div class="form-group">
                            <label > Quantity </label> <br>
                            <input type="number" name="quantity" required class="form-control">
                        </div>
                    </div>

                    <div class="col">
                    <!-- select category query -->                
                    <?php 
                        $sql = $pdo->prepare("SELECT * FROM categories");
                        $sql->execute();
                        $catResult = $sql->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                     <!--/ select category query --> 
                        <div class="form-group">
                            <label>Category</label> <br>
                            <select name="category" id=""  class="form-control" required>
                                <option value="">-- Select Category --</option>
                                <?php 
                                    foreach($catResult as $cat){  ?>
                                        <option value="<?php echo $cat['id']?>"> <?php echo $cat['name'] ?> </option>

                                <?php   }  ?>
                               
                            </select>
                        </div>
                    </div>

                    <div class="col">                      
                        <label> Image </label> <br>
                        <input type="file" name="image" >                        
                    </div>

               </div>
           
                <div class="col mt-4">
                    <input type="submit" class="btn btn-outline-primary mr-4" value="SUBMIT">
                    <a href="product.php" class="btn btn-success">Back</a>
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
