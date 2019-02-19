<?php
    include('../db.php');

       $product_name = $_POST["product_name"];
       $product_desc = htmlspecialchars($_POST["product_desc"]);
       
       $p_img = $_FILES["product_img"]["name"];
       $dir = $_FILES["product_img"]["tmp_name"];
       $imageSize = $_FILES["product_img"]["size"];
       $upload_dir = "../image/";
       $imgExt = strtolower(pathinfo($p_img,PATHINFO_EXTENSION));
       $valid_extensions = array('jpeg','jpg','png');
       $picProfile = rand(1000, 1000000)."." .$imgExt;
       move_uploaded_file($dir, $upload_dir.$picProfile);
       $stmt=$pdo->prepare('INSERT INTO products(product_name,product_description,product_image)
       VALUES(:pname, :pdesc,:pimg)');
       $stmt->bindParam(':pname',$product_name);
       $stmt->bindParam(':pdesc',$product_desc);
       $stmt->bindParam(':pimg',$picProfile);
       $stmt->execute();
       
?>