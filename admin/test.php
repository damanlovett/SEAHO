<?php require_once('../Connections/SEAHOdocuments.php'); ?>
<?php
// Load the common classes
require_once('../includes/common/KT_common.php');

// Load the tNG classes
require_once('../includes/tng/tNG.inc.php');

// Make a transaction dispatcher instance
$tNGs = new tNG_dispatcher("../");

// Make unified connection variable
$conn_SEAHOdocuments = new KT_connection($SEAHOdocuments, $database_SEAHOdocuments);

// Start trigger
$formValidation = new tNG_FormValidation();
$tNGs->prepareValidation($formValidation);
// End trigger

//start Trigger_ImageUpload trigger
//remove this line if you want to edit the code by hand 
function Trigger_ImageUpload(&$tNG) {
  $uploadObj = new tNG_ImageUpload($tNG);
  $uploadObj->setFormFieldName("name");
  $uploadObj->setDbFieldName("name");
  $uploadObj->setFolder("../upload/");
  $uploadObj->setResize("true", 20, 20);
  $uploadObj->setMaxSize(1500);
  $uploadObj->setAllowedExtensions("gif, jpg, jpe, jpeg, png");
  $uploadObj->setRename("auto");
  return $uploadObj->Execute();
}
//end Trigger_ImageUpload trigger

// Make an insert transaction instance
$ins_upload = new tNG_insert($conn_SEAHOdocuments);
$tNGs->addTransaction($ins_upload);
// Register triggers
$ins_upload->registerTrigger("STARTER", "Trigger_Default_Starter", 1, "POST", "KT_Insert1");
$ins_upload->registerTrigger("BEFORE", "Trigger_Default_FormValidation", 10, $formValidation);
$ins_upload->registerTrigger("AFTER", "Trigger_ImageUpload", 97);
// Add columns
$ins_upload->setTable("upload");
$ins_upload->addColumn("doc_id", "STRING_TYPE", "POST", "doc_id", "1");
$ins_upload->addColumn("title", "STRING_TYPE", "POST", "title");
$ins_upload->addColumn("name", "STRING_TYPE", "POST", "name");
$ins_upload->addColumn("cat_id", "STRING_TYPE", "POST", "cat_id", "1");
$ins_upload->addColumn("categories", "STRING_TYPE", "POST", "categories");
$ins_upload->addColumn("type", "STRING_TYPE", "POST", "type");
$ins_upload->addColumn("size", "NUMERIC_TYPE", "POST", "size");
$ins_upload->addColumn("content", "STRING_TYPE", "POST", "content");
$ins_upload->setPrimaryKey("id", "NUMERIC_TYPE");

// Execute all the registered transactions
$tNGs->executeTransactions();

// Get the transaction recordset
$rsupload = $tNGs->getRecordset("upload");
$row_rsupload = mysql_fetch_assoc($rsupload);
$totalRows_rsupload = mysql_num_rows($rsupload);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../includes/skins/mxkollection3.css" rel="stylesheet" type="text/css" media="all" />
<script src="../includes/common/js/base.js" type="text/javascript"></script>
<script src="../includes/common/js/utility.js" type="text/javascript"></script>
<script src="../includes/skins/style.js" type="text/javascript"></script>
<?php echo $tNGs->displayValidationRules();?>
</head>

<body>
<?php
	echo $tNGs->getErrorMsg();
?>
<form action="<?php echo KT_escapeAttribute(KT_getFullUri()); ?>" method="post" enctype="multipart/form-data" id="form1">
  <table cellpadding="2" cellspacing="0" class="KT_tngtable">
    <tr>
      <td class="KT_th"><label for="title">Title:</label></td>
      <td><input type="text" name="title" id="title" value="<?php echo KT_escapeAttribute($row_rsupload['title']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("title");?> <?php echo $tNGs->displayFieldError("upload", "title"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="name">Name:</label></td>
      <td><input type="file" name="name" id="name" value="<?php echo KT_escapeAttribute($row_rsupload['name']); ?>" size="32" />
        <label></label>
        <?php echo $tNGs->displayFieldHint("name");?> <?php echo $tNGs->displayFieldError("upload", "name"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="categories">Categories:</label></td>
      <td><input type="text" name="categories" id="categories" value="<?php echo KT_escapeAttribute($row_rsupload['categories']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("categories");?> <?php echo $tNGs->displayFieldError("upload", "categories"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="type">Type:</label></td>
      <td><input type="text" name="type" id="type" value="<?php echo KT_escapeAttribute($row_rsupload['type']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("type");?> <?php echo $tNGs->displayFieldError("upload", "type"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="size">Size:</label></td>
      <td><input type="text" name="size" id="size" value="<?php echo KT_escapeAttribute($row_rsupload['size']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("size");?> <?php echo $tNGs->displayFieldError("upload", "size"); ?> </td>
    </tr>
    <tr>
      <td class="KT_th"><label for="content">Content:</label></td>
      <td><input type="text" name="content" id="content" value="<?php echo KT_escapeAttribute($row_rsupload['content']); ?>" size="32" />
          <?php echo $tNGs->displayFieldHint("content");?> <?php echo $tNGs->displayFieldError("upload", "content"); ?> </td>
    </tr>
    <tr class="KT_buttons">
      <td colspan="2"><input type="submit" name="KT_Insert1" id="KT_Insert1" value="Insert record" />      </td>
    </tr>
  </table>
  <input type="hidden" name="doc_id" id="doc_id" value="<?php echo KT_escapeAttribute($row_rsupload['doc_id']); ?>" />
  <input type="hidden" name="cat_id" id="cat_id" value="<?php echo KT_escapeAttribute($row_rsupload['cat_id']); ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
