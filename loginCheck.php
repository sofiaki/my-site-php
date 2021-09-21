<?php
echo '<meta charset="UTF-8"/>';
session_start();
$email = $_POST['email'];
$password =$_POST['password'];
require 'connectDB.php';
$_SESSION['email'] = $email;
//Retrieve account with given email and password.
$qry = "SELECT * FROM users WHERE email = '$email'";
$result = $conn -> query($qry);


//If the query returns empty there is no account with given email or password.
if ($result -> num_rows == 0) {

		echo '<script type="text/javascript">
		if(!alert("The email or password is invalid")){ 
			window.location.href = "login.php";
		}
		</script>';
	

	
}
else {
	
	$row = $result -> fetch_assoc();
	$_SESSION['name'] = $row['name'];
	$_SESSION['surname'] = $row['surname'];
	$_SESSION['role'] = $row['role'];
	
//Depending on the user's role, they get redirected to the respective page. 
	if ($_SESSION['role'] == 'Administration') {
		header('Location: administration.php');
	}
	else if ($_SESSION['role'] == 'Professor'){
		$_SESSION['professor_id'] = $row['user_id'];
		header('Location: professor.php');
	}
	else if ($_SESSION['role'] == 'Student'){
		$_SESSION['student_id'] = $row['user_id']; 
		header('Location: student.php');
	}
}
$result -> close(); 
$conn -> close(); 
?>