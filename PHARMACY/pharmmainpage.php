<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="table1.css">
<link rel="stylesheet" type="text/css" href="nav2.css">
<title>
Pharmacist Dashboard
</title>
</head>


<body>
	<div class="topnav">
    	<span class="menu-icon" onclick="toggleSidenav()">&#9776;</span>
    	<span class="brand">PharmaCore</span>
    	<a href="logout.php" class="logout">Logout</a>
  	</div>

	<div class="sidenav">
			<a href="pharmmainpage.php">Dashboard</a>
			
			<a href="pharm-inventory.php">View Inventory</a>
			<a href="pharm-pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="pharm-customer.php">Add New Customer</a>
				<a href="pharm-customer-view.php">View Customers</a>
			</div>
	</div>
	
	<?php
	
	include "config.php";
	session_start();
	
	$sql="SELECT E_FNAME from EMPLOYEE WHERE E_ID='$_SESSION[user]'";
	$result=$conn->query($sql);
	$row=$result->fetch_row();
	
	$ename=$row[0];
		
	?>

	
	
	<div class="main-content">
    <div class="dashboard-header">
  <video autoplay muted loop playsinline class="dashboard-video">
    <source src="vid.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="dashboard-overlay-text">
    <h1>Welcome to the Pharmacist Dashboard</h1>
    <p>Manage inventory, employees, sales, reports, and more in one place.</p>
  </div>
</div>

    <div class="dashboard-icons">
	
	<a href="pharm-pos1.php" title="Add New Sale">
	<img src="carticon1.png"  alt="Add New Sale">
	</a>
	
	<a href="pharm-inventory.php" title="View Inventory">
	<img src="inventory.png"  alt="Inventory">
	</a>
	</div>
  </div>

</body>

<script>
	function toggleSidenav() {
  const sidenav = document.querySelector('.sidenav');
  const mainContent = document.querySelector('.main-content');
  const dashboardHeader = document.querySelector('.dashboard-header');
  const dashboardIcons = document.querySelector('.dashboard-icons');

  sidenav.style.display = (sidenav.style.display === 'block') ? 'none' : 'block';

  if (sidenav.style.display === 'block') {
    mainContent.style.marginLeft = '110px';
    dashboardHeader.style.marginLeft = '110px';
	dashboardIcons.style.marginLeft = '220px';
  } else {
    mainContent.style.marginLeft = '0';
    dashboardHeader.style.marginLeft = '0';
	dashboardIcons.style.marginLeft = '0';
  }
}


	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

		for (i = 0; i < dropdown.length; i++) {
		  dropdown[i].addEventListener("click", function() {
		  this.classList.toggle("active");
		  var dropdownContent = this.nextElementSibling;
		  if (dropdownContent.style.display === "block") {
		  dropdownContent.style.display = "none";
		  } 
		  else {
		  dropdownContent.style.display = "block";
		  }
		});
	}
	
</script>

</html>