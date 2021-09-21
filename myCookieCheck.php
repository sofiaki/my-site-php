<?php
$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name]) || !isset($_SESSION["myCookie"]) ) {
	$_SESSION["myCookie"] = 1 ;
    echo "<div class='cookie' id='cookieDiv'>This site uses cookies. By continuing browsing you consent to the use of cookies
    <button class='mybutton' id='cookieBtn' onclick='hideCookieDiv()'>Got it!</button></div>";
	
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script>
    function hideCookieDiv(){
    document.getElementById('cookieDiv').style.display='none';}
</script>