<?php
    session_start();
    require 'db.php';
    if(isset($_POST['register'])){
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $sql = "SELECT count(username) as num FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['num'] > 0){
            echo 'ysnd';
        }else{
            $pHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
            $sql = "INSERT INTO users(username,password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password',$pHash);

            $result = $stmt->execute();
            if($result){
                echo 'Yow';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <h1>Register</h1>
        <form action="#" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password</label>
            <input type="text" id="password" name="password"><br>
            <input type="submit" name="register" value="Register"></button>
        </form>
    </body>
</html>