<?php 
    session_start();
    require('../config/config.php');

    if(empty($_SESSION['user_id'] )|| empty($_SESSION['logged_in']))
    {
        header("Location:index.php");
     }else{
       
         $id = (int)htmlspecialchars(stripslashes(trim($_GET['id'])));
         $sql = $pdo->prepare("DELETE FROM categories WHERE id=:id");
         $sql->bindParam(':id',$id,PDO::PARAM_INT);
         $sql->execute();
          
         header('Location:category.php');

     }
?>