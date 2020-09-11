<?php
  session_start();
  require("../config/config.php");
  require("../config/common.php");

  if(empty($_SESSION['user_id'] ) || empty($_SESSION['logged_in']))
  {
    header("Location:login.php");
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
              <a type="button" class="btn btn-success" href="user_add.php"> Add New User </a>
          </div>

          <div class="col-4 text-center mt-3">
              <h2 style="font-family: 'Noto Serif', serif; color:blue"> User Listing </h2>
          </div>

        </div>

        <!-- php select qurey -->
        <?php
         $sql = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
         $sql->execute();
         $result = $sql->fetchAll();
        ?>
         <!--/ php select qurey -->


        <!-- Content Table -->
        <div class="row">

          <div class="col">
            <table class="tbdata table-bordered">
              <thead class="text-center">
               <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Role</th>
                 <th>Action</th>
               </tr>
            </thead>

            <tbody class="text-center">
              <!-- show content -->
              <?php
                if($result)
                { $i = 1;
                  foreach ($result as  $value)
                  {  ?>

                    <tr>
                      <td style="width:5%"> <?php echo $i ?></td>
                      <td> <?php echo xss_Clean( $value['name']) ?> </td>
                      <td> <?php echo xss_Clean($value['email']) ?> </td>
                      <td> <?php echo $value['role'] == 1 ? 'admin' :'user'; ?> </td>
                      <td style="width:15%">
                        <a href="user_edit.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="user_delete.php?id=<?php echo $value['id'] ?>"
                           onclick = "return confirm(' As you sure want to delete')";
                           class="btn btn-danger">Delete</a>
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
