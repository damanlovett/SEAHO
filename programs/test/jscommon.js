// JavaScript Document
// ExpandContent for DIV Menus
function expandContent(menuoption) {
var obj = document.getElementById (menuoption)
obj.style.display = 'block';
}
// Collapse Contest for DIV Menus
function collapseContent(menuoption) {
var obj = document.getElementById (menuoption)
obj.style.display = 'none';
}
// Confirm Delete
function confirmDelete(delURL)
{
if (confirm("Are you sure you wish to delete this item?")) {
document.location = delURL;
}
}
// MM Find Object
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

//MM Form Validation
function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//Number Formatting
function FormatNumber(num, format, shortformat)
{
	if(format==null)
	{
			// Choose the default format you prefer for the number. 
		//format = "#-(###) ###-#### ";		// Telephone w/ LD Prefix and Area Code
		//format = "########## ";			// Telephone w/ Area Code
		format = "###-###-####";			// Telephone w/ Area Code (dash seperated)
		//format = "###-##-####";			//Social Security Number
	}					
//---------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
	if(shortformat==null)
	{
		// Choose the short format (without area code) you prefer. 
		//If you do not want multiple formats, leave it as "".

		//var shortformat = "###-#### ";
		var shortformat = "";
	}
	var validchars = "0123456789ext";
	var tempstring = "";
	var returnstring = "";
	var extension = "";
	var tempstringpointer = 0;
	var returnstringpointer = 0;
	count = 0;

	// Get the length so we can go through and remove all non-numeric characters
	var length = num.value.length;
		

	// We are only concerned with the format of the phone number - extensions can be left alone.
	if (length > format.length)
	{
		length = format.length;
	};
	
	// scroll through what the user has typed
	for (var x=0; x<length; x++)
	{
		if (validchars.indexOf(num.value.charAt(x))!=-1)
		{
		tempstring = tempstring + num.value.charAt(x);
		};
	};
	// We should now have just the #'s - extract the extension if needed
	if (num.value.length > format.length)
	{
		length = format.length;
		extension = num.value.substr(format.length, (num.value.length-format.length));
	};
	
	// if we have fewer characters than our short format, we'll default to the short version.
	for (x=0; x<shortformat.length;x++)
	{
		if (shortformat.substr(x, 1)=="#")
		{
			count++;
		};
	}
	if (tempstring.length <= count)
	{
		format = shortformat;
	};

	
	//Loop through the format string and insert the numbers where we find a # sign
	for (x=0; x<format.length;x++)
	{
		if (tempstringpointer <= tempstring.length)
		{
			if (format.substr(x, 1)=="#")
			{
				returnstring = returnstring + tempstring.substr(tempstringpointer, 1);
				tempstringpointer++;
			}else{
				returnstring = returnstring + format.substr(x, 1);
			}
		}
		
	}

	// We have gone through the entire format, let's add the extension back on.
		returnstring = returnstring + extension;
	
	//we're done - let's return our value to the field.
	num.value = returnstring;
}	
