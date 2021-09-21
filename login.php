<?php
session_start();
include 'includeHeader.php';
?>


	<div class="container-fluid mps">
		<div class"row">
			<div class="col-lg-12">
				<h2>Login</h2>
				<p>You can login with your credentials</p>
			</div>
			<!--If the user is logged in he/she gets redirected to the respective page-->
			<?php if(isset($_SESSION['role'])){
				if ($_SESSION['role'] == 'Administration') {
				header('Location: administration.php');
				}
				else if ($_SESSION['role'] == 'Professor'){
					header('Location: professor.php');
				}
				else if ($_SESSION['role'] == 'Student'){
					header('Location: student.php');
				}
			}?>
			<div class="row d-flex justify-content-center">
				<div class="col-lg-5">
					<form action="/loginCheck.php" method="post" >
						<div class="form-group row ">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-5">
								<input type="email" class="form-control" id="email" required name="email">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-5">
								<input type="password" class="form-control" id="password" required name="password">
							</div>
						</div>
						<fieldset class="form-group">
						<div class="form-group row">
						<div class="col-sm-10">
						<button type="submit" class="mybutton">Submit</button>
						</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row d-flex justify-content-center">
				<div class="col-lg-5">
					<p class="alert alert-secondary" role="alert" style="text-align:center">This is a sample school website with a login system. </br>There are three types of users that can login: administration, teachers and students. </br> You can use a demo administrator account with the following credentials</br>email: qwerty@mps.gr </br>password: 12345678</p>
				</div>
			</div>
		</div>
	</div>
<?php include 'includeFooter.php';?>