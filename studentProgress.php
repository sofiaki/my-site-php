<?php
$id=$_GET['q'];


//Retrieve the courses the student is enrolled in.
require 'connectDB.php';

$qry = $conn->query("SELECT surname, name  FROM users WHERE user_id=$id"); 
$rowOn=$qry->fetch_assoc();
$prV = $conn->query("SELECT COUNT(*) c FROM enrollments JOIN courses ON enrollments.user_id=$id  AND grade>=5 AND courses.course_id=enrollments.course_id AND courses.type='Required'"); 
$rowV=$prV->fetch_assoc(); 
$resP = $conn->query("SELECT COUNT(*) c FROM courses WHERE type='Required' AND course_id NOT IN (SELECT course_id FROM enrollments WHERE user_id=$id AND grade>=5)"); 
$rowP=$resP->fetch_assoc();
$resD = $conn->query("SELECT COUNT(*) c FROM enrollments WHERE state='1' AND grade<5 AND user_id=$id"); 
$rowD=$resD->fetch_assoc();
$resEpr = $conn->query("SELECT COUNT(*) c FROM courses JOIN enrollments ON enrollments.user_id=$id  AND courses.course_id=enrollments.course_id AND courses.type='Elective' AND grade>=5"); 
$rowEpr=$resEpr->fetch_assoc();
if($rowEpr['c']==0){
	$e='1';}
	else{$e='0';}
$resM = $conn->query("SELECT SUM(courses.ects) c FROM courses JOIN enrollments ON courses.course_id=enrollments.course_id AND enrollments.user_id=$id AND enrollments.grade>=5"); 
$rowM=$resM->fetch_assoc();
$resMp = $conn->query("SELECT SUM(ects) c FROM courses WHERE course_id NOT IN (SELECT course_id FROM enrollments WHERE user_id=$id AND grade>=5)"); 
$rowMp=$resMp->fetch_assoc();

echo '<p>'. $rowOn['surname'].' '. $rowOn['name'] .'</p>'.
'<p>Required courses with passable grade: '. $rowV['c'].'</p>'.
'<p>Required courses to graduate: '. $rowP['c'] .'</p>'.
'<p>Number of enrolled courses: '. $rowD['c'] .'</p>'.
'<p>Elective courses with passable grade: '.	$rowEpr['c'] .'</p>'.									 
'<p>Elective courses to graduate: '.$e.'</p>'.
'<p>ECTS: '.$rowM['c'].'</p>'.
'<p>ECTS to graduate:  '. ($rowMp['c']-5).'</p>';					 

$conn -> close();
?>