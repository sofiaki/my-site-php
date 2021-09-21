<?php
echo '<meta charset="UTF-8"/>';
session_start();

//If the button "Delete" from the "Register/Modify User Accounts"  is pressed, the first block of code is executed. 
$btn1 = isset($_POST['btnD1'])?'1':null;
$btn2 = isset($_POST['btnD2'])?'1':null;

//Delete user account.
if (isset($btn1)){
$emailD = $_SESSION['emailRv'];
require 'connectDB.php';
$qryD = "DELETE FROM users WHERE email = '$emailD'";
$del = $conn -> query($qryD);
if($conn -> affected_rows > 0){  echo '<script type="text/javascript">
		if(!alert("Delete completed.")){
			window.location.href = "administration.php";
		}
		</script>';
}
elseif ($conn -> affected_rows == 0){  echo '<script type="text/javascript">
		if(!alert("Delete failed.")){
			window.location.href = "administration.php";
		}
		</script>';
}

if (isset($_SESSION['nameRv'])){unset($_SESSION['nameRv'], $_SESSION['emailRv'], $_SESSION['nameRv'], $_SESSION['surnameRv'],	$_SESSION['passwordRv'],	$_SESSION['roleRv']);}
$conn -> close();
}
//Delete course.
elseif (isset($btn2)){
$title = $_SESSION['courseTitle'];
require 'connectDB.php';
$qryD = "DELETE FROM courses WHERE title = '$title'";
$del = $conn -> query($qryD);
if($conn -> affected_rows > 0){  echo '<script type="text/javascript">
		if(!alert("Delete completed.")){
			window.location.href = "administration.php";
		}
		</script>';
}
elseif ($conn -> affected_rows == 0){  echo '<script type="text/javascript">
		if(!alert("Delete failed.")){
			window.location.href = "administration.php#menu1";
		}
		</script>';
}
if (isset($_SESSION['courseTitle'])){unset($_SESSION['courseTitle'], $_SESSION['typeA'],	$_SESSION['semesterMA'],	$_SESSION['ectsA'],	$_SESSION['nameDA'],	$_SESSION['surnameDA']);}
$conn -> close();
}
?>