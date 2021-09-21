//Send the id of the table row that is selected from the student table on progress tab on administration.php,
//to studentProgress.php .
function progress(str) {
  var xhttp;
  if (str == "") {
	document.getElementById("progressTable").innerHTML = "";
	return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	document.getElementById("progressTable").innerHTML = this.responseText;
	}
  };
  xhttp.open("GET", "studentProgress.php?q="+str, true);
  xhttp.send();
}
