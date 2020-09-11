<?php
  require("../config/config.php");
  $id = $_GET['id'];
  $sql = $pdo->prepare('DELETE FROM users WHERE id = :id');
  $sql->bindValue(":id",$id);
  $sql->execute();
  header("Location:user_list.php");
?>
