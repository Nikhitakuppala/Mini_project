 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pharmacore</title>
  <link rel="stylesheet" type="text/css" href="login1.css">
</head>
<body>
  <!-- Blurred Background Overlay -->
  <div class="background-blur"></div>

  <!-- Page Header -->
  <div class="header">
	
    <h1>PharmaCore</h1>
    <p>Pharmacy Management System</p>
  </div>

  <!-- Login Section -->
  <div class="login-box">
    <!-- Left side: Login Form -->
    <div class="form-section">
      <h2>Admin Login</h2>
      <form method="post" action="">
        <input type="text" class="textbox" id="uname" name="uname" placeholder="Username" />
        <input type="password" class="textbox" id="pwd" name="pwd" placeholder="Password" />
        <input type="submit" value="Submit" name="submit" class="button-primary" />
        <button type="submit" name="psubmit" class="button-secondary">Click here for Pharmacist Login</button>
      </form>
				
	<?php
				
		include "config.php";

		if(isset($_POST['submit'])){

				$uname = mysqli_real_escape_string($conn,$_POST['uname']);
				$password = mysqli_real_escape_string($conn,$_POST['pwd']);

			if ($uname != "" && $password != ""){
		
					$sql="SELECT * FROM admin WHERE a_username='$uname' AND a_password='$password'";
					$result = $conn->query($sql);
					$row = $result->fetch_row();
					if(!$row) {
						echo "<p style='color:red;'>Invalid username or password!</p>";
					}
					else {
						session_start();
						$_SESSION['user']=$uname;
						header('location:adminmainpage.php');
					}
				}
			}
				
		if(isset($_POST['psubmit']))
		{
			header("location:mainpage1.php");
		}
	?>
			
	</div>

    <!-- Right side: Illustration -->
    <div class="image-section">
      <img src="illustration.png" alt="Pharmacist Illustration">
    </div>
  </div>
</body>
</html>			