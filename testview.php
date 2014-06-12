<html>
<head>
	<title>View / PHP Test Stuff</title>
	<style type="text/css">
		fieldset {
		  padding: 1em;
		  font:80%/1 sans-serif;
		  border:1px solid green;
		}

		legend {
		  padding: 0.2em 0.5em;
		  border:1px solid green;
		  color:green;
		  font-size:90%;
		  text-align:right;
		}
  		label {
		  float:left;
		  width:10%;
		  margin-right:0.5em;
		  padding-top:0.2em;
		  text-align:right;
		  font-weight:bold;
		}
  	</style>
</head>
<body>
<h1>Bob's Auto Parts - Customer Orders</h1>
<h2>Customer Orders</h2>

<?php
	//Let's open the orders file
	$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
	@ $fp = fopen("$DOC_ROOT/orders.txt", 'rb');
	if (!$fp) {
		echo "<p><strong>No order pending. Please try again later.</strong></p>";
		exit;
	}

	//While loop
	/* $i = 1;
	while(!feof($fp)) {
		$order = fgetss($fp);
		echo $i++. ". $order <br />";		
	}*/

?>

<hr>

<?php

	//With file() places file contents into an array.
	$orders = file("$DOC_ROOT/orders.txt");

	$numorders = count($orders);

	/*for ($i=0; $i<$numorders; $i++) {
		echo $i+1 . ". $orders[$i]<br />";
	}*/

	echo "<table border='1'>\n";
	echo "<tr><th bgcolor='#CCCCFF'><a href='testview.php?sort=0'>Order Date</a></th>
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=1'>Tires</a></th>
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=2'>Oil</a></th>
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=3'>Spark Plugs</a></th>
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=4'>Total</a></th>
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=5'>Order Number</a></th>				
				<th bgcolor='#CCCCFF'><a href='testview.php?sort=6'>Address</a></th>
			</tr>";

	for ($i=0; $i<$numorders; $i++) {

		//split up lines
		$line = explode("|", $orders[$i]);

		//Format the values below
		$line[0] = trim($line[0]); // trim date
		
		//keep only the items ordered
		$line[1] = intval($line[1]);	//Tires
		$line[2] = intval($line[2]);	//Oil
		$line[3] = intval($line[3]);	//Spark Plugs
		$line[4] = intval($line[4]);	//Total Amount
		$line[5] = intval($line[5]);	//Order number

		//stripslashes from address field
		$line[6] = stripslashes(trim($line[6]));

		//Output each order
		echo "<tr>
				<td>$line[0]</td>
				<td align='right'>$line[1]</td>
				<td align='right'>$line[2]</td>
				<td align='right'>$line[3]</td>
				<td align='right'>\$$line[4]</td>
				<td align='right'>$line[5]</td>
				<td>$line[6]</td>
			</tr>";

		//Save array inside another array
		$rearranged[$i] = $line;
	}

	//SORTING BELOW:
	echo "<tr><td colspan='7' align='center'><strong>Sorted below:</strong></td></tr>";

	//Let's get the sort order
	if (@$_GET['sort']) {

		$sortby = @$_GET['sort'];
	
		//Sort by order chosen
		usort($rearranged, 'compare_values');
	}

	//Spit out values
	/*for ($i=0; $i<$numorders; $i++) {
		echo "<tr>
				<td align='right'>".$rearranged[$i][0]."</td>
				<td align='right'>".$rearranged[$i][1]."</td>
				<td align='right'>".$rearranged[$i][2]."</td>
				<td align='right'>".$rearranged[$i][3]."</td>
				<td align='right'>$".$rearranged[$i][4]."</td>
				<td align='right'>".$rearranged[$i][5]."</td>
				<td align='right'>".$rearranged[$i][6]."</td>
				</tr>";
	}*/
	foreach ($rearranged as $value) {
	/*	echo "<tr>
			<td align='right'>".$value[0]."</td>
			<td align='right'>".$value[1]."</td>
			<td align='right'>".$value[2]."</td>
			<td align='right'>".$value[3]."</td>
			<td align='right'>$".$value[4]."</td>
			<td align='right'>".$value[5]."</td>
			<td align='right'>".$value[6]."</td>
			</tr>";
	*/
		echo "<tr>";
		$i=0;
		foreach ($value as $val) {
			if ($i==4) {
				echo "<td align='right'>\$$val</td>";
			} else {
				echo "<td align='right'>$val</td>";
			}
			$i++;
		}
		echo "</tr>";
	}	

	echo "</table>";

	function compare_values($x, $y) {
	//Let's get the sortby order
	$sortby = $_GET['sort'];

		if ($x[$sortby] == $y[$sortby]) {
			return 0;
		} elseif ($x[$sortby] < $y[$sortby]) {
			return -1;
		} else {
			return 1;
		}

	}
?>

<br /><br />
<hr />
<ul>
	<li><a href="testview.php">View Orders</a></li>
	<li><a href="test.php">Place Orders | Feedback</a></li>
	<li><a href="testfeedback.php">View Feedback</a></li>
</ul>

</body>
</html>