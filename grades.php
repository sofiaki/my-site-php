<?php
//Grade and enrollment id sent from professor.php.
$grade=$_GET['q'];
$enrollmentId=$_GET['r'];


require 'connectDB.php';
//Grade registry
if($grade>4){
	//If the grade is passable, the enrollment state gets changed.
	$qry2 = "UPDATE enrollments SET state='0', grade='$grade' WHERE enrollment_id='$enrollmentId'";
	$result2 = $conn -> query($qry2);
}else{
	$qry = "UPDATE enrollments SET grade='$grade'  WHERE enrollment_id='$enrollmentId'";
$result = $conn -> query($qry);
}

$conn -> close();
?>