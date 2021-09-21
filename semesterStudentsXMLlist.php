<?php
echo '<meta charset="UTF-8"/>';
session_start();
if (!isset($_SESSION['role']) OR $_SESSION['role']!="Administration")
{
    echo '<script type="text/javascript">
		if(!alert("PLease login to access page")){ 
			window.location.href = "login.php";
		}
		</script>';
}
include 'includeHeader.php';
?>

<div class='container h-75'>

<?php
//Variable of semester sent from administration.php.
$semester = $_GET['semester'];

//Hide errors.
error_reporting(0);

//Retrieve student data for given semester.
require 'connectDB.php';
$sql = "SELECT users.user_id, users.name, users.surname, users.user_id, 
			COUNT(enrollments.grade) AS ar_mathimaton, AVG(enrollments.grade) AS avg
			FROM users 
			INNER JOIN semester ON role='Student' AND semester.sem_no=$semester AND users.user_id=semester.user_id
			JOIN enrollments ON users.user_id=enrollments.user_id AND enrollments.grade>'4'
			JOIN courses ON courses.course_id=enrollments.course_id AND courses.course_semester=$semester 
			GROUP BY users.surname
			ORDER BY users.surname ASC" ;
$result = $conn->query($sql);

//Query for two students with the highest grades.
$sql2 = "SELECT users.user_id, users.name, users.surname, users.user_id, 
			COUNT(enrollments.grade) AS ar_mathimaton, AVG(enrollments.grade) AS avg
			FROM users 
			INNER JOIN semester ON role='Student' AND semester.sem_no=$semester AND users.user_id=semester.user_id
			JOIN enrollments ON users.user_id=enrollments.user_id AND enrollments.grade>'4'
			JOIN courses ON courses.course_id=enrollments.course_id AND courses.course_semester=$semester 
			GROUP BY users.surname
			ORDER BY avg DESC
			LIMIT 2" ;
			
$result2 = $conn->query($sql2);

//XML creation.
$imp = new DOMImplementation;
$dtd = $imp->createDocumentType('semesterStudents','','semesterStudents.dtd');
$xml = $imp->createDocument("","",$dtd);
$xml->encoding = 'UTF-8';
$xml->formatOutput = true;

//Root elemnt creation.
$students = $xml->createElement("semesterStudents");
$xml->appendChild($students);

//Student list.
while ($row = $result->fetch_assoc()) {
	
	$idf = $row['user_id'];
	$name = $row['name'];
	$surname = $row['surname'];
	$courses = $row['ar_mathimaton'];
	$avg = $row['avg'];
	// Child element creation for root element 'students'.
	$student = $xml->createElement("student");
	$student->setAttribute("id", $idf);
	$students->appendChild($student);
	
	// Child elements creation for 'student'.
	$nameXML = $xml->createElement("name",$name);
	$student->appendChild($nameXML);
	
	$surnameXML = $xml->createElement("surname",$surname);
	$student->appendChild($surnameXML);
	
	$coursesXML = $xml->createElement("courses",$courses);
	$student->appendChild($coursesXML);
	
	$avgXML = $xml->createElement("average",$avg);
	$student->appendChild($avgXML);
	
	
}	

//Top 2 students.
while ($row2 = $result2->fetch_assoc()) {
	$idT = $row2['user_id'];
	$nameT = $row2['name'];
	$surnameT = $row2['surname'];
	
	// Child element for 'students'.
	$top2 = $xml->createElement("top2");
	$top2->setAttribute("idT", $idT);
	$students->appendChild($top2);
	
	// Child element for top2.
	$nameTop2 = $xml->createElement("nameTop2",$nameT);
	$top2->appendChild($nameTop2);
	
	$surnameTop2 = $xml->createElement("surnameTop2",$surnameT);
	$top2->appendChild($surnameTop2);
	
}
//Save XML file.
$xml->saveXML();
$xml->save($semester."semesterStudents.xml");


// Load XML file to create xsl.
$xml_filename = $semester."semesterStudents.xml";
$xsl_filename  = "semesterStudents.xsl";

$xml = new DOMDocument();
$xml->load($xml_filename);

$xsl = new DOMDocument();
$xsl->load($xsl_filename);

if (!$xml->validate()) {
	
	echo "<p>The XML file is not DTD valid</p>";
	
} else {
	echo '<div class="row m-4">
			<h3> Students of '.$semester.'semester  </h3><br/>
		</div>';
	$proc = new XSLTProcessor();
	$proc->importStyleSheet($xsl);
	echo $proc->transformToXML($xml);
}
//Return to administration page.
echo '<div class="row m-2">
		<a class="mybutton" href="./administration.php#menu2">Return</a>
		</div>';

?>

</div>
<?php include 'includeFooter.php'; ?> 