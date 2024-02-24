<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css"/>
    <title>login</title>
</head>
<body>
    <div id ="container">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "db.php";
            $sql ="SELECT * FROM users WHERE email = '$email'";
            $results = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($results, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = 'yes';
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class = 'alert'>password does not match</div>";
                }

            }else{
                echo "<div class = 'alert'>Email does not exist</div>";
            }


        }
        ?>
    <form action = "login.php" method ="post">
        <h1>USER LOGIN</h1>
        <label for="email">username:</label>
        <input type="email" id="email" name="email">
        <br>
        <label for="password">password:</label>
        <input type="password" id="password" name="password">
        <br>
        <button type ="submit" name ="login">login</button>
        <p>Not registered yet, <a href="registration.php">  Register here</a></p>
    </form>
    </div>
    
</body>
</html>