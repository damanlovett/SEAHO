<?php

mysql_select_db($database_Directory, $Directory);
$query_rsOnline = "SELECT id, user_id, ip_address FROM online_report GROUP BY user_id";
$rsOnline = mysql_query($query_rsOnline, $Directory) or die(mysql_error());
$row_rsOnline = mysql_fetch_assoc($rsOnline);
$totalRows_rsOnline = mysql_num_rows($rsOnline);

?>
<style type="text/css">
<!--
.logincolor {color: #000099}
-->
</style>
<p><span class="logincolor"><strong> Hi, <?php echo $_SESSION['display_name']; ?></strong> (<?php echo $accessDisplay; ?>)</span> | <?php // Show all users online
//if ($user==1) {echo"$user user online!</font>";} else {echo"$user users online.";}?> | <?php echo date('l, F d, Y');?> | <a href="<?php echo $logoutAction ?>">Log out</a>
 |
   <?php
mysql_free_result($rsOnline);
?>
