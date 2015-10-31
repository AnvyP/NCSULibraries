<?php
$conn = null;
require_once('../../../connections/Connection.php');
function get_no_request_sql($UnityId) {
	return "SELECT p.\"ID\",
             p.\"TYPE\",
             p.\"IDENTIFIER\",
             p.\"Location\",
             p.\"IsAvailable\"
        FROM ALAKSHM6.PUBLICATIONS p
       WHERE (p.\"TYPE\", p.\"IDENTIFIER\") IN
                (SELECT w.\"Type\", w.\"Identifier\"
                   FROM ALAKSHM6.PUBLICATION_WAITLIST w
                  WHERE w.\"UnityId\" = $UnityId
                 UNION
                 SELECT d.\"Type\", d.\"Identifier\"
                   FROM PUBLICATION_DETAILS d
                  WHERE     d.\"IsReserved\" = 'Y'
                        AND d.\"Identifier\" IN
                               (SELECT r.\"Title\"
                                  FROM RESERVES r
                                 WHERE     SYSTIMESTAMP BETWEEN r.\"StartTime\"
                                                            AND r.\"ExpiryTime\"
                                       AND r.\"CourseId\" NOT IN
                                              (SELECT e.\"CourseID\"
                                                 FROM ENROLLS e
                                                WHERE     e.\"UnityID\" =
                                                             $UnityId
                                                      AND SYSTIMESTAMP BETWEEN e.\"StartDate\"
                                                                           AND e.\"EndDate\"))
                 UNION
                 SELECT p2.\"TYPE\", p2.\"IDENTIFIER\"
                   FROM ALAKSHM6.PUBLICATIONS p2
                  WHERE p2.\"ID\" IN
                           (SELECT c.\"ID\"
                              FROM PUBLICATION_CHECKOUT c
                             WHERE     c.\"UnityId\" = $UnityId
                                   AND c.\"ReturnDate\" <> '12/31/9999'))";
}

function get_can_be_checked_out_sql($UnityId) {
	return "SELECT p.\"ID\",
             p.\"TYPE\",
             p.\"IDENTIFIER\",
             p.\"Location\",
             p.\"IsAvailable\"
        FROM PUBLICATIONS p
       WHERE p.\"IsAvailable\" = 'Y'
      MINUS
      SELECT p1.\"ID\",
             p1.\"TYPE\",
             p1.\"IDENTIFIER\",
             p1.\"Location\",
             p1.\"IsAvailable\"
        FROM PUBLICATIONS p1
       WHERE (p1.\"TYPE\", p1.\"IDENTIFIER\") IN
                (SELECT w.\"Type\", w.\"Identifier\"
                   FROM ALAKSHM6.PUBLICATION_WAITLIST w
                  WHERE w.\"UnityId\" = $UnityId
                 UNION
                 SELECT d.\"Type\", d.\"Identifier\"
                   FROM PUBLICATION_DETAILS d
                  WHERE     d.\"IsReserved\" = 'Y'
                        AND d.\"Identifier\" IN
                               (SELECT r.\"Title\"
                                  FROM RESERVES r
                                 WHERE     SYSTIMESTAMP BETWEEN r.\"StartTime\"
                                                            AND r.\"ExpiryTime\"
                                       AND r.\"CourseId\" NOT IN
                                              (SELECT e.\"CourseID\"
                                                 FROM ENROLLS e
                                                WHERE     e.\"UnityID\" =
                                                             in_unityid
                                                      AND SYSTIMESTAMP BETWEEN e.\"StartDate\"
                                                                           AND e.\"EndDate\"))
                 UNION
                 SELECT p2.\"TYPE\", p2.\"IDENTIFIER\"
                   FROM ALAKSHM6.PUBLICATIONS p2
                  WHERE p2.\"ID\" IN
                           (SELECT c.\"ID\"
                              FROM PUBLICATION_CHECKOUT c
                             WHERE     c.\"UnityId\" = $UnityId
                                   AND c.\"ReturnDate\" <> '12/31/9999'))";
}

function get_add_to_waitlist_sql($UnityId) {
	$sql = "SELECT p.\"ID\",
             p.\"TYPE\",
             p.\"IDENTIFIER\",
             p.\"Location\",
             p.\"IsAvailable\"
        FROM PUBLICATIONS p
       WHERE p.\"IsAvailable\" = 'N'
      MINUS
      SELECT p1.\"ID\",
             p1.\"TYPE\",
             p1.\"IDENTIFIER\",
             p1.\"Location\",
             p1.\"IsAvailable\"
        FROM PUBLICATIONS p1
       WHERE (p1.\"TYPE\", p1.\"IDENTIFIER\") IN
                (SELECT w.\"Type\", w.\"Identifier\"
                   FROM ALAKSHM6.PUBLICATION_WAITLIST w
                  WHERE w.\"UnityId\" = $UnityId
                 UNION
                 SELECT d.\"Type\", d.\"Identifier\"
                   FROM PUBLICATION_DETAILS d
                  WHERE     d.\"IsReserved\" = 'Y'
                        AND d.\"Identifier\" IN
                               (SELECT r.\"Title\"
                                  FROM RESERVES r
                                 WHERE     SYSTIMESTAMP BETWEEN r.\"StartTime\
                                                            AND r.\"ExpiryTime\"
                                       AND r.\"CourseId\" NOT IN
                                              (SELECT e.\"CourseID\"
                                                 FROM ENROLLS e
                                                WHERE     e.\"UnityID\" =
                                                             $UnityId
                                                      AND SYSTIMESTAMP BETWEEN e.\"StartDate\"
                                                                           AND e.\"EndDate\"))
                 UNION
                 SELECT p2.\"TYPE\", p2.\"IDENTIFIER\"
                   FROM ALAKSHM6.PUBLICATIONS p2
                  WHERE p2.\"ID\" IN
                           (SELECT c.\"ID\"
                              FROM PUBLICATION_CHECKOUT c
                             WHERE     c.\"UnityId\" = $UnityId
                                   AND c.\"ReturnDate\" <> '12/31/9999'))";
	var_dump($sql);
	$add_to_waitlist_query = oci_parse($conn, $sql);
    oci_execute($add_to_waitlist_query);
    $nrows = oci_fetch_all($add_to_waitlist_query, $result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    
    echo "$nrows rows fetched<br>\n";
    var_dump($result);
    //exit(0);
    if (!$result) {
    echo oci_error();
    }else{
    	return $result;
    }
	
}

?>