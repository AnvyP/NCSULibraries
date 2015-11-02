<?php

session_start();

if(!isset($_SESSION['NAME'])){
	header('Location: ../index.php');
	echo "Some thing wrong with session";
}

$conn = null;
require_once('../../../connections/Connection.php');
$UnityId = $_SESSION['NAME'];

$startDay = $_REQUEST['startDate'];
$startTime = $_REQUEST['startTime'];

$endDay = $_REQUEST['endDate'];
$endTime = $_REQUEST['endTime'];

$occupancy = $_REQUEST['occupancy'];
$type = "Study";
echo "$UnityId $startDay $startTime  $endDay $endTime $occupancy";
echo "<br> <br>";
$from_time = strtotime($startDay." ".$startTime);
$to_time = strtotime($endDay." ".$endTime);
echo "differnce in time between $to_time , $from_time: ";
$duration_min= round(abs($to_time - $from_time) / 60,2). " minute";
echo"$duration_min";


echo "<br><br>";
echo "DATETIME in USA FORMAT";
echo "<br><br>";

$date = date_create();
date_format($date,'m-d-Y H:i:s');
$startDateUSA=date_format(date_timestamp_set($date, $from_time),'d/M/Y h:i:s A');

$endDateUSA=date_format(date_timestamp_set($date, $to_time),'d/M/Y h:i:s A');


echo "startDateTime " .$startDateUSA . "\n";
echo "<br><br>";
echo "endDateTime " .$endDateUSA. "\n";
echo "<br><br>";

$selectRoomQuery ="SELECT r.\"RoomNumber\",r.\"Location\",r.\"Floor\"
FROM ROOM r
WHERE r.\"RoomNumber\" NOT IN (
SELECT rr.\"RoomNumber\" FROM ROOM_RESERVATION rr
WHERE NOT (rr.\"EndTime\"   < CAST('{$startDateUSA}' AS TIMESTAMP)
OR
rr.\"StartTime\" > CAST('{$endDateUSA}' AS TIMESTAMP)))
AND r.\"Capacity\" > $occupancy
AND r.\"Type\" = '{$type}'
ORDER BY r.\"RoomNumber\"";

var_dump($selectRoomQuery);
$stid = oci_parse($conn, $selectRoomQuery);
$result = oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {

	echo "Room Number ".$row['RoomNumber']." Location ".$row['Location']." Floor ".$row['Floor'];
	echo"<br>";

}



?>