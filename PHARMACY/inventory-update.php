<?php
	include "config.php";

	// ✅ Handle form submission BEFORE any HTML is sent
	if (isset($_POST['medname']) || isset($_POST['qty']) || isset($_POST['cat']) || isset($_POST['sp']) || isset($_POST['loc'])) {
		$id = $_POST['medid'];
		$name = $_POST['medname'];
		$qty = $_POST['qty'];
		$cat = $_POST['cat'];
		$price = $_POST['sp'];
		$lcn = $_POST['loc'];

		$sql = "UPDATE meds SET med_name='$name', med_qty='$qty', category='$cat', med_price='$price', location_rack='$lcn' WHERE med_id='$id'";
		if ($conn->query($sql)) {
			header("Location: inventory-view.php");
			exit(); // ✅ Ensure no further output happens
		} else {
			$error = "Error! Unable to update.";
		}
	}

	// Fetch medicine data to populate form
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$qry1 = "SELECT * FROM meds WHERE med_id='$id'";
		$result = $conn->query($qry1);
		$row = $result->fetch_row();
	}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="form4.css">
<title>Medicines</title>
</head>

<body>
<div class="topnav">
	<span class="menu-icon" onclick="toggleSidenav()">&#9776;</span>
	<span class="brand">PharmaCore</span>
	<a href="logout.php" class="logout">Logout</a>
</div>

<div class="sidenav">
	<a href="adminmainpage.php">Dashboard</a>
	<button class="dropdown-btn">Inventory<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="inventory-add.php">Add New Medicine</a>
		<a href="inventory-view.php">Manage Inventory</a>
	</div>
	<button class="dropdown-btn">Suppliers<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="supplier-add.php">Add New Supplier</a>
		<a href="supplier-view.php">Manage Suppliers</a>
	</div>
	<button class="dropdown-btn">Stock Purchase<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="purchase-add.php">Add New Purchase</a>
		<a href="purchase-view.php">Manage Purchases</a>
	</div>
	<button class="dropdown-btn">Employees<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="employee-add.php">Add New Employee</a>
		<a href="employee-view.php">Manage Employees</a>
	</div>
	<button class="dropdown-btn">Customers<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="customer-add.php">Add New Customer</a>
		<a href="customer-view.php">Manage Customers</a>
	</div>
	<a href="sales-view.php">View Sales Invoice Details</a>
	<a href="salesitems-view.php">View Sold Products Details</a>
	<a href="pos1.php">Add New Sale</a>
	<button class="dropdown-btn">Reports<i class="down"></i></button>
	<div class="dropdown-container">
		<a href="stockreport.php">Medicines - Low Stock</a>
		<a href="expiryreport.php">Medicines - Soon to Expire</a>
		<a href="salesreport.php">Transactions Reports</a>
	</div>
</div>

<div class="page-content">
	<center>
		<div class="head">
			<h2>UPDATE MEDICINE DETAILS</h2>
		</div>
	</center>

	<br><br><br><br><br><br><br>
	<div class="one">
		<div class="row">
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
				<div class="column">
					<p>
						<label for="medid">Medicine ID:</label><br>
						<input type="number" name="medid" value="<?= $row[0]; ?>" readonly>
					</p>
					<p>
						<label for="medname">Medicine Name:</label><br>
						<input type="text" name="medname" value="<?= $row[1]; ?>">
					</p>
					<p>
						<label for="qty">Quantity:</label><br>
						<input type="number" name="qty" value="<?= $row[2]; ?>">
					</p>
					<p>
						<label for="cat">Category:</label><br>
						<input type="text" name="cat" value="<?= $row[3]; ?>">
					</p>
				</div>
				
				<div class="column">
					<p>
						<label for="sp">Price: </label><br>
						<input type="number" step="0.01" name="sp" value="<?= $row[4]; ?>">
					</p>
					<p>
						<label for="loc">Location:</label><br>
						<input type="text" name="loc" value="<?= $row[5]; ?>">
					</p>
				</div>

				<input type="submit" name="update" value="Update">

				<?php
					if (isset($error)) {
						echo "<p style='font-size:14px;color:red;'>$error</p>";
					}
				?>
			</form>
		</div>
	</div>
</div>

<script>
	function toggleSidenav() {
		var sidenav = document.querySelector(".sidenav");
		var pageContent = document.querySelector(".page-content");

		if (sidenav.style.display === "block") {
			sidenav.style.display = "none";
			pageContent.style.marginLeft = "0";
		} else {
			sidenav.style.display = "block";
			pageContent.style.marginLeft = "220px";
		}
	}

	var dropdown = document.getElementsByClassName("dropdown-btn");
	for (var i = 0; i < dropdown.length; i++) {
		dropdown[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var dropdownContent = this.nextElementSibling;
			if (dropdownContent.style.display === "block") {
				dropdownContent.style.display = "none";
			} else {
				dropdownContent.style.display = "block";
			}
		});
	}
</script>

</body>
</html>
