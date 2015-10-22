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




// HINT: Use readonly attribute in input text.
//Country: <input type="text" name="country" value="Norway" readonly><br>

?>