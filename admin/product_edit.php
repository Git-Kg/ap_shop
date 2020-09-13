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
        $id = xss_Clean($_GET['id']);
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
    
        if($image){
            if(in_array($ext,$valid)){    //find extension or upload extension 
            
                move_uploaded_file($type,"images/$uniFile") ; 
                                                    
                $sql = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, quantity = ?, category_id = ? WHERE id = ?");
                $sql->bindParam(1, $name, PDO::PARAM_STR);
                $sql->bindParam(2, $desc, PDO::PARAM_STR);
                $sql->bindParam(3, $price, PDO::PARAM_STR);
                $sql->bindParam(4, $uniFile, PDO::PARAM_STR);
                $sql->bindParam(5, $qty, PDO::PARAM_INT);
                $sql->bindParam(6, $catId, PDO::PARAM_INT);
                $sql->bindParam(7, $id, PDO::PARAM_INT);
                $result = $sql->execute();
            
                if($result){
                    echo "<script> alert(' Product is Updated'); window.location.href = 'product.php' ; </script>";
                }
            }else{
                echo "<script> alert('Invalid File extension. Image must be jpg, png or jpeg') </script> ";
            }
        }else{
                
            $sql = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, category_id = ? WHERE id = ?");
            $sql->bindParam(1, $name, PDO::PARAM_STR);
            $sql->bindParam(2, $desc, PDO::PARAM_STR);
            $sql->bindParam(3, $price, PDO::PARAM_STR);
            $sql->bindParam(4, $qty, PDO::PARAM_INT);
            $sql->bindParam(5, $catId, PDO::PARAM_INT);
            $sql->bindParam(6, $id, PDO::PARAM_INT);
            $result = $sql->execute();
        
            if($result){
                echo "<script> alert(' Product is Updated'); window.location.href = 'product.php' ; </script>";
            }
            
        }
    }
  
?>
  <!-- Header call header.php-->
  <?php include('header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- from product.php / get edit id query -->
    <?php 
       $id=(int)htmlspecialchars(stripslashes(trim($_GET['id'])));

        $sql=$pdo->prepare("SELECT * FROM products WHERE id=:id");
        $sql->bindParam(':id',$id,PDO::PARAM_INT);

        $sql->execute();

        $result=$sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <!--/ from product.php / get edit id query -->

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col text-center mt-3">
              <h2 style="font-family: 'Noto Serif', serif; color:blue">Edit Product </h2>
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
                    <input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="5"> <?php echo $result['description'] ?> </textarea>
                </div>

               <div class="row">
                    <div class="col"> 
                        <div class="form-group">
                        <label>Price</label> <br>
                        <input type="number" name="price"  required class="form-control" value="<?php echo $result['price'] ?>">
                        </div> 
                    </div>

                    <div class="col"> 
                        <div class="form-group">
                            <label > Quantity </label> <br>
                            <input type="number" name="quantity" required class="form-control" value="<?php echo $result['quantity'] ?>">
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
                                <option value=" ">-- Select Category --</option>
                                <?php 
                                    foreach($catResult as $cat){  ?>
                                       
                                       <?php if($cat['id'] == $result['category_id']) :?>
                                            <option value="<?php echo $cat['id']?>" selected > <?php echo $cat['name'] ?>  </option>
                                       <?php else : ?>
                                            <option value="<?php echo $cat['id']?>" > <?php echo $cat['name'] ?>  </option>
                                       <?php endif  ?>
                                    
                                <?php   }  ?>
                               
                            </select>
                        </div>
                    </div>

               </div>
                
               <div class="col">                      
                    <label> Image </label> <br>
                    <img width=100px; height=100px; src="images/<?php echo $result['image'] ?> "> <br><br>
                    <input type="file" name="image"  >                        
                </div>     

                <div class="col mt-4">
                    <input type="submit" class="btn btn-outline-primary mr-4" value="UPDATE">
                    <a href="product.php" class="btn btn-success">Back</a> <br><br>
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
