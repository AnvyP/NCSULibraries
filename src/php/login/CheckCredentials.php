<?php
require_once('../connections/Connection.php');

echo "<br> <br>";
echo "UserName :".$_REQUEST["Name"];
echo "<br> <br>";
echo "Password:".$_REQUEST["PASSWORD"];

echo "<br> <br>";
echo "TYPE OF USER:".$_REQUEST["user"];

echo "<br> <br>";

// if credentials are okay then.

// if credentials fails => 
//header('Location: Login.php');

session_start();
$_SESSION['NAME'] = $_REQUEST["Name"];
$_SESSION['USER'] = $_REQUEST["user"];


header('Location: student/HomePage.php');

?>