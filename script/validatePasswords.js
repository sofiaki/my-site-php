//Password length check.
function passwordLengthCheck(pass) 
{
if(pass.length>0 && pass.length<8) 
{ 
alert('Password must contain at least 8 characters.')
return false;
}
}