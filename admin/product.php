<?php
  session_start();
  require("../config/config.php");
  require("../config/common.php");

  if(empty($_SESSION['user_id'] ) || empty($_SESSION['logged_in']))
  {
    header("Location:index.php");
  }
?>
  <!-- Header call header.php-->
  <?php include('header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row ">

          <div class="col-4 mt-3 mb-3">
              <a type="button" class="btn btn-success" href="product_add.php"> Add New Product </a>
          </div>

          <div class="col-4 text-center mt-3">
              <h2 style="font-family: 'Noto Serif', serif; color:blue"> Product Listing </h2>
          </div>

        </div>

        <!-- php select qurey -->
        <?php
         $sql = $pdo->prepare("SELECT * FROM products ORDER BY id DESC");
         $sql->execute();
         $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        ?>
         <!--/ php select qurey -->


        <!-- Content Table -->
        <div class="row">

          <div class="col">
            <table class="tbdata table-bordered">
              <thead class="text-center">
               <tr>
                 <th> No </th>
                 <th> Category </th>
                 <th> Image </th>
                 <th> Name </th>
                 <th> Description </th>
                 <th> Price </th>
                 <th> In Stock </th>
                 <th> Actions </th>
               </tr>
            </thead>

            <tbody class="text-center">
              <!-- show content -->
              <?php
                if($result)
                { $i = 1;
                    foreach ($result as  $value)
                    {  ?>
                        <!-- Select Query products.category_id -->
                        <?php 
                            $catId = $value['category_id']; 
                            $catSql = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
                            $catSql->bindParam(":id", $catId, PDO::PARAM_INT );
                            $catSql->execute();
                            $catResult = $catSql->fetch(PDO::FETCH_ASSOC);
                        ?>
                            
                        <tr>
                            <td style="width:3%"> <?php echo $i ?></td>
                            <td style="width:12%"> <?php echo xss_Clean( $catResult['name']) ?> </td>
                            <td style="width:12%"> <img width=100px; height= 100px; src="images/<?php echo $value['image']?>" > </td>
                            <td> <?php echo xss_Clean($value['name']) ?> </td>
                            <td> <?php echo xss_Clean(substr( $value['description'] , 0, 50)) ?> </td>
                            <td style="width:10%" > <?php echo xss_Clean($value['price']).'/Kyats' ?> </td>
                            <td style="width:8%"> <?php echo xss_Clean($value['quantity']) ?> </td>
                            <td style="width:12%">
                                <a href="product_edit.php?id=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="product_delete.php?id=<?php echo $value['id'] ?>"
                                onclick = "return confirm(' As you sure want to delete')";
                                class="btn btn-outline-danger btn-sm">Delete</a>
                            </td>
                        </tr>

                        <?php  $i++;
                    }
                }
              ?>
              <!--/ show content -->
            </tbody>
          </table>
        </div>

      </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include('footer.php'); ?>
