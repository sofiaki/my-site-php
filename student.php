<?php
echo '<meta charset="UTF-8"/>';
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="Student")
{
    echo '<script type="text/javascript">
		if(!alert("Please login to access this page")){ 
			window.location.href = "login.php";
		}
		</script>';
}
include 'includeHeader.php';

$id = $_SESSION['student_id'];
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
//Retrieve student data.
require 'connectDB.php';
$qry = "SELECT password, address, phone, birthdate FROM users WHERE user_id = '$id'";
$result = $conn -> query($qry);
$row = $result -> fetch_assoc();
$_SESSION['password'] = $row['password'];
$_SESSION['address'] = $row['address'];
$_SESSION['phone'] = $row['phone'];
$_SESSION['birthdate'] = $row['birthdate'];

$qry2 = "SELECT sem_no FROM semester WHERE user_id= '$id'";
$result2 = $conn -> query($qry2);
$row2 = $result2 -> fetch_assoc();
$semester = $row2['sem_no'];

//Retrieve data for course table.
$stmt = $conn->prepare("SELECT courses.course_id, courses.title, courses.ects, courses.type, users.surname, users.name, enrollments.enrollment_id, enrollments.grade, enrollments.state  FROM courses INNER JOIN users ON  courses.user_id = users.user_id AND course_semester = ? LEFT JOIN enrollments ON enrollments.user_id = '$id' AND enrollments.course_id = courses.course_id ORDER BY courses.type");
$stmt->bind_param("i", $sem);
$stmt->bind_result($course_id, $title, $ects, $type, $surnameD, $nameD, $enrollment_id, $grade, $enrolled);

//Query to find the number of optional courses.
$typeQ = $conn->query("SELECT COUNT(*) c FROM courses JOIN enrollments ON enrollments.user_id=$id  AND courses.course_id=enrollments.course_id AND courses.type='Elective' AND (enrollments.state='1' OR enrollments.grade>0)"); 
$elective=$typeQ->fetch_assoc();


unset($row, $result, $qry, $row2, $result2, $qry2);

?>
<script type="text/javascript" src="script/enrollmentVars.js"></script>
<!--Javascript to show the same tab after page refresh-->
<script>
$(function () {
          var hash = window.location.hash;
          hash && $('ul.nav a[href="' + hash + '"]').tab('show');
 
          $('.nav-tabs a').click(function (e) {
              $(this).tab('show');
              var scrollmem = $('body').scrollTop();
              window.location.hash = this.hash;
              $('html,body').scrollTop(scrollmem);
          });
      });
</script>

<div class="container-fluid mps">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#home">My account</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#menu1">My courses</a>
		</li>
	</ul>

	<div class="tab-content">
		<div id="home" class="container tab-pane active"><br>
			<div class="row">
				<div class="col-4">				
					<!--Form to modify account-->
					<form name="formF1" action="/modify.php" method="post" onsubmit="return passwordLengthCheck(this.passwordF.value)">
						<div class="form-group">
							<label for="nameF">Name:</label>
							<input type="text" class="form-control" id="nameF" name="nameF" placeholder="<?php echo $name;?>" disabled>
						</div>
						<div class="form-group">
							<label for="surnameF">Surname:</label>
							<input type="text" class="form-control" id="surnameF" name="surnameF" placeholder="<?php echo $surname;?>" disabled>
						</div>		
						<div class="form-group">
							<label for="emailF">Email:</label>
							<input type="email" class="form-control" id="emailF" name="emailF" placeholder="<?php echo $_SESSION['email'];?>" disabled>
						</div>
				</div>
				<div class="col-4">
						<div class="form-group">
							<label for="passwordF">Password:</label>
							<input type="password" class="form-control" id="passwordF" name="passwordF" placeholder="<?php echo $_SESSION['password'];?>">
						</div>
						<div class="form-group">
							<label for="addressF">Address:</label>
							<input type="text" class="form-control" id="addressF" name="addressF" placeholder="<?php echo $_SESSION['address'];?>">
						</div>
						<div class="form-group">
							<label for="phoneF">Phone number:</label>
							<input type="int" class="form-control" id="phoneF" name="phoneF" placeholder="<?php echo $_SESSION['phone'];?>">
						</div>
						<div class="form-group">
							<label for="gennisiF">Date of birth:</label>
							<input type="text" class="form-control" id="gennisiF" name="gennisiF" placeholder="<?php echo $_SESSION['birthdate'];?>" onfocus="(this.type='date')" onblur="(this.type='text')">
						</div>
						<button name="btnF1" type="submit" class="mybutton">Submit</button>
					</form>
				</div>
			</div>
			
		</div>
		<div id="menu1" class="tab-pane fade">
			<div class="row">
				<div class="col-12">
					<h3>Courses</h3>
					<!--Course Table-->
					<table class="table table-bordered text-primary w-auto">
						<thead class="thead-light">
							<tr>
								<th scope="col">Semester</th>
								<th scope="col">Course</th>
								<th scope="col">Professor</th>
								<th scope="col">ECTS</th>
								<th scope="col">Type</th>
								<th scope="col">Grade</th>
								<th scope="col">Enrollment</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								
								<?php 
									$sem=1;
									while($sem<=3){
									$span = ($sem==3)?'4':'3';
									echo '<td rowspan="'.$span.'" class="align-middle text-center">'.$sem.'</td>';
									$stmt->execute();
									while($stmt -> fetch()){	//New table line for every course.
										echo '<td class="'.$course_id.'">'.$title.'</td><td class="'.$course_id.'">'.$surnameD.' '.$nameD.'</td><td class="'.$course_id.'">'.$ects.'</td><td class="'.$course_id.'">'.$type.'</td><td class="'.$course_id.'">'.$grade.'</td><td class="'.$course_id.'">';
										//If the student has passed the course, the respective line is coloured green.
										if($grade>=5){
										echo'<script>$(".'.$course_id.'").css("background-color","lightgreen")</script> ';}
										elseif($grade<5||$grade==null){
											if($sem<=$semester && $enrolled==0){ 
											//If the course is elective and theres are more elctives courses in  the database, the other courses are coloured grey.
												if($type == 'Elective' && $elective['c']>0){
													echo'<script>$(".'.$course_id.'").css("background-color","lightgray")</script> ';
													}else{
														
											//The student can be enrolled on a course that is to be taken in the same semester as the sudent's progress or less.
													echo '<button type="submit" name="btn1" class="btn btn-success" id='.$course_id.' onclick="enrollment(this.id,'.$id.')">Enroll</button>';}
											//If the student is enrolled on the course theres is an option to unenroll.
											}elseif($sem<=$semester && $enrolled==1){
												echo '<button type="submit" name="btn2" class="btn btn-danger" id='.$course_id.' onclick="enrollment(this.id,'.$id.')">Leave course</button>';
										    //If the course is of a semster greater the that of the student, the line is coloured grey and there is not an option for enrollment.
											}elseif($sem>$semester){
													echo'<script>$(".'.$course_id.'").css("background-color","lightgray")</script> ';
											}
											
										}
										echo '</td></tr><tr>';
									}
									$sem++;
									}
										
								?>
							</tr>
						</tbody>
					</table>
					<p id="pi"></p>
				</div>
			</div>

			<div class="row">
				<div class="col-4">
					<p>Semester: <?php echo $semester;?></p>
					
					<p>Requiered courses with passable grade: <?php $prV = $conn->query("SELECT COUNT(*) c FROM enrollments JOIN courses ON enrollments.user_id=$id  AND grade>=5 AND courses.course_id=enrollments.course_id AND courses.type='Required'"); 
										 $rowV=$prV->fetch_assoc(); echo $rowV['c'];?></p>
										 
					<p>Required courses to graduate: <?php $resP = $conn->query("SELECT COUNT(*) c FROM courses WHERE type='Required' AND course_id NOT IN (SELECT course_id FROM enrollments WHERE user_id=$id AND grade>=5)"); 
										 $rowP=$resP->fetch_assoc(); echo $rowP['c'];?></p></p>
				</div>
				<div class="col-4">
					<p>Enrolled courses:  <?php $resD = $conn->query("SELECT COUNT(*) c FROM enrollments WHERE state='1' AND grade<5 AND user_id=$id"); 
										 $rowD=$resD->fetch_assoc(); echo $rowD['c'];?></p>
										 
					<p>Elecctie course with passable grade:  <?php $resEpr = $conn->query("SELECT COUNT(*) c FROM courses JOIN enrollments ON enrollments.user_id='$id'  AND courses.course_id=enrollments.course_id AND courses.type='Elective' AND grade>=5"); 
										 $rowEpr=$resEpr->fetch_assoc(); echo $rowEpr['c'];?></p>
										 
					<p>Elective courses to graduate:  <?php if($rowEpr['c']==0){ echo '1';}else{echo '0';}?></p>
				</div>
				<div class="col-4">
					<p></p>
					<p>Aquired ECTS: <?php $resM = $conn->query("SELECT SUM(courses.ects) c FROM courses JOIN enrollments ON courses.course_id=enrollments.course_id AND enrollments.user_id=$id AND enrollments.grade>=5"); 
										 $rowM=$resM->fetch_assoc(); echo $rowM['c'];?></p>
										 
					<p>ECTS to graduate:  <?php $resMp = $conn->query("SELECT SUM(ects) c FROM courses WHERE course_id NOT IN (SELECT course_id FROM enrollments WHERE user_id='$id' AND grade>=5)"); 
										 $rowMp=$resMp->fetch_assoc(); echo ($rowMp['c']-5);?></p>

				</div>
			</div>
		</div>

	</div>
</div>
<?php 
$conn -> close();
include 'includeFooter.php'; ?>