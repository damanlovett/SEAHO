<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>document root</td>
    <td><?php echo $_SERVER['DOCUMENT_ROOT'];?></td>
  </tr>
  <tr>
    <td>php self</td>
    <td><?php echo $_SERVER['PHP_SELF'];?></td>
  </tr>
  <tr>
    <td>query string</td>
    <td><?php echo $_SERVER['QUERY_STRING'];?></td>
  </tr>
  <tr>
    <td>script filename</td>
    <td><?php echo $_SERVER['SCRIPT_FILENAME'];?></td>
  </tr>
  <tr>
    <td>request uri</td>
    <td><?php echo $_SERVER['REQUEST_URI'];?></td>
  </tr>
  <tr>
    <td>gateway</td>
    <td><?php echo $_SERVER['GATEWAY_INTERFACE'];?></td>
  </tr>
  <tr>
    <td>Name</td>
    <td><?php echo $_SERVER['SCRIPT_NAME'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
