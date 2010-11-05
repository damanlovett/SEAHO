<p><span class="logincolor"><strong> Hi, <?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></strong> <br />
  (<?php echo login($_SESSION['access']); ?>)</span><br />
  <?php echo date('l, F d, Y');?><br />
  <a href="<?php echo $logoutAction ?>">Log out</a>
