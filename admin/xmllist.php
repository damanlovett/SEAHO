<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="../SpryAssets/xpath.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
var ds1 = new Spry.Data.XMLDataSet("xmltest.php?recordID=C", "export/row");
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="1">
  <tr>
    <td align="left" valign="top"><div spry:region="ds1">
      <table>
        <tr>
          <th spry:sort="first_name">First_name</th>
          <th spry:sort="last_name">Last_name</th>
        </tr>
        <tr spry:repeat="ds1" spry:setrow="ds1">
          <td>{first_name}</td>
          <td>{last_name}</td>
        </tr>
      </table>
    </div></td>
    <td align="left" valign="top"><div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">First Name</div>
    <div class="AccordionPanelContent" spry:detailregion="ds1"><span onClick="MM_openBrWindow('xmltest.php','test','width=200,height=200')">{first_name}</span></div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Last Name</div>
    <div class="AccordionPanelContent" spry:detailregion="ds1">{last_name}</div>
  </div>
</div></td>
  </tr>
</table>
<p>&nbsp;</p>

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">First Name</li>
    <li class="TabbedPanelsTab" tabindex="0">Last Name</li>
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent" spry:detailregion="ds1">{first_name}<br />
      <label>
        <input name="button" type="submit" id="button" onclick="MM_goToURL('parent','xmllist.php?record={ds1::user_id}&amp;row={ds1::ds_CurrentRowID}');return document.MM_returnValue" value="Submit" />
      </label>
    </div>
    <div class="TabbedPanelsContent" spry:detailregion="ds1">{first_name}</div>
  </div>
</div>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
