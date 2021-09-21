<?php
$course_id=$_GET['q'];

//Retrieve enrolled students' data for a course.
require 'connectDB.php';
$qry = "SELECT users.name, users.surname, enrollments.enrollment_id  FROM users JOIN enrollments ON users.user_id=enrollments.user_id AND enrollments.course_id='$course_id' AND enrollments.state='1'";
$result = $conn -> query($qry);
//Students table.
echo '<table class="table table-bordered text-primary w-auto">
						<thead class="thead-light">
							<tr>
								<th scope="col">Surname</th>
								<th scope="col">Name</th>
								<th scope="col">Grade</th>
							</tr>
						</thead>
						<tbody>';
while($row=$result->fetch_assoc()){
	echo '<tr><td>'.$row['surname'].'</td><td>'.$row['name']. 	//Grade selection from dropdown menu.
	'</td><td><select onchange="grade(this.value,'.$row['enrollment_id'].')">  
		<option>Grade</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
	</select></td></tr>'; 
}
echo '</tbody></table>';

$conn -> close();
?>