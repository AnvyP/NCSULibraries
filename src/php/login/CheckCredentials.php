<?php

$conn = null;

require_once('../connections/Connection.php');

echo "<br> <br>";
echo "UserName :".$_REQUEST["Name"];
echo "<br> <br>";
echo "Password:".$_REQUEST["PASSWORD"];

echo "<br> <br>";
echo "TYPE OF USER:".$_REQUEST["user"];

echo "<br> <br>";


require_once ('../connections/VerifyCredentials.php');


if(verifyCredentials($conn,$_REQUEST["Name"],$_REQUEST["PASSWORD"])){
	// if credentials are okay then.
	session_start();
	$_SESSION['NAME'] = $_REQUEST["Name"];
	$_SESSION['USER'] = $_REQUEST["user"];

	if($_SESSION['USER'] == "STUDENT"){
		header('Location: student/HomePage.php');
	}else{
		header('Location: faculty/HomePage.php');
	}
}else{
	// if credentials fails =>
	//header('Location: Login.php');
	header('Location: index.php');
}

?>