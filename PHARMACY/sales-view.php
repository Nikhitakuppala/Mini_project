<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="table1.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<title>
Sales Invoice
</title>
</head>

<body>
      <div class="topnav">
    		<span class="menu-icon" onclick="toggleSidenav()">&#9776;</span>
    		<span class="brand">PharmaCore</span>
    		<a href="logout.php" class="logout">Logout</a>
  		</div>
		<div class="sidenav">
	
			<a href="adminmainpage.php">Dashboard</a>
			<button class="dropdown-btn">Inventory
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="inventory-add.php">Add New Medicine</a>
				<a href="inventory-view.php">Manage Inventory</a>
			</div>
			<button class="dropdown-btn">Suppliers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="supplier-add.php">Add New Supplier</a>
				<a href="supplier-view.php">Manage Suppliers</a>
			</div>
			<button class="dropdown-btn">Stock Purchase
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Purchase</a>
				<a href="purchase-view.php">Manage Purchases</a>
			</div>
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="employee-add.php">Add New Employee</a>
				<a href="employee-view.php">Manage Employees</a>
			</div>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="customer-add.php">Add New Customer</a>
				<a href="customer-view.php">Manage Customers</a>
			</div>
			<a href="sales-view.php">View Sales Invoice Details</a>
			<a href="salesitems-view.php">View Sold Products Details</a>
			<a href="pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Reports
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="stockreport.php">Medicines - Low Stock</a>
				<a href="expiryreport.php">Medicines - Soon to Expire</a>
				<a href="salesreport.php">Transactions Reports</a>
			</div>
	</div>

	
	
	<div class="page-content">
	<center>
	<div class="head">
	<h2>
	<img src="money.png" alt="Supplier Icon" style="width:50px; vertical-align:middle; margin-right:10px;">
	SALES INVOICE DETAILS</h2>
	</div>
	</center>

	<div >
  <button class="export-btn" onclick="exportTableToPDF()">
    <img src="pdf.png" alt="PDF Icon" class="icon">
    Export PDF
  </button>
</div>
	
	<table align="right" id="table1" style="margin-right:100px;">
		<tr>
			<th>Sale ID</th>
			<th>Customer ID</th>
			<th>Date and Time </th>
			<th>Sale Amount</th>
			<th>Employee ID</th>
		</tr>
		
	<?php
	include "config.php";
	
		$sql = "SELECT sale_id, c_id,s_date,s_time,total_amt,e_id FROM sales";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			
			
		echo "<tr>";
			echo "<td>" . $row["sale_id"]. "</td>";
			echo "<td>" . $row["c_id"] . "</td>";
			echo "<td>" . $row["s_date"]."&nbsp;&nbsp;".$row["s_time"]."</td>";
			echo "<td>" . $row["total_amt"]. "</td>";
			echo "<td>" . $row["e_id"]. "</td>";
		echo "</tr>";
		}
	echo "</table>";
	} 
	$conn->close();
	?>
	</div>
</body>

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
		var i;

			for (i = 0; i < dropdown.length; i++) {
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


		function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

	doc.autoTable({
		html: '#table1',
		styles: {
			fontStyle: 'normal',
			textColor: 20,
		},
		alternateRowStyles: {
			fillColor: [245, 245, 245],
		},
		didParseCell: function (data) {
			if (data.row.index === 0) {
				data.cell.styles.fillColor = [0, 119, 179]; // #0077b3
				data.cell.styles.textColor = 255; // white text
				data.cell.styles.fontStyle = 'bold';
			}
		}
	});

    doc.save('sales_invoice.pdf');
  }
</script>

</html>
