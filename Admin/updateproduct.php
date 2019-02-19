<?php

include('../db.php');
$product_id = $_POST["product_id"];
// $updateQuery = $pdo->prepare('SELECT * FROM products WHERE product_id=:p_id');
// $updateQuery=execute(array(':p_id'=>$product_id));
// $edit_row = $updateQuery->fetch(PDO::FETCH_ASSOC);
// extract($edit_row);


$product_name = $_POST["product_name"];
$product_desc = htmlspecialchars($_POST["product_desc_e"]);
$p_img = $_FILES["product_img_e"]["name"];
$dir = $_FILES["product_img_e"]["tmp_name"];
$imageSize = $_FILES["product_img"]["size"];
$upload_dir = "../image/";
$imgExt = strtolower(pathinfo($p_img,PATHINFO_EXTENSION));
$valid_extensions = array('jpeg','jpg','png');
$picProfile = rand(1000, 1000000)."." .$imgExt;
//unlink($upload_dir.$edit_row['product_image']);
move_uploaded_file($dir,$upload_dir.$picProfile);
$stmt=$pdo->prepare('UPDATE products SET product_name=:pName,product_description=:pDesc,product_image=:pImage
WHERE product_id=:pID');
$stmt->bindParam(':pName',$product_name);
$stmt->bindParam(':pDesc',$product_desc);
$stmt->bindParam(':pImage',$picProfile);
$stmt->bindParam(':pID', $product_id);
$stmt->execute();

?>