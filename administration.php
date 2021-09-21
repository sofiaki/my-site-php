<?php
echo '<meta charset="UTF-8"/>';
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="Administration")
{
    echo '<script type="text/javascript">
		if(!alert("Please login to access the page")){ 
			window.location.href = "login.php";
		}
		</script>';
}
include 'includeHeader.php';


?>



<!--Javascript email validation. -->
<script type="text/javascript" src="script/validateEmails.js"></script>



<!--Student progress -->
<script type="text/javascript" src="script/progress.js"></script>

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
		<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#home">Register/Modify user account</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu1">Course management</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#menu2">Student progress</a>
			</li>
		</ul>

	  <!-- Tab to register new user or modify existing account -->
		<div class="tab-content">
			<div id="home" class="container tab-pane  active"><br>
				<div class="row">
					<div class="col-4">
					<!--Register form-->
					<h3>Register user</h3>
					<form name="formR" action="registry.php" method="post"  required onsubmit="return passwordLengthCheck(this.passwordR.value)">
					
						<div class="form-group">
							<label for="nameR">Name:</label>
							<input type="text" class="form-control" id="nameR" name="nameR" required>
						</div>
						<div class="form-group">
							<label for="surnameR">Surname:</label>
							<input type="text" class="form-control" id="surnameR" name="surnameR" required>
						</div>		
						<div class="form-group">
							<label for="emailR">Email:</label>
							<input type="text" class="form-control" id="emailR" name="emailR" required>
						</div>
						<div class="form-group">
							<label for="passwordR">Password:</label>
							<input type="password" class="form-control" id="passwordR" name="passwordR" required>
						</div>
						<div class="form-group">
							<label for="roleR">Role:</label>
							<select class="form-control" id="roleR" name="roleR" value="roleR" required>
									<option value='Student'>Student</option>
									<option value='Professor'>Professor</option>
									<option value='Administration'>Administration</option>
								</select>
						</div>
						
						<!--If role student is not chosen then the semester input is disabled-->
						<script>
						$('#roleR').change(function() {
							if( $(this).val() == 'Student') {
								$('#semesterR').prop( "disabled", false );
							} else {       
								$('#semesterR').prop( "disabled", true );
							}
						});
						</script>
						<div class="form-group">
							<label for="semesterR">Semester:</label>
							<input type="text" class="form-control" id="semesterR" name="semesterR" >
						</div>
						<button name="btnR" type="submit" class="mybutton" onclick="return validateEmail(document.formR.emailr)">Submit</button>
					</form>
					</div>
					<div class="col-4">
						<h3>Modify/Delete account</h3>
						
						<!--Form to retrieve account to be modified-->
						<p>Enter the email of the account you want to modify</p>
						<form name="formRv" action="/retrieve.php" method="post">
							<div class="form-group">
								<label for="emailRv">Email:</label>
								<input type="text" class="form-control" id="emailRv" name="emailRv">
							</div>
							<button name="btnRv" type="submit" class="mybutton">Search</button>
						</form>
						<div>
							<!--Show retrieved data-->
							<?php
							if (isset($_SESSION['nameRv'])){
								echo 'Account data : </br>'.'Name : '.$_SESSION['nameRv'].'</br>'.'Surname : '.$_SESSION['surnameRv'].'</br>'.'Email : '.$_SESSION['emailRv'].'</br>'.'Password : '.$_SESSION['passwordRv'].'</br>'.'Role : '.$_SESSION['roleRv'].'</br>'.'Semester : '.$_SESSION['semesterRv'].'</br>Do you want to delete this account? <form action="/delete.php" method="post"><button type="submit" class="mybutton" name="btnD1">Delete</button></form>';					}				
							?>
						</div>
					</div>
					<div class="col-4">
					
						<!--Form to modify account-->
						<form name="formM1" action="/modify.php" method="post" onsubmit="return passwordLengthCheck(this.passwordM.value)">
							<div class="form-group">
								<label for="nameM">Name:</label>
								<input type="text" class="form-control" id="nameM" name="nameM">
							</div>
							<div class="form-group">
								<label for="surnameM">Surname:</label>
								<input type="text" class="form-control" id="surnameM" name="surnameM">
							</div>		
							<div class="form-group">
								<label for="emailM">Email:</label>
								<input type="text" class="form-control" id="emailM" name="emailM">
							</div>
							<div class="form-group">
								<label for="passwordM">Password:</label>
								<input type="password" class="form-control" id="passwordM" name="passwordM">
							</div>
							<div class="form-group">
								<label for="roleM">Role:</label>
								<select class="form-control" id="roleM" name="roleM" value="roleM">
									<option value='Student'>Student</option>
									<option value='Professor'>Professor</option>
									<option value='Administration'>Administration</option>
								</select>
							</div>
							<button name="btnM1" type="submit" class="mybutton" onclick="return validateEmail(document.formT1.emailM)">Modify</button>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Course managemnet tab-->
			<div id="menu1" name="menu1" class="container tab-pane fade"><br>
				<div class="row">
					<div class="col-4">
						<h3>Course management</h3>
					<!--Course management form-->
					<form name="formE2" action="/registry.php" method="post">
						<div class="form-group">
							<label for="proSurnameR">Professor Surname:</label>
							<input type="text" class="form-control" id="proSurnameR" name="proSurnameR">
						</div>	
						<div class="form-group">
							<label for="proNameR">Professor Name:</label>
							<input type="text" class="form-control" id="proNameR" name="proNameR">
						</div>	
						<div class="form-group">
							<label for="titleR">Title:</label>
							<input type="text" class="form-control" id="titleR" name="titleR">
						</div>
							
						<div class="form-group">
							<label for="courseSemR">Semester:</label>
							<input type="text" class="form-control" id="courseSemR" name="courseSemR">
						</div>
						<div class="form-group">
							<label for="typeR">Type:</label>
							<input type="text" class="form-control" id="typeR" name="typeR">
						</div>
						<div class="form-group">
							<label for="ectsR">ECTS:</label>
							<input type="text" class="form-control" id="ectsR" name="ectsR">
						</div>
						<button name="btnR2" type="submit" class="mybutton">Submit</button>
					</form>
					</div>
					<div class="col-4">
						<h3>Modify/Delete course</h3>
						
						<!--Form to retrieve course data-->
						<p>Enter the title of the course you want to modify</p>
						<form name="formRv2" action="/retrieve.php" method="post">
							<div class="form-group">
								<label for="titleRv">Title:</label>
								<input type="text" class="form-control" id="titleRv" name="titleRv">
							</div>
							<button type="submit" name="btnRv2"class="mybutton">Search</button>
						</form>
						<div>
							<!--Display course details-->
							<?php
							if (isset($_SESSION['courseTitle'])){
								echo 'Course details : </br>'.'Professor : '.$_SESSION['nameDA'].' '.$_SESSION['surnameDA'].'</br>'.'Title : '.$_SESSION['courseTitle'].'</br>'.'Type : '.$_SESSION['typeA'].'</br>'.'Semester : '.$_SESSION['semesterMA'].'</br>'.'ECTS : '.$_SESSION['ectsA'].'</br>Do you want to delete this course? <form action="/delete.php" method="post"><button type="submit" class="mybutton" name="btnD2">Delete</button></form>' ;					}
							?>
						</div>
					</div>
					
					<div class="col-4">					
						<!--Form to modify course-->
						<form name="formM2" action="/modify.php" method="post">
							<div class="form-group">
								<label for="proNameM">Professor Name:</label>
								<input type="text" class="form-control" id="proNameM" name="proNameM">
							</div>	
							<div class="form-group">
								<label for="proSurnameM">Professor Surname:</label>
								<input type="text" class="form-control" id="proSurnameM" name="proSurnameM">
							</div>	
							<div class="form-group">
								<label for="titleM">Title:</label>
								<input type="text" class="form-control" id="titleM" name="titleM">
							</div>
								
							<div class="form-group">
								<label for="courseSemM">Semester:</label>
								<input type="text" class="form-control" id="courseSemM" name="courseSemM">
							</div>
							<div class="form-group">
								<label for="typeM">Type:</label>
								<input type="text" class="form-control" id="typeM" name="typeM">
							</div>
							<div class="form-group">
								<label for="ectsM">ECTS:</label>
								<input type="text" class="form-control" id="ectsM" name="ectsM">
							</div>
							<button type="submit" name="btnM2" class="mybutton">Modify</button>
						</form>
					</div>
				</div>
			</div>
			
			<!--Student progress tab-->
			<div id="menu2" class="container tab-pane fade"><br>
				<div class="row">
					<div class="col-12">
						<h3>Student progress</h3>
						<p>Select semester to view students' progress per semester</p>
						<form class="form-inline" action="/administration.php#menu2" method="get">
						<div class="form-group">
							<label for="semesterS">Semester: </label>
							<select class="form-control m-2 mr-sm-2" id="semesterS" name="semesterS">
								<option value="Select semester">Select semester</option>
								<option value='1'>1</option>
								<option value='2'>2</option>
								<option value='3'>3</option>
							</select>
						 </div>
						 <button type="submit" name="submit" class="btn btn-primary m-2">Submit</button>
						 </form>
					 </div>
				</div>
				<div class="row">
					<div class="col-6">
					<!--Student table per Semester-->						
						<?php
						if(isset($_GET['submit'])){
							$selected = $_GET['semesterS'];
							if($selected != "Select semester"){
								require 'connectDB.php';
								$sql = "SELECT users.name, users.surname, users.user_id FROM users INNER JOIN semester WHERE role='Student' AND semester.sem_no='$selected' AND users.user_id=semester.user_id";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									//The form send the semester number to semesterStudentsXMLlist.php.
									echo '
									<form class="form-inline" action="/semesterStudentsXMLlist.php" method="get">
										<label class="form-control" for="semester">Semester:</label>
										<input  type="text" class="form-control m-2 mr-sm-2" readonly id="semester" name="semester" value="'.$selected.'">
										<button type="submit" class="btn btn-light m-2">Export XML</button>
									</form>
									</br><table class="table table-bordered text-primary w-auto">
									<tr>
										<th>Surname </th>
										<th>Name</th>
									</tr>';
									while($row = $result->fetch_assoc()) {
									echo '<tr class="idxristi" id='. $row['user_id'] .' <--!onclick="progress(this.id)-->"><td>' . $row['surname']. '</td><td>' . $row["name"] . '</td></tr>';
									
								}
								
								echo '</table>';
								?><script>
								$( "tr" ).click(function(){
								alert (this.id);
								var request = $.ajax({
								  url: "studentProgress.php",
								  method: "GET",
								  data: { q : this.id },
								  dataType: "html"
								});
								 
								request.done(function( msg ) {
								  $( "#progressTable" ).html( msg );
								});
								});
								</script>
								<?php
								} else { echo 'There are no students on this semester.'; }								
								$conn->close();
							}
						}
						?>									
					</div>
					<div class="col-6">					
						<div id="progressTable"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
 

<?php include 'includeFooter.php'; ?>