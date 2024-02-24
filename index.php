<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css"/>
    <title>USER DASHBOARD</title>
</head>
<body>
    <div id ="container">
        <h1>Welcome to the DASHBOARD</h1>
        <button ><a href="logout.php">logout</a></button>
    </div>
    
</body>
</html>