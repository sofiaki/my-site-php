//Sen course id to courseStudents.php.
function courseId(str) {
  var xhttp;
  if (str == "") {
	document.getElementById("students").innerHTML = "";
	return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	document.getElementById("students").innerHTML = this.responseText;
	}
  };
  xhttp.open("GET", "courseStudents.php?q="+str, true);
  xhttp.send();
}