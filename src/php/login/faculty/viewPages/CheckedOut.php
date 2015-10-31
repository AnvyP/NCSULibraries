<?php
session_start();

if(!isset($_SESSION['NAME'])){
	header('Location: ../../index.php');
	echo "Some thing wrong with session";
}


$conn = null;
require_once('../../../connections/Connection.php');
$UnityId = $_SESSION['NAME'];

$query = "select PC.\"ID\" , PC.\"CheckoutDate\",PC.\"DueDate\",PC.\"ReturnDate\" from PUBLICATION_CHECKOUT PC,PUBLICATIONS P, PUBLICATION_DETAILS PD 
		where P.\"ID\"=PC.\"ID\" AND P.\"IDENTIFIER\"=PD.\"Identifier\" AND  P.\"TYPE\"=PD.\"Type\" AND PC.\"UnityId\"='".$UnityId."'";
var_dump($query);
$stid = oci_parse($conn, $query);
$result = oci_execute($stid);
if (!$result) {
	echo oci_error();
}else{
	//working fine.
}
echo "test";
echo "<table border =\"2\">";
echo "<tr>";
echo "<td>";
echo "ISBN : ";
echo "</td>";

echo "<td>";
echo "CheckoutDate : ";
echo "</td>";

echo "<td>";
echo "DueDate : ";
echo "</td>";

echo "<td>";
echo "ReturnDate : ";
echo "</td>";

echo "</tr>";


while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	echo "<tr>";
	echo "<td>";
	echo $row['ID'];
	//TODO: add link to the book
	echo "</td>";
	
	echo "<td>";
	echo $row['CheckoutDate'];
	echo "</td>";
	
	echo "<td>";
	echo $row['DueDate'];
	echo "</td>";

	echo "<td>";
	echo $row['ReturnDate'];
	echo "</td>";
	
	echo "</tr>";

}
echo "</table>";



//Publication Checkout
//Camera Checkout

?>