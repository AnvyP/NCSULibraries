
<?php
session_start();

if(!isset($_SESSION['NAME'])){
	header('Location: ../index.php');
	echo "Some thing wrong with session";
}

echo "<a href=\"HomePage.php\">Profile!</a>";
echo "<br> <br>";
echo "<a href=\"viewPages/AccountBalance.php\">Account Balance!</a>";
echo "<br> <br>";
echo "<a href=\"viewPages/CheckedOut.php\">Checked Out Resources!</a>";
echo "<br> <br>";	

?>