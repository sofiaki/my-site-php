<?php
echo '<meta charset="UTF-8"/>';

session_start();

$btn1 = isset($_POST['btnM1'])?'1':null; //Button on Modify account form on administration.php is clicked.
$btn2 = isset($_POST['btnM2'])?'1':null; //Button on Modify course form on administration.php is clicked.
$btn3 = isset($_POST['btnF1'])?'1':null; //Button on My account form on student.php is clicked.
$btn4 = isset($_POST['btnK1'])?'1':null; //Button on Mn account on professor.php is clickes.
//If the button on modify account/course tab is clicked but there is no account/course selected to be modified, the user gets alerted.
if((isset($btn1) || isset($btn2)) && (!isset($_SESSION['emailRv']) && !isset($_SESSION['courseTitle']))){
	echo '<script type="text/javascript">
			if(!alert("No entry selected to modify")){
				window.location.href = "administration.php";
			}
			</script>';
		;}
if(isset($btn1)){
	$emailRv = $_SESSION['emailRv'];
	require 'connectDB.php';
	$nameM = $_POST['nameM'] == null?$_SESSION['nameRv'] : $_POST['nameM'];
	$surnameM = $_POST['surnameM'] == null?$_SESSION['surnameRv'] : $_POST['surnameM'];
	$emailM = $_POST['emailM'] == null?$_SESSION['emailRv'] : $_POST['emailM'];
	$passwordM = $_POST['passwordM'] == null?$_SESSION['passwordRv'] : $_POST['passwordM'];
	$roleM = $_POST['roleM'] == null?$_SESSION['roleRv'] : $_POST['roleM'];
//Update table
	$qryT = "UPDATE users SET name = '$nameM', surname = '$surnameM', email = '$emailM', password = '$passwordM', role = '$roleM' WHERE email = '$emailRv'";
	$resultT = $conn -> query($qryT);
	//Unset variables when update is done.
	if (isset($_SESSION['nameRv'])){unset($_SESSION['nameRv'], $_SESSION['emailRv'], $_SESSION['nameRv'], $_SESSION['surnameRv'],	$_SESSION['passwordRv'],	$_SESSION['roleRv']);}
	if($resultT==false){
		echo '<script type="text/javascript">
			if(!alert("An error has occured during data modification.")){
				window.location.href = "administration.php";
			}
			</script>';
		;
	}
	else {
		echo '<script type="text/javascript">
			if(!alert("Data is successfully modified.")){
				window.location.href = "administration.php";
			}
			</script>';
		;
	}
	unset($emailRv, $nameM, $surnameM, $emailM, $passwordM, $roleM, $qryT, $resultT);
	$conn -> close();
}
elseif(isset($btn2)){
	$titleRv = $_SESSION['courseTitle'];
	require 'connectDB.php';
	$nameM = $_POST['proNameM'] == null?$_SESSION['nameDA'] : $_POST['proNameM'];
	$surnameM = $_POST['proSurnameM'] == null?$_SESSION['surnameDA'] : $_POST['proSurnameM'];
	$titleM = $_POST['titleM'] == null?$_SESSION['courseTitle'] : $_POST['titleM'];
	$typeM = $_POST['typeM'] == null?$_SESSION['typeA'] : $_POST['typeM'];
	$semesterT = $_POST['courseSemM'] == null?$_SESSION['semesterMA'] : $_POST['courseSemM'];
	$ectsM = $_POST['ectsM'] == null?$_SESSION['ectsA'] : $_POST['ectsM'];

//Retrieve professor id to use at the next query.
	$qryT1 = "SELECT user_id, role FROM users WHERE name = '$nameM' AND surname = '$surnameM'";
	$resultT1 = $conn -> query($qryT1);
	$row = $resultT1 -> fetch_assoc();
	$DidId = $row['user_id'];
	
//Update course table
	$qryT2 = "UPDATE courses SET title = '$titleM', user_id = '$DidId', type = '$typeM', course_semester = '$semesterT', ects = '$ectsM' WHERE title = '$titleRv'";
	$resultT2 = $conn -> query($qryT2);
	if (isset($_SESSION['courseTitle'])){unset($_SESSION['courseTitle'], $_SESSION['typeA'],	$_SESSION['semesterMA'],	$_SESSION['ectsA'],	$_SESSION['nameDA'],	$_SESSION['surnameDA']);}	
	if($resultT2==false){
		echo '<script type="text/javascript">
			if(!alert("An error has occured during data modification.")){
				window.location.href = "administration.php#menu1";
			}
			</script>';
		;
	}
	else {
		echo '<script type="text/javascript">
			if(!alert("Data successfulle modified.")){
				window.location.href = "administration.php#menu1";
			}
			</script>';
		;
	}
	unset($titleRv, $nameM, $surnameM, $titleM, $typeM, $semesterT, $ectsM, $qryT1);
	$conn -> close();
}elseif(isset($btn3)){
	$id = $_SESSION['student_id'];
	require 'connectDB.php';
	$passwordF = $_POST['passwordF'] == null?$_SESSION['password'] : $_POST['passwordF'];
	$addressF = $_POST['addressF'] == null?$_SESSION['address'] : $_POST['addressF'];
	$phoneF = $_POST['phoneF'] == null?$_SESSION['phone'] : $_POST['phoneF'];
	$gennisiF = $_POST['gennisiF'] == null?$_SESSION['birthdate'] : $_POST['gennisiF'];
	
	//Udate user table
	$qryF = "UPDATE users SET password = '$passwordF', address = '$addressF', phone = '$phoneF', birthdate = '$gennisiF' WHERE user_id='$id'";
	$resultF = $conn -> query($qryF);
	//unset($_SESSION['password'], $_SESSION['address'], $_SESSION['phone'], $_SESSION['birthdate']);
	if($resultF==false){
		echo '<script type="text/javascript">
			if(!alert("An error has occured during data modification.")){
				window.location.href = "student.php#home";
			}
			</script>';
		;
	}
	else {
		echo '<script type="text/javascript">
			if(!alert("Data successfully modified.")){
				window.location.href = "student.php#home";
			}
			</script>';
		;
	}
	unset($passwordF, $addressF, $phoneF, $gennisiF, $qryF);
	$conn -> close();
}elseif(isset($btn4)){
	$id = $_SESSION['professor_id'];
	require 'connectDB.php';
	$passwordK = $_POST['passwordK'] == null?$_SESSION['password'] : $_POST['passwordK'];
	$addressK = $_POST['addressK'] == null?$_SESSION['address'] : $_POST['addressK'];
	$phoneK = $_POST['phoneK'] == null?$_SESSION['phone'] : $_POST['phoneK'];
	$gennisiK = $_POST['gennisiK'] == null?$_SESSION['birthdate'] : $_POST['gennisiK'];
	
	//Update user table
	$qryK = "UPDATE users SET password = '$passwordK', address = '$addressK', phone = '$phoneK', birthdate = '$gennisiK' WHERE user_id='$id'";
	$resultK = $conn -> query($qryK);
	//unset($_SESSION['password'], $_SESSION['address'], $_SESSION['phone'], $_SESSION['birthdate']);
	if($resultK==false){
		echo '<script type="text/javascript">
			if(!alert("An error has occured during data modification..")){
				window.location.href = "professor.php#home";
			}
			</script>';
		;
	}
	else {
		echo '<script type="text/javascript">
			if(!alert("Data successfully modified.")){
				window.location.href = "professor.php#home";
			}
			</script>';
		;
	}
	unset($passwordK, $addressK, $phoneK, $gennisiK, $qryK);
	$conn -> close();
}
?>