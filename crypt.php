<?php
    session_start();
    require 'db.php';
    
    if(isset($_POST['login'])){
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $sql = "SELECT username, password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $IncorrectP = "Incorrect Password or Username";
        if($user === false){
            die($IncorrectP);
        }else{
            $VPassword = password_verify($password, $user['password']);
            if($VPassword){
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header('Location:Admin/home');
                exit;
            }else{
                die($IncorrectP);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RAM Sweets PH</title>
        <link rel="icon" href="image/logo-min.png">   
         <?php
            include('header.html');
         ?>
         <style>
             body
                {
                            background-image:url("{{ asset('image/Human-Resources.jpg') }}");
                            background-position:center;
                            background-size:cover;
                            width:100%;
                            height:100vh;
                            overflow:hidden !important;
                }
                .overlay
                    {
                            width: 100%;
                            height: 100vh;
                            z-index:5;
                            background: #9900ff; /* fallback for old browsers */
                            background: #9900ff; /* Chrome 10-25, Safari 5.1-6 */
                            position: absolute;
                            opacity: .8;
                    } 
         </style>
    </head>
    <body>
        <div class="overlay"></div>    
        <div class="login-form mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <img src="image/logo-min.png">
                                <h2> RAM Sweets PH <br><span>Login Form</span></h2>
                                
                            </div>
                            <div class="card-body">
                                <form action="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="username" class="form-control" name="username">
                                    </div>  

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="Login" class="btn btn-mybutton full-width" name="login">Login</button><br>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </body>
</html>