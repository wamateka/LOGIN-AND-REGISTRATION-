<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta namr ="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="main.css"/>
        <title>USER REGISTRATION</title>
    </head>
    <body>
        <div id ="container">
        <?php
        if(isset($_POST["submit"])){
            $userName =  $_POST["userName"];
            $email =  $_POST["email"];
            $password =  $_POST["password"];
            $cpassword =  $_POST["cpassword"];     

            $passwordHarsh = password_hash($password, PASSWORD_DEFAULT);
            $errors = array();


            if(empty($userName) OR empty($email) OR empty($password) OR empty($cpassword)){
                array_push($errors,"All fields are required ");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid ");
            }
            if(strlen($password)<8){
                array_push($errors, "Password must be at leat 8 characters long ");
            }
            if($password!==$cpassword){
                array_push($errors, "Passwords do not match ");
            }
            require_once "db.php";
            $sql=  "SELECT * FROM users WHERE email ='$email'";
            $results = mysqli_query($conn, $sql);
            $rowCount =mysqli_num_rows($results);
            if($rowCount>0){
                array_push($errors,"Email already exists!");
            }
            if(count($errors)>0){
                foreach($errors as $error) {
                    echo "<div class = 'alert' >$error</div> ";
                }
            }else{
                require_once "db.php";
                // Prepare the SQL query to insert the data into the table
                $sql = " INSERT INTO users (userName, email, password) values(?,?,?)";
                $stmt =mysqli_stmt_init($conn);
                $prepareStmt =mysqli_stmt_prepare($stmt, $sql);
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt,"sss", $userName, $email,$passwordHarsh);
                    mysqli_stmt_execute($stmt);
                    echo"<div class= 'success'>You are registered successfully!</div>";
                }
            }
        }
        ?>
       
       <form action = "registration.php" method ="post">
        <h1>USER REGISTRATION</h1>
        <label for="userName">username:</label>
        <input type="text" id="userName" name="userName">
        <br>
        <label for="email">email:</label>
        <input type="email" id="email" name="email">
        <br>
        <label for="password" >password:</label>
        <input type="password" id="password" name ="password">
        <br>
        <label for="cpassword" >confirm password:</label>
        <input type="password" id="cpassword" name ="cpassword">
        <button type ="submit" name ="submit">Register</button>
        <p>Already registered, <a href="login.php">  login here</a></p>
       </form>
    </div>
    </body>
</html> 