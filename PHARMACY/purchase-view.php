<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="table1.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<title>
Purchases
</title>
</head>

<body>
        <div class="topnav">
    	<span class="menu-icon" onclick="toggleSidenav()">&#9776;</span>
    	<span class="brand">PharmaCore</span>
    	<a href="logout.php" class="logout">Logout</a>
  	    </div>

		<div class="sidenav">
			<!--<h2 style="font-family:Arial; color:white; text-align:center;"> PHARMACIA </h2> -->
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
	<h2> STOCK PURCHASE LIST</h2>
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
			<th>Purchase ID</th>
			<th>Supplier ID</th>
			<th>Medicine ID</th>
			<th>Medicine Name</th>
			<th>Quantity</th>
			<th>Cost of Purchase</th>
			<th>Date of Purchase</th>
			<th>Manufacturing Date</th>
			<th>Expiry Date</th>
			<th>Action</th>
		</tr>
		
	<?php

	include "config.php";
	$sql = "SELECT p_id,sup_id,med_id,p_qty,p_cost,pur_date,mfg_date,exp_date FROM purchase";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	
	while($row = $result->fetch_assoc()) {
		
		$sql1="SELECT med_name from meds where med_id=".$row["med_id"]."";
		$result1 = $conn->query($sql1);
		
		while($row1 = $result1->fetch_assoc()) {

			echo "<tr>";
				echo "<td>" . $row["p_id"]. "</td>";
				echo "<td>" . $row["sup_id"]. "</td>";
				echo "<td>" . $row["med_id"]. "</td>";
				echo "<td>" . $row1["med_name"] . "</td>";
				echo "<td>" . $row["p_qty"]. "</td>";
				echo "<td>" . $row["p_cost"]. "</td>";
				echo "<td>" . $row["pur_date"]. "</td>";
				echo "<td>" . $row["mfg_date"] . "</td>";
				echo "<td>" . $row["exp_date"]. "</td>";
				echo "<td align=center>";		 
				echo "<a class='button1 edit-btn' href=purchase-update.php?pid=".$row['p_id']."&sid=".$row['sup_id']."&mid=".$row['med_id'].">Edit</a>";
				echo "<a class='button1 del-btn' href=purchase-delete.php?pid=".$row['p_id']."&sid=".$row['sup_id']."&mid=".$row['med_id'].">Delete</a>";
				echo "</td>";
			echo "</tr>";
		}
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

    doc.save('stock_purchase_list.pdf');
  }
			
</script>

</html>
