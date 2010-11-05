<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font: bold;
}
-->
</style>
<fieldset>
      <legend>CMS Links</legend>
      <div align="left">Hi, <?php echo $_SESSION['display_name'];?>
        <a href="/registration/delegate/home.php?doLogout=true">Log out</a>      </div>
      <hr />
      <a href="/registration/delegate/home.php">CMS Home Page</a>
      <a href="/registration/delegate/registrations/index.php">My Registrations</a>
      <a href="/registration/delegate/conference/index.php">Current Conferences</a>
      <a href="/registration/delegate/account/index.php">Account Information</a>
<?php /*?>      <a href="/registration/messageboard/index.php">Message Board <span class="style1">NEW</span></a><?php */?>
      <a href="/registration/delegate/aboutcm/index.php">About CMS</a>
</fieldset>
