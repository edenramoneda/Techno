<?php
    include('../db.php');
    $product_id = $_POST["product_id"];

    $stmt = $pdo->prepare("DELETE FROM products WHERE product_id=:pID");
    $stmt->bindParam(':pID', $product_id);
    $stmt->execute();
  //  echo 'Successfully Deleted';
?>