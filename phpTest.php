<?php
$servername = "localhost";
$username = "quote";
$password = "quote";
$dbname = "quote-test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// query to get from database
$sql = "SELECT quote FROM randomQuotes order by rand() limit 1";
//execute the query 
$result = $conn->query($sql);
//loop through the results



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quotes</title>
</head>
<body>
	<!-- container -->
	<div>
		<!-- flex container -->
		<div>
			<!-- flex item -->
			<div>
				<?php

					foreach ($result as $row) {
						echo $row['quote'];
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>