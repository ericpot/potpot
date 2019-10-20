<html>
	<head> <title>Product Detail</title> </head>
	<body>
	<?php 
	$servername = "localhost";
	$username = "root";
	$password = "TIC2601";
	$database = "OnlineMarket";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	 
	echo "Connected successfully";
	?>
	
	<p align = "right">
	<input class="MyButton" type="button" value="Go to wishlist!" onclick="window.location.href='https://en.wikipedia.org/wiki/Wish_list'" />
	<input class="MyButton" type="button" value="Go to Shopping Cart" onclick="window.location.href='https://en.wikipedia.org/wiki/Shopping_cart'" />
	</p>
	
	<h1><p align="Left">Product Details</p></h1>
	
	<!--- QUERY FOR PRODUCT DETAILS BEGIN--->
	<?php
		$sql = "SELECT sellerID, productName, description, price, createdDate FROM Products WHERE productID = " .$_POST['productname'];
		echo "<b>SQL:  </b>".$sql."<br><br>";
		$result = $conn->query($sql);

		echo "<table border=\"1\" >
		<tr>
		<col width=\"15%\">
		<col width=\"15%\">
		<col width=\"40%\">
		<col width=\"15%\">
		<col width=\"15%\">
		<th>Seller Name</th>
		<th>Product Name</th>
		<th>Product Description</th>
		<th>Price</th>
		<th>Date uploaded(YYYY-MM-DD)</th>
		</tr>";
		$row = $result->fetch_array();
		echo "<tr>";		
		echo "<td>" . $row[0] . "</td>";
		echo '<td><a href="http://www.google.com">'. $row[1] ."</a></td>"; /*need to link to item page*/
		echo "<td>" . $row[2] . "</td>"; 
		echo "<td>" . "$" . number_format($row[3],2) . "</td>"; 
		echo "<td>" . substr($row[4], 0, -9) . "</td>"; 
		echo "</tr>"; 
		echo "</table>";
		
		  
		$result->close();	
	?>
	<!--- QUERY FOR PRODUCT DETAILS END--->	
	<br>

	<input class="MyButton" type="button" value="Add to cart" onclick="sayHello()" />

<form method="post">
    <button name="test">test</button>
</form>

    <?php
    if(isset($_POST['test'])){
      //do php stuff  
    }
    ?>

	</body>
</html>