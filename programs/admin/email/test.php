<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script src="../../includefiles/FormManager.js">
/****************************************************
* Form Dependency Manager- By Twey- http://www.twey.co.uk
* Visit Dynamic Drive for this script and more: http://www.dynamicdrive.com
****************************************************/
</script>

<script type="text/javascript">
window.onload = function() {
    setupDependencies('weboptions'); //name of form(s). Seperate each with a comma (ie: 'weboptions', 'myotherform' )
  };
</script>
</head>

<body>
<form action="test.php" name="weboptions">
  <p>
    <label>Committee<input type="radio" name="os" value="committee"></label>
    <label>Presenters<input type="radio" name="os" value="presenters"></label>
    <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;"></label>
    <label></label>
    <label style="margin-bottom: 1em; padding-bottom: 1em; border-bottom: 3px silver groove;"></label>
  </p>
  <p>
    <label>Accepted
    <input name="status" type="checkbox" class="DEPENDS ON os BEING presenters" id="status" value="Accepted" />
    <br />
    </label>
    <label>To Be Review
    <input name="status" type="checkbox" class="DEPENDS ON os BEING presenters" id="status" value="To Be Review">
    <br />
    </label>
    <label>Denied
    <input name="status" type="checkbox" class="DEPENDS ON os BEING presenters" id="status" value="Denied">
    <br />
    </label>
	<label>Committee
    <input name="status" type="checkbox" class="DEPENDS ON os BEING committee" id="status" value="Committee">
    </label>
    <label>
    <br />
    <br />
    <input type="submit" name="Submit" value="Submit" />
    </label>
  </p>
</form>
<?php echo $_REQUEST['status'];?>
<br />
<?php echo $_REQUEST['select2'];?>
</body>
</html>
