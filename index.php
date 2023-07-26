<?php
require("connection.php");
require("validation.php");

$isUpdatePopupOpen = "";
$oldPhoneNum = "";
$oldEmail = "";
$oldName = "";
$oldCity = "";

if (isset($_GET["oldphone"])) {
	$isUpdatePopupOpen = "open";
	$oldPhoneNum = $_GET["oldphone"];
}

if (isset($_GET["currentEmail"])) {
	$oldEmail = $_GET["currentEmail"];
}

if (isset($_GET["currentName"])) {
	$oldName = $_GET["currentName"];
}

if (isset($_GET["currentCity"])) {
	$oldCity = $_GET["currentCity"];
}
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
} else {
	// echo "Connection Successfull";
	if (isset($_POST['submit'])) 
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		
		$phone = $_POST['phone'];
		$city = $_POST['city'];
		// $validation=new validation();
		
		
		if (validate_Email($email) && validate_Phone($phone)) {
			// Prepare and execute the SQL query
			$stmt = mysqli_prepare($conn, "INSERT INTO contact (name, email, phone, city) VALUES (?, ?, ?, ?)");
			
			mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $city);
			mysqli_stmt_execute($stmt);
		}
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Contact Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<h1>Contact Management System</h1>
	<div class="container">
		<form method="post" action="<?php $_SERVER['PHP_SELF']?>" class="new-contact-form">
			<h2>Add Contact</h2>
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required placeholder="Enter your Name" autocomplete="off">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" required placeholder="Enter your Email" autocomplete="off">
			<label for="phone">Phone:</label>
			<input type="text" id="phone" name="phone" required placeholder="Enter Ph no." autocomplete="off">
			<label for="city">City:</label>
			<input type="text" id="city" name="city" required placeholder="Enter your City" autocomplete="off">
			<button type="submit" name="submit">Add</button>
		</form>
		<div id="contacts">
			<h2>Contacts</h2>
			<table>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>City</th>
					<th>Update</th>
					<th>Send Email</th>
				</tr>
			 <?php
				$sql = "SELECT * FROM contact";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<tr class='contact-row'>";
						echo "<td>" . $row["name"] . "</td>";
						echo "<td>" . $row["email"] . "</td>";
						echo "<td>" . $row["phone"] . "</td>";
						echo "<td>" . $row["city"] . "</td>";
						echo '<td><button type="button" class="icon-btn edit-data" data-phonenum="' . $row["phone"] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
						<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
					  </svg></button></td>';
						echo '<td><button class="icon-btn send-email" name="email" data-email="' . $row["email"] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
						<path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z"/>
						<path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z"/>
					  </svg></button></td>';
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='4'>0 Contact</td></tr>";
				}
				if (isset($_POST['save_changes'])) {
					$name = $_POST['update_name'];
					$email = $_POST['update_email'];
					$phone = $_POST['update_phone'];
					$city = $_POST['update_city'];
					$stmt1 = "UPDATE contact set name=?, email=?, phone=?, city=? WHERE phone=$oldPhoneNum";
					$stmt = $conn->prepare($stmt1);
					$stmt->bind_param("ssss", $name, $email, $phone, $city);
					$stmt->execute();
					$isUpdatePopupOpen = "";
					$oldPhoneNum = "";
					$oldCity = "";
					$oldName = "";
					$oldEmail = "";
					echo "<script>window.location.href = 'contact.php';</script>";
				}
				if (isset($_POST['delete_data'])) {
					$phone = $_POST['update_phone'];
					$sql = "DELETE FROM contact WHERE phone=$phone";
					mysqli_query($conn, $sql);
					echo "<script>window.location.href = 'contact.php';</script>";

				}
				?> 
			</table>

		</div>
	</div>


	<section class="update-popup <?php echo $isUpdatePopupOpen; ?>">
		<form method="post" action="">
			<button type="button" id="cancel_update" class="icon-btn">X</button>
			<h2>Edit Contact</h2>
			<label for="update_name">Name:</label>
			<input type="text" id="update_name" name="update_name" required placeholder="Enter your Name"
				autocomplete="off" value="<?php echo $oldName; ?>">
			<label for="update_email">Email:</label>
			<input type="text" id="update_email" name="update_email" required placeholder="Enter your Email"
				autocomplete="off" value="<?php echo $oldEmail; ?>">
			<label for="update_phone">Phone:</label>
			<input type="text" id="update_phone" name="update_phone" required placeholder="Enter Ph no."
				autocomplete="off" value="<?php echo $oldPhoneNum; ?>">
			<label for="update_city">City:</label>
			<input type="text" id="update_city" name="update_city" required placeholder="Enter your City"
				autocomplete="off" value="<?php echo $oldCity; ?>">
			<button type="submit" name="save_changes">Save Changes</button><br>
			<button type="submit" name="delete_data">Delete contact</button>
		</form>
	</section>

	<script type="text/javascript" src="script.js"></script>

</body>

</html>

<?php

?>