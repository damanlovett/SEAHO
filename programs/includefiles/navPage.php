<div class="navbar">
<?php if(($_SESSION['access']==1) OR ($_SESSION['access']==2)){?>
<!-- *********************************Start Menu****************************** -->
<div class="mainDiv" >
<div class="topItem" >Administration</div>        
<div class="dropMenu" ><!-- -->
	<div class="subMenu">
		<div class="subItem">&raquo; <a href="/programs/admin/index.php">Home Page</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/users/index.php">User Management</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/users/logins.php">User Login Info</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/reviewers/index.php"> Reviewers</a></div>
	    <div class="subItem">&raquo; <a href="/programs/admin/listingsAdmin/index.php"> Listings</a></div>
	    <div class="subItem">&raquo; <a href="/programs/admin/listingsAdmin/reviewlist.php"> Votes</a></div>
	    <div class="subItem">&raquo; <a href="/programs/admin/listingsAdmin/assignments.php"> Assignments </a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/rooms/index.php">Room Assignments</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/email/index.php">System Emails</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/table/index.php">Form Tables</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/listingsAdmin/new.php">Add Programs</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/reports/index.php">Report</a></div>
	</div>
</div>
</div>
<!-- *********************************End Menu****************************** -->
<br />
<?php }?>
<!-- *********************************Start Menu****************************** -->
<div class="mainDiv" >
<div class="topItem" ><?php echo $_SESSION['first_name'];?>'s Account</div>        
<div class="dropMenu" ><!-- -->
	<div class="subMenu">
		<div class="subItem">&raquo; <a href="/programs/admin/index.php">Home Page</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/myprograms/index.php">Review Programs</a></div>
	    <div class="subItem">&raquo; <a href="/programs/admin/listings/index.php">All Programs</a></div>
	    <div class="subItem">&raquo; <a href="/programs/admin/listings/accepted.php">Accepted Programs</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/account/index.php">My Account</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/reports/index.php">Reports</a></div>
		<div class="subItem">&raquo; <a href="/programs/admin/lccm/index.php">About LCCM</a></div>
	</div>
</div>
</div>
<!-- *********************************End Menu****************************** -->
<br />
<script type="text/javascript" src="/includefiles/xpmenuv21.js"></script>
</div>