<?php require_once('../Connections/Directory.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_Directory = new KT_connection($Directory, $database_Directory);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("Filedata");
  $uploadObj->setDbFieldName("email");
  $uploadObj->setFolder("../upload/");
  $uploadObj->setResize("true", 200, 200);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

//start Trigger_Redirect trigger
//remove this line if you want to edit the code by hand
function Trigger_Redirect(&$tNG) {
  $redObj = new tNG_Redirect($tNG);
  $redObj->setURL(KT_getFullUri());
  $redObj->setKeepURLParams(false);
  return $redObj->Execute();
}
//end Trigger_Redirect trigger

// Make an insert transaction instance
$ins_staff = new tNG_insert($conn_Directory);
$tNGs->addTransaction($ins_staff);
// Register triggers
$ins_staff->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_staff->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_staff->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "FILES", "Filedata");
$ins_staff->registerConditionalTrigger("{GET.isFlash} != 1", "END", "Trigger_Redirect", 90);
$ins_staff->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
$ins_staff->registerConditionalTrigger("{GET.isFlash} == 1", "ERROR", "Trigger_Default_MUploadError", 10);
// Add columns
$ins_staff->setTable("staff");
$ins_staff->addColumn("type", "STRING_TYPE", "VALUE", "");
$ins_staff->addColumn("email", "FILE_TYPE", "FILES", "Filedata");
$ins_staff->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsstaff = $tNGs->getRecordset("staff");
$row_rsstaff = mysql_fetch_assoc($rsstaff);
$totalRows_rsstaff = mysql_num_rows($rsstaff);

// Multiple Upload Helper Object
$muploadHelper = new tNG_MuploadHelper("../", 32);
$muploadHelper->setMaxSize(1500);
$muploadHelper->setMaxNumber(0);
$muploadHelper->setExistentNumber(0);
$muploadHelper->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?><?php echo $muploadHelper->getScripts(); ?>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<?php
// Multiple Upload Helper
echo $tNGs->getSavedErrorMsg();
echo $muploadHelper->Execute();
?>
</body>
</html>
