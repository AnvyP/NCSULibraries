<?php

session_start();

if(!isset($_SESSION['NAME'])){
	header('Location: ../../index.php');
	echo "Some thing wrong with session";
}


$conn = null;
require_once('../../../connections/Connection.php');
$UnityId = $_SESSION['NAME'];


// "<a href= \"RenewResource.php?ID=".$row['ID']."&CHECKOUT_DATE=".
// 		$row['CheckoutDate']."&IS_BOOK=Y&IDENTIFIER=".$row['Identifier']."&TYPE=".$row['Type']."		\"> Renew </a>";

$ID=$_REQUEST['ID'];
$CheckoutDate=$_REQUEST['CHECKOUT_DATE'];
$Identifier=$_REQUEST['IDENTIFIER'];
$Type=$_REQUEST['TYPE'];

$queryCheckIfPplinQueue= "Select * from PUBLICATION_WAITLIST PW
where PW.\"Identifier\"='$Identifier'  PW.\"Type\"='$Type' ";


var_dump($queryCheckIfPplinQueue);
$stid = oci_parse($conn, $queryCheckIfPplinQueue);
$result = oci_execute($stid);
if (!$result) {
	echo oci_error();
}else{
	//working fine.
}
$rows=oci_num_rows($stid);
echo  $rows. " rows inserted.<br />\n";
oci_free_statement($stid);

if($rows>0){
	// there are ppl in WAITLIST/QUEUE
	echo "Can't renew , as there are ppl in the queue for the book";
}else{
	
}

?>