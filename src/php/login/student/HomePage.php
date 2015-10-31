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

require_once('update\UpdateStudentInfoUtils.php');
$UnityId = $_SESSION['NAME'] ;
$query = "select S.\"UnityId\",S.\"StudentNo\",S.\"PhoneNo\",S.\"AlternatePhoneNo\",S.\"HomeAddress\",S.\"DateOfBirth\",S.\"Sex\",S.\"DegreeProgram\",S.\"Category\",S.\"isHeld\",L.\"Name\",L.\"Nationality\",L.\"Department\",L.\"Type\",L.\"Balance\" FROM STUDENT S, LIBRARYPATRON L WHERE S.\"UnityId\" = L.\"UnityId\" and S.\"UnityId\" = "."'".$UnityId."'";
$nextPage = "update/UpdateStudentInfo.php";
fetchAndUpdateStudentInfo($query,$conn,$nextPage);

//session_destroy();

// HINT: Use readonly attribute in input text.
//Country: <input type="text" name="country" value="Norway" readonly><br>
?>