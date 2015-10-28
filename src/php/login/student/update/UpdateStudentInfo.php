<?php
session_start();
//UnityId,StudentNo,Name,PhoneNo,AlternatePhoneNo,HomeAddress,DateOfBirth,Sex,Nationality,Department,
//Classification,DegreeProgram,Category
$conn = null;
require_once('../../../connections/Connection.php');


$StudentNo = $_REQUEST['StudentNo'];
$Name = $_REQUEST['Name'];
$PhoneNo = $_REQUEST['PhoneNo'];
$AlternatePhoneNo = $_REQUEST['AlternatePhoneNo'];
$HomeAddress = $_REQUEST['HomeAddress'];
$DateOfBirth = $_REQUEST['DateOfBirth'];
$Sex = $_REQUEST['Sex'];
$Nationality = $_REQUEST['Nationality'];
$Department = $_REQUEST['Department'];
$Classification = $_REQUEST['Classification'];
$DegreeProgram = $_REQUEST['DegreeProgram'];
$Category = $_REQUEST['Category'];

$UnityId = $_REQUEST['UnityId'];

$query = "UPDATE STUDENT
SET \"StudentNo\"='$StudentNo',\"Name\"='$Name',\"PhoneNo\"='$PhoneNo',\"AlternatePhoneNo\"='$AlternatePhoneNo',\"HomeAddress\"='$HomeAddress',
\"DateOfBirth\"='$DateOfBirth',\"Sex\"='$Sex',
\"Nationality\"='$Nationality',\"Department\"='$Department',\"Classification\"='$Classification',\"DegreeProgram\"='$DegreeProgram',
\"Category\"='$Category'
 WHERE \"UnityId\"='$UnityId'";
var_dump($query);
$stid = oci_parse($conn, $query);
$result = oci_execute($stid);
if (!$result) {
	echo oci_error();
}else{
	header('Location: ../HomePage.php');
}
?>