<?php

session_start();

if(!isset($_SESSION['NAME'])){
	header('Location: ../../index.php');
	echo "Some thing wrong with session";
}
$conn = null;
require_once('../../../connections/Connection.php');
$UnityId = $_SESSION['NAME'];

$query = "update LIBRARYPATRON set \"Balance\"=0 where \"UnityId\"='".$UnityId."'";
var_dump($query);
$stid = oci_parse($conn, $query);
$result = oci_execute($stid);
if (!$result) {
	echo oci_error();
}else{
	header( "Location: AccountBalance.php" );
}

?>