<?php

$hostName ="localhost";
$dbUser ="root";
$dbPassword ="";
$dbName="login_reg";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$conn){
    die("somethin went wrong");
}
?>