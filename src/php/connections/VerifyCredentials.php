<?php
function verifyCredentials($conn,$user,$password){
	$query = "select * from _TABLENAME_ where username=".$user." and password".$password;
	$stid = oci_parse($conn, $query);
	oci_execute($stid);

	$noOfRows = oci_num_rows($stid) ;
	oci_free_statement($stid);

	if($noOfRows ==1){
		return true;
	}else{
		return false;
	}
}
?>