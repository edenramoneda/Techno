<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RAM Sweets PH</title>
    <?php

    include("header.html");

    require 'db.php';
    $query = "SELECT * FROM products";

    $stmt = $pdo->prepare($query);
    $stmt->execute();//execute select query
    $result = $stmt->fetchAll();

    $num_rows = $stmt->rowCount();//return no. of rows


?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="10">

    <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="mynavs">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center p-3" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item" id="nav-item">
                    <a href="#Home" class="nav-link nav-scroll">Home</a>
                </li>    
                    <a href="#Services" class="nav-link nav-scroll">Foods</a>
                </li>
                <li class="nav-item" id="nav-item">
                    <a href="#Contact" class="nav-link nav-scroll">Contact</a>
                </li>
            </ul>
        </div>  
    </nav>
    <section id="Home">
        <div class="overlay" id="overlay"></div>
            <div class="content text-center text-white">
                <img src="image/logo-min.png" height="120" width="150" class="animated bounceIn rounded-circle p-2">
                <h2 class="animated fadeInLeft">Welcome to RAM Sweets PH</h2>
                <p class="animated fadeInRight"><i>Scroll Down to view our products!</i></p>
                <p class="animated fadeInRight"><i>If you have any orders Please use the contact information provided below!</i></p>
            </div>
    </section>

    
    <section id="Services" class="container-fluid">
    <h2 class="text-center">Food Products</h2>
        <div class="container">
            <div class="row">
                    <?php if($num_rows > 0) { 
                            $count = 0;
                            foreach($result as $row)
                            {
                                $count = $count + 1;
                                echo '
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="card mt-4 services-card text-center">
                                <button type="button" class="btn btn-ess btn-sm" data-opid="'.$row['product_id'] . '"data-opn="' .$row['product_name'] .'"
                                data-toggle="modal" data-target="#OrderModal">Order</button>
                                <center><br><br><img class="card-img-top" src="image/'.$row['product_image'] . '" alt="image/' .$row['product_image'] . '" style="width:100%" height="200"></center>
                                <div class="card-body w-title">
                                <h5 class="card-title">'.$row['product_name']. '</h5>
                                    <div class="text-left">' .htmlspecialchars_decode($row['product_description']). '
                                    </div>
                                </div>
                            </div>
                    
                    </div>';
                            }
                        }else{
                            echo '
                            <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="card mt-4 services-card text-center">
                                <div class="card-body w-title">
                                <h5 class="card-title">No Products Found</h5>
                                </div>
                            </div>';
                            } 
                        
                        ?>
                   
            </div>
        </div>
        <div class="modal fade" id="OrderModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Order Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary form-order-req-success">
                            Order Sent!
                        </div>
                        <form method="POST" id="OrderModalForm">
                            <div class="alert alert-danger form-order-main-err">
                                Only <strong>Additional Note</strong> is Optional Field!
                            </div>
                            <div class="alert alert-primary form-order-main-success">
                                Your Order was Sent!
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="order_product_id" id="order_product_id">
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" id="order_product_name" name="order_product_name" disabled>
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="order_product_fn" name="order_product_fn">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" id="order_product_email" name="order_product_email">
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" id="order_product_contact_number" name="order_product_contact_number">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" id="order_product_quantity" name="order_product_quantity">
                            </div>
                            <div class="form-group">
                                <label>Additional Note</label>
                                <textarea class="form-control" id="order_product_additional_note" name="order_product_additional_note" rows="3" placeholder="Optional"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update" class="btn btn-ess btn-sm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </section>

    <section id="Contact" class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="container text-white">
                    <div class="alert alert-danger sm contact-form-err">
                        All Fields are Required
                    </div>
                    <div class="alert alert-success sm contact-form-success">
                        Your Message was Sent!
                    </div>
                    <form method="POST" id="ContactForm">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" placeholder="Full Name" name="fn" id="fn">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="e" id="e">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control text-left" placeholder="Message" rows="3" name="m" id="m"></textarea>
                        </div>
                        <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Lcd34UUAAAAAAvjnBOoFrF8E4KntXAjAUEkrxko" id="g-recaptcha-response"></div><br>
                            <input type="submit" class="btn btn-light btn-sm" name="submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h4 class="text-center text-white">ABOUT US</h4>
                <p class="text-justify text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sagittis justo eu erat suscipit, 
                    vel dictum tellus elementum. Nulla auctor commodo finibus. Ut ornare eget ipsum ut pulvinar. 
                    Mauris sed augue quis nisl dignissim semper in id massa. Proin sed purus augue. 
                    Cras efficitur quis augue non rhoncus. Morbi suscipit neque nunc, et rutrum nibh auctor id. 
                    Praesent viverra mauris id viverra ornare. In hac habitasse platea dictumst. Nulla vitae magna volutpat, 
                    interdum urna quis, blandit orci.
                </p>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h4 class="text-center text-white mb-3">CONTACT INFO</h4>
                <p class="text-center text-white"><a class="text-white" href="mailto:ramsweetsph@gmail.com?subject=RAM Sweets PH';"><img src="image/Gmail_80px.png" height="20" width="20"> ramsweetsph@gmail.com</a></p>
                <p class="text-center text-white"><img src="image/Phone_80px.png" height="18" width="18"> 09121928327</p>
                <p class="text-center text-white">Address: 51 A. Mendez Baesa Quezon City</p>
                <p class="text-center text-white">&copy; RAM Sweets PH <?php echo date('Y'); ?> | All Rights Reserved</p>
                
            </div>
        </div>
    </section>
<?php

include("script.html");
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134726381-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134726381-1');
</script>
</body>
</html>
