<?php
    require '../db.php';
    session_start();
	if(empty($_SESSION['username']))
        header('Location: ../crypt');
        $query = "SELECT * FROM order_request WHERE req_status = 'Pending' ";

        $stmt = $pdo->prepare($query);
        $stmt->execute();//execute select query
        $result = $stmt->fetchAll();
    
        $num_rows = $stmt->rowCount();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RAM Sweets PH</title>
        <link rel="icon" href="image/logo-min.png">      
        <link rel="stylesheet" href="../fonts/fontawesome-all.min.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="../css/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="icon" href="../image/logo-min.png" type="image/png" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <meta charset="utf-8">
    <body onLoad="iFrameOn()">
    <div id="sidebar">
        <a href="javascript:void(0)" class="closebtn text-white" onclick="closeNav()"><b>&times;</b></a>
                <div class="banner text-white pt-3">
                    <div class="logo">
                        <img src="../image/logo-min.png">  
                    </div>
                    <div class="logo-name">
                        <h3>RAM Sweets PH</h3>  
                    </div>        
                </div>
                    <ul class="li-navs list-unstyled mt-3">
                        <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fa fa-chart-bar" aria-hidden="true"></i> Analytics</a>
                        </li>
                        <li class="nav-item">
                         <a class="nav-link text-white" href="products" class="text-white">
                         <i class="fa fa-pencil-alt" aria-hidden="true"></i> Add Product</a>
                        </li>
                        <li class="nav-item">
                         <a class="nav-link text-white" href="ordering" class="text-white">
                         <i class="fa fa-cart-plus" aria-hidden="true"></i>
                          Ordering
                          <span class="badge badge-danger"><?php echo  $num_rows; ?></span>
                        </a>
                        </li>
                        <li class="nav-item">
                         <a class="nav-link text-white" href="logout" class="text-white">
                         <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                        </li> 
                    </ul>

        </div>

        <div class="toggle-btn" onclick="openNav()">
                <span></span>
                <span></span>
                <span></span>
        </div>
        
        <nav class="navbar justify-content-end ess-navigation">
        </nav>

        <div id="overlay" style="width: 100%; opacity: 0.9;"></div>
    </body>

<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/parallax.js"></script>
<script type="text/javascript" src="../js/synapse.js"></script>
</html>