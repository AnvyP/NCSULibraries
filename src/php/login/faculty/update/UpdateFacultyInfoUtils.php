<?php

function fetchAndUpdateFacultyInfo($query,$conn,$nextPage){
	$stid = oci_parse($conn, $query);
	$result = oci_execute($stid);

	if(!$result){	
		echo oci_error();
	}

	echo "<form action=\"$nextPage?user=FACULTY\">";
	echo "<table border='1'>\n";
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		echo "<tr>\n";
		$i =1;
		foreach ($row as $item) {
			$column_name  = oci_field_name($stid, $i);
			echo "    <td>" . "<input type=\"text\" name=\"$column_name\" value=\"$item\" >". "</td>\n";
			$i++;
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	echo "<input type=\"submit\" value=\"Update\">";
	echo "</form>";
	
	
	
}

?>