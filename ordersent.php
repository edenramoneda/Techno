<?php
    include('db.php');
    $o_product_id = $_POST["order_product_id"];
    $o_fn = $_POST["order_product_fn"];
    $o_email = $_POST["order_product_email"];
    $o_cn = $_POST["order_product_contact_number"];
    $o_q = $_POST["order_product_quantity"];
    $o_an =  $_POST["order_product_additional_note"];
    $Optional = "Optional"; 
    $SMSMessage = "Thank you for ordering" . $o_fn . "We will get back to you shortly";
    $stmt=$pdo->prepare('INSERT INTO order_request(product_id,full_name,email,contact_number,quantity,additional_note)
    VALUES(:pid, :fn, :email, :contact_number, :quantity, :additional_note)');
    $stmt->bindParam(':pid',$o_product_id);
    $stmt->bindParam(':fn',$o_fn);
    $stmt->bindParam(':email',$o_email);
    $stmt->bindParam(':contact_number',$o_cn);
    $stmt->bindParam(':quantity',$o_q);
    if(!empty($o_an)){
        $stmt->bindParam(':additional_note',$o_an);
    }else{
        $stmt->bindParam(':additional_note',$Optional);
    }
    $stmt->execute();
    function itextmo($contact, $message, $apicode){
        $url = "https://www.itexmo.com/php_api/api.php";
        $apicode = "TR-RAMSW228556_X5RDW";
        $itextmo = array('1' => $o_cn, '2' => $SMSMessage, '3' => $apicode);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
        echo $url;
    }


?>