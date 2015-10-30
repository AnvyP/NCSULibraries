<?php
session_start();
if(!isset($_SESSION['NAME'])){
	header('Location: ../index.php');
	echo "Some thing wrong with session";
}
echo $_SESSION['NAME'] ;
echo "<br><br>";
echo $_SESSION['USER'];
echo "<br><br>";


$conn = null;
require_once('../../connections/Connection.php');

$UnityId =  $_SESSION['USER'];
require_once('update\UpdateFacultyInfoUtils.php');
$query = "SELECT * FROM FACULTY, LIBRARYPATRON where FACULTY.UnityId = LIBRARYPATRON.UnityId AND FACULTY.UnityId =".$UnityId;
$nextPage = "update/UpdateFacultyInfo.php";
fetchAndUpdateFacultyInfo($query,$conn,$nextPage);



// HINT: Use readonly attribute in input text.
//Country: <input type="text" name="country" value="Norway" readonly><br>

?>