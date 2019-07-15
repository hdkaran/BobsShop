function checkPhone()
	{
		var phone=document.getElementById("tel").value;
		var patt=new RegExp("^[\+\(\)0-9x ]+$");
		var regex=/[^\+\(\)0-9x ]+/g;
		if(patt.test(phone))
		{
			
		}
		else
		{
			var s=phone.replace(regex,"");
			document.getElementById("tel").value=s;
		}
	}
	
	function northAm()
	{
		var phone=document.getElementById("tel").value;
		var patt=/^(\+1|)(( ){0,1})(\({0,1})([2-9]\d{2})(\){0,1})(( ){0,1})([2-9]\d{2})(( ){0,1})(\d{4})( {0,1}| x[0-9]{1,5}|x[0-9]{1,5})$/g;
		
		
		if(patt.test(phone))
		{
			document.getElementById("northAm").style="display:inline;"
		}
		else
		{ 
			document.getElementById("northAm").style="display:none;"
		}
		
		}
	function submitIt()
	{
		if(document.getElementById("remember").checked==true)
		{
			localStorage.name=document.getElementById("Name").value;
			localStorage.email=document.getElementById("Email").value;
			localStorage.add=document.getElementById("textarea").value;
			localStorage.tel=document.getElementById("tel").value;
			
		}
		else
		{
				localStorage.name="";
				localStorage.add="";
				localStorage.email="";
				localStorage.tel="";
		}
		return true;
	}	
function loadIt()
{
	if(localStorage.name!=null || localStorage.add!=null || localStorage.email!=null || localStorage.tel!=null)
	{
	
		document.getElementById("Name").value=localStorage.name;
		
			
			document.getElementById("Email").value=localStorage.email;
			document.getElementById("textarea").value=localStorage.add;
			document.getElementById("tel").value=localStorage.tel;
	}
	else{
		
		}
}