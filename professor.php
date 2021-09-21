<?php
echo '<meta charset="UTF-8"/>';
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="Professor")
{
    echo '<script type="text/javascript">
		if(!alert("Please login to access page")){ 
			window.location.href = "login.php";
		}
		</script>';
}
include 'includeHeader.php';

$id = $_SESSION['professor_id'];
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
//Retrieve professor data.
require 'connectDB.php';
$qry = "SELECT password, address, phone, birthdate FROM users WHERE user_id = '$id'";
$result = $conn -> query($qry);
$row = $result -> fetch_assoc();
$_SESSION['password'] = $row['password'];
$_SESSION['address'] = $row['address'];
$_SESSION['phone'] = $row['phone'];
$_SESSION['birthdate'] = $row['birthdate'];

//Retrieve professors courses.
$qry2 = "SELECT * FROM courses WHERE user_id= '$id'";
$result2 = $conn -> query($qry2);



unset($row, $result, $qry);

?>
<!--send grades to grades.php-->
<script type="text/javascript" src="script/grade.js"></script>
<!--send course_id to courseStudents.php-->
<script type="text/javascript" src="script/courseId.js"></script>

<!--script to show the same tab after page refresh-->
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
					<form name="formK1" action="/modify.php" method="post" onsubmit="return passwordLengthCheck(this.passwordF.value)">
						<div class="form-group">
							<label for="nameK">Name:</label>
							<input type="text" class="form-control" id="nameK" name="nameK" placeholder="<?php echo $name;?>" disabled>
						</div>
						<div class="form-group">
							<label for="surnameK">Surname:</label>
							<input type="text" class="form-control" id="surnameK" name="surnameK" placeholder="<?php echo $surname;?>" disabled>
						</div>		
						<div class="form-group">
							<label for="emailK">Email:</label>
							<input type="email" class="form-control" id="emailK" name="emailK" placeholder="<?php echo $_SESSION['email'];?>" disabled>
						</div>
				</div>
				<div class="col-4">
						<div class="form-group">
							<label for="passwordK">Password:</label>
							<input type="password" class="form-control" id="passwordK" name="passwordK" placeholder="<?php echo $_SESSION['password'];?>">
						</div>
						<div class="form-group">
							<label for="addressK">Address:</label>
							<input type="text" class="form-control" id="addressK" name="addressK" placeholder="<?php echo $_SESSION['address'];?>">
						</div>
						<div class="form-group">
							<label for="phoneK">Phone number:</label>
							<input type="int" class="form-control" id="phoneK" name="phoneK" placeholder="<?php echo $_SESSION['phone'];?>">
						</div>
						<div class="form-group">
							<label for="gennisiK">Birthdate:</label>
							<input type="text" class="form-control" id="gennisiK" name="gennisiK" placeholder="<?php echo $_SESSION['birthdate'];?>" onfocus="(this.type='date')" onblur="(this.type='text')">
						</div>
						<button name="btnK1" type="submit" class="mybutton">Modify</button>
					</form>
				</div>
			</div>
			
		</div>
		<div id="menu1" class="tab-pane fade">
			<div class="row">
				<div class="col-12">
				<!--Course selection form-->
					<form name="formM" action="/" method="post">
						<select class="form-control" onchange="courseId(this.value)">
							<option id="1">Choose course</option>
						<?php 
							while($row2 = $result2->fetch_assoc()){
								echo '<option value="'.$row2['course_id'].'">'.$row2['title'].'</option>';
							}
						?>
						</select>
					</form>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12" id="students"></div>
			</div>
		</div>

	</div>
</div>
<?php 
$conn -> close();
include 'includeFooter.php'; ?>