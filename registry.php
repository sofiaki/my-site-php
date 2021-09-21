<?php
echo '<meta charset="UTF-8"/>';
session_start();

$btn1 = isset($_POST['btnR'])?'1':null;	//The "Submit" button at the "Register user" form on administration.php is clicked.
$btn2 = isset($_POST['btnR2'])?'1':null; //The "Submit" button at the "Course management" form on administration.php is clicked.

//new user registration.
if(isset($btn1)){
	$nameE = $_POST['nameR'];
	$surnameE = $_POST['surnameR'];
	$emailE = $_POST['emailR'];
	$passwordE =$_POST['passwordR'];
	$roleE = $_POST['roleR'];
	$semesterR = $_POST['semesterR'];

	require 'connectDB.php';
	//Email check so that a user will not be registerd twice.
	$qryEmail = "SELECT COUNT(email) c FROM users WHERE email = '$emailE'";
	$existingEmail = $conn -> query($qryEmail);
	$row = $existingEmail -> fetch_assoc();
	if($row['c'] > 0){
		echo '<script type="text/javascript">
			if(!alert("An account with this email already exists")){
				window.location.href = "administration.php";
			}
			</script>';
	}
	else{
		//New entry in the database 
		$qryE = "INSERT INTO users (name, surname, email, password, role) VALUES ('$nameE','$surnameE','$emailE','$passwordE','$roleE')";
		$users = $conn -> query($qryE);
		//Retrieve user id to make a new entry in the semester.
		$qryE1 = "SELECT user_id FROM users WHERE email = '$emailE'";
		$userId = $conn -> query($qryE1);
		$row = $userId -> fetch_assoc();
		$id = $row['user_id'];
		
		$qryE2 = "INSERT INTO semester (user_id , sem_no) VALUES('$id','$semesterR')";
		$semester = $conn -> query($qryE2);

		if ($conn -> affected_rows >0 AND $semester == TRUE) {
		  echo '<script type="text/javascript">
				if(!alert("The new user is succefully registred.")){
					window.location.href = "administration.php";
				}
				</script>';
			;
		} else {
		  echo '<script type="text/javascript">
				if(!alert("Registration failed.")){
					window.location.href = "administration.php";
				}
				</script>';
				
		}
		unset($nameE, $surnameE, $emailE, $passwordE, $roleE, $semesterR, $users, $userId, $row, $semester, $qryE1, $id, $qryE, $qry2);
		$conn -> close();
	}
}
//new course registration.
elseif (isset($btn2)){

	$eponE = $_POST['proSurnameR'];
	$nameE = $_POST['proNameR'];
	$titleR =$_POST['titleR'];
	$courseSemR = $_POST['courseSemR'];
	$typeR =$_POST['typeR'];
	$ectsR = $_POST['ectsR'];

	require 'connectDB.php';
	//Check weather there is a professor with the given name. 
	$qryE1 = "SELECT user_id, role FROM users WHERE name = '$nameE' AND surname = '$eponE'";
	$userId = $conn -> query($qryE1);
	$row = $userId -> fetch_assoc();
	if($userId == false OR $row['role']!='Professor'){
		echo '<script type="text/javascript">
			if(!alert("No professor named '.$eponE.' '.$nameE.' is registered.")){
				window.location.href = "administration.php#menu1";
			}
			</script>';
		;
	}
	else{
		$id = $row['user_id'];
		//New course is registered in the database
		$qryE = "INSERT INTO courses (user_id, title, type, course_semester, ects) VALUES ('$id','$titleR','$typeR','$courseSemR','$ectsR')";
		$mathima = $conn -> query($qryE);

		if ($conn -> affected_rows >0) {
		  echo '<script type="text/javascript">
				if(!alert("Course succefully registered.")){
					window.location.href = "administration.php#menu1";
				}
				</script>';
			;
		} else {
		  echo '<script type="text/javascript">
				if(!alert("Register failed.")){
					window.location.href = "administration.php#menu1";
				}
				</script>';
				
		}
		unset($nameE, $eponE, $titleR, $typeR, $ectsR, $courseSemR, $users, $userId, $row, $qryE1, $mathima, $id, $qryE);
		$conn -> close();
	}	

}

?>