<script language="javascript">
function validchars(fldname,sts,msg)
{		
	var fldlen = document.getElementById(fldname).value.length;
	var chksts = sts;
	if(chksts == "genchars")
	{
		var ichars = "!@$#%^&*()+=-[]\\\':,./{}|\":<>?";
	}
	else if(chksts == "mailchars")
	{
		var ichars = "!$#%^&*()+=-[]\\\':,/{}|\":<>?";
	}
	else if(chksts == "sexchars")
	{
		var ichars = "!@$#%^&*()+=-[]\\\':,./{}|\":<>?abcdeghijklnopqrstuvwxyzABCDEGHIJKLNOPQRSTUVWXYZ0123456789";
	}
	for(var i=0;i < document.getElementById(fldname).value.length;i++)
	{
		if(ichars.indexOf(document.getElementById(fldname).value.charAt(i)) != -1)
		{
			alert(msg + " contain invalid characters");
			document.getElementById(fldname).focus();
			return false;
		}	
	}
}
</script>
