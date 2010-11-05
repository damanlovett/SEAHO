<?php require_once("/WA_iRite/WARichEditorPHP.php"); ?>

<div id="email_subject"><label>Subject: <input type="text" name="subject" id="subject"></label></div>
<div id="email_To">
  <label>Send to: <select name="group" id="group">
    <option value="Leadership Team">Leadership Team</option>
    <?php
do {  
?>
    <option value="<?php echo $row_rsCat['group']?>"><?php echo $row_rsCat['group']?></option>
    <?php
} while ($row_rsCat = mysql_fetch_assoc($rsCat));
  $rows = mysql_num_rows($rsCat);
  if($rows > 0) {
      mysql_data_seek($rsCat, 0);
	  $row_rsCat = mysql_fetch_assoc($rsCat);
  }
?>
  </select></label>
</div>
<div id="editor">
  <?php
// WebAssist iRite: Rich Text Editor for Dreamweaver
$WARichTextEditor_1 = CreateRichTextEditor ("content", "/WA_iRite/", "100%", "200px", "Custom", "../custom/emailForm_content1.js", "");
?>
</div>
<div><input type="submit" name="submit" id="submit">
</div>
