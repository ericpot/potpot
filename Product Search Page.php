<?php
// Start the session
session_start();
?>

<html>
	<head> <title>Search Product Listing</title> </head>
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
	
	<h1><p align="center">Search Product Listing</p></h1>
	
<form>
	<p align="center">
	<input type="text" name="searchdsc" placeholder="What are you looking for?" size = "60">
	

	<!--- Options removed as I only consider search via Product name
	<select name="Category"> 
		<option disabled selected hidden>Select Category</option>
		<option value="electronics">Electronics</option>
		<option value="fashion">Fashion</option>
		<option value="foodanddrinks">Food and drinks</option>
		<option value="toyandgames">Toys and games</option>
	</select>
	
	<select name="SearchBy"> 
		<option disabled selected hidden>Search By</option>
		<option value="SellerName">Seller name</option>
		<option name="SearchBy" value="productName">Product Name</option>
		<option name="SearchBy" value="description">Product Description</option>
		
	</select>
	--->
	<input type="submit" name="formSubmit" value="Search" >	
</form>


	
	<!--- QUERY FOR SEARCH BEGIN--->
	<?php
	if(isset($_GET['formSubmit']) AND $_GET['searchdsc'] <> '')
	{
	  $sql = "SELECT u.name, p.productName, p.description, p.price, p.createdDate, p.productid FROM Products p, Users u WHERE p.sellerID = u.userID AND 
	  p.productName like '%".$_GET['searchdsc']."%'
	  ORDER BY p.createdDate DESC";
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

	  while($row = $result->fetch_array()) {
		echo "<tr>";		
		echo "<td>" . $row[0] . "</td>";
		echo '<td>

<form method="post" action="Product detail.php">
<input type="hidden" name="productname" value='.$row[5].' />
<input type="submit" name = "addToCart" value="'.$row[1].'" />
</form>
		
		</a></td>'; /*need to link to item page*/		
		echo "<td>" . $row[2] . "</td>"; 
		echo "<td>" . "$" . number_format($row[3],2) . "</td>"; 
		echo "<td>" . substr($row[4], 0, -9) . "</td>"; 
		echo "</tr>"; 
	  }
	  echo "</table>";

	  $result->close();
	}
	?>
	
	<!--- QUERY FOR SEARCH END--->
	
	</body>
<style>
	input[name = addToCart]{
	padding: 0;
	border: none;
	background: none;
	cursor: pointer;
	}
	input[name = addToCart]:hover{
	background-color: yellow;
	}
</style>
</html>