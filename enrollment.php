<?php

$course_id=$_GET['q'];
$student_id=$_GET['r'];

//Retrieve course data for given student and course.
require 'connectDB.php';
$eggrafi = "SELECT state, enrollment_id FROM enrollments WHERE user_id = $student_id AND course_id = $course_id";
$result = $conn->query($eggrafi);
$row = $result->fetch_assoc();

$enrolled = $row['state'];
$enrollment_id = $row['enrollment_id'];

//If theres is no enrollment for that course, an new one is created in the database.
if ($result->num_rows == 0) {
	$conn->query("INSERT INTO enrollments (course_id, user_id, state) VALUES ($course_id, $student_id, '1')");
}
//If there is an enrollment its state changes.
elseif($enrolled == 0){
	$conn->query("UPDATE enrollments SET state = '1' WHERE enrollment_id = $enrollment_id");
}
elseif($enrolled == 1){
	$conn->query("UPDATE enrollments SET state = '0' WHERE enrollment_id = $enrollment_id");
}


$conn -> close();
?>