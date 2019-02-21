<?php
  include('../db.php');

  $order_id = $_POST["on_p_or_id"];  
  $order_status = $_POST["on_p_status"];    
  $stmt=$pdo->prepare('UPDATE order_request SET req_status=:rStatus WHERE or_id=:orderID');
  $stmt->bindParam(':rStatus',$order_status);
  $stmt->bindParam(':orderID',$order_id);
  $stmt->execute();

?>