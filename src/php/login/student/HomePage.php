<?php
session_start();

echo $_SESSION['NAME'] ;
echo "<br><br>";
echo $_SESSION['USER'];
echo "<br><br>";
$conn = null;
require_once('../../connections/Connection.php');

require_once('../../connections/ConnectionStatement.php');
$query = "SELECT * FROM COFFEES";
fetchTuples($query,$conn);



// HINT: Use readonly attribute in input text.
//Country: <input type="text" name="country" value="Norway" readonly><br>
?>