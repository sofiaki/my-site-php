//Pass course and student id to enrollment.php.
function enrollment(str1,str2) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      location.reload();
    }
  };
  xhttp.open("GET", "eggrafi.php?q="+str1+"&r="+str2, true);
  xhttp.send();
  
}