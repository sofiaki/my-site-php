//Pass grade variables to grade.php.
function grade(str1,str2) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.open("GET", "grades.php?q="+str1+"&r="+str2, true);
  xhttp.send();
}