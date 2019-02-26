<?php
    include('db.php');
    $o_product_id = $_POST["order_product_id"];
    $o_fn = $_POST["order_product_fn"];
    $o_email = $_POST["order_product_email"];
    $o_cn = $_POST["order_product_contact_number"];
    $o_q = $_POST["order_product_quantity"];
    $o_a = $_POST["order_product_address"];
    $o_an =  $_POST["order_product_additional_note"];
    $Optional = "Optional"; 
    $stmt=$pdo->prepare('INSERT INTO order_request(product_id,full_name,email,contact_number,quantity,address,additional_note)
    VALUES(:pid, :fn, :email, :contact_number, :quantity, :address, :additional_note)');
    $stmt->bindParam(':pid',$o_product_id);
    $stmt->bindParam(':fn',$o_fn);
    $stmt->bindParam(':email',$o_email);
    $stmt->bindParam(':contact_number',$o_cn);
    $stmt->bindParam(':quantity',$o_q);
    $stmt->bindParam(':address',$o_a);
    if(!empty($o_an)){
        $stmt->bindParam(':additional_note',$o_an);
    }else{
        $stmt->bindParam(':additional_note',$Optional);
    }
    $stmt->execute();

?>