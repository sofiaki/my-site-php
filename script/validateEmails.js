//Email validity check.
function validateEmail(inputText)
{
	var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	if(inputText.value.match(mailformat) || (inputText.value.length==0))
	{
		return true;
	}
	else
	{
		alert("The email you entered is not valid.");
		return false;
	}
}