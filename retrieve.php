<?php
echo '<meta charset="UTF-8"/>';

session_start();

$btn1 = isset($_POST['btnRv'])?'1':null; //User search button on administration.php is clicked.
$btn2 = isset($_POST['btnRv2'])?'1':null; //Course serach button on administration.php is clicked.
$foititis = isset($_SESSION['student_id'])?'1':null;

//Retrieve user data.
if(isset($btn1)){
	$emailRv = $_POST['emailRv'];
	require 'connectDB.php';
	$qryA1 = "SELECT user_id, name, surname, password, role FROM users WHERE email = '$emailRv'";
	$resultA1 = $conn -> query($qryA1);
	$row1 = $resultA1 -> fetch_assoc();
	if ($resultA1 -> num_rows == 0) {

			echo '<script type="text/javascript">
			if(!alert("No account with given email is found.")){ 
				window.location.href = "administration.php";
			}
			</script>';
	}
	else{
		$idA = $row1['user_id'];
		$_SESSION['emailRv'] = $emailRv ;
		$_SESSION['nameRv'] = $row1['name'];
		$_SESSION['surnameRv'] = $row1['surname'];
		$_SESSION['passwordRv'] = $row1['password'];
		$_SESSION['roleRv'] = $row1['role'];

		$qryA2 = "SELECT sem_no FROM semester WHERE user_id = '$idA'";
		$resultA2 = $conn -> query($qryA2);
		$row2 = $resultA2 -> fetch_assoc();
		$_SESSION['semesterRv'] = $row2['sem_no'];
		header("Location:administration.php");
	}
	unset($btn1, $row1, $row2, $resultA1, $resultA2, $qryA1, $qryA2);
	$conn -> close();
}
//Retrieve course data.
elseif(isset($btn2)){
	
	$titleRv = $_POST['titleRv'];
	require 'connectDB.php';
	$qryA1 = "SELECT user_id, type, course_semester, ects FROM courses WHERE title = '$titleRv'";
	$resultA1 = $conn -> query($qryA1);
	$row1 = $resultA1 -> fetch_assoc();
	if ($resultA1 -> num_rows == 0) {

			echo '<script type="text/javascript">
			if(!alert("No such course is found.")){ 
				window.location.href = "administration.php#menu1";
			}
			</script>';
	}
	else{
		$idA = $row1['user_id'];
		$_SESSION['courseTitle'] = $titleRv ;
		$_SESSION['typeA'] = $row1['type'];
		$_SESSION['semesterMA'] = $row1['semester'];
		$_SESSION['ectsA'] = $row1['ects'];

		$qryA2 = "SELECT name, surname FROM users WHERE user_id = '$idA'";
		$resultA2 = $conn -> query($qryA2);
		$row2 = $resultA2 -> fetch_assoc();
		$_SESSION['nameDA'] = $row2['name'];
		$_SESSION['surnameDA'] = $row2['surname'];
		header("Location:administration.php#menu1");
	}
	unset($btn2,  $row1, $row2, $resultA1, $resultA2, $qryA1, $qryA2);
	$conn -> close();
}

?>