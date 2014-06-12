<html>
<head>
	<title>Process Orders / PHP Test Stuff</title>
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
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php
	//Define our contants
	define('TIREPRICE', 100);
	define('OILPRICE', 10);
	define('SPARKPRICE', 4);

	//Replace constant prices with array of product information $products
	$products = array(
					'Tire'=>array( 'Code'=>'TIR',
						 	'Description'=>'Tire',
						 	'Price'=>100 ),
					'Oil'=>array( 'Code'=>'OIL',
							'Description'=>'Oil',
							'Price'=>10 ),
					'Spark Plugs'=>array( 'Code'=>'SPK',
							'Description'=>'Spark Plugs',
							'Price'=>4 )
					);

	//Define our variables
	$tireqty = trim($_POST['tireqty']);
	$oilqty = trim($_POST['oilqty']);
	$sparkqty = trim($_POST['sparkqty']);
	$find = $_POST['find'];
	$address = addslashes(trim($_REQUEST['address']));
	$date = date('H:i, jS F Y');

	//Product quantities in an array
	$products_ordered = array('Tire'=>$tireqty, 'Oil'=>$oilqty, 'Spark Plugs'=>$sparkqty);

	$ordernumber = rand();	//Random order number
	$totalqty = 0;
	//Add up total of prodcuts_ordered
	foreach ($products_ordered as $key => $value) {
		$totalqty+=$value;
	}

	$totalamount = 0.00;
	$totalamount = $products_ordered['Tire'] * $products['Tire']['Price'] + $products_ordered['Oil'] * $products['Oil']['Price'] + $products_ordered['Spark Plugs'] * $products['Spark Plugs']['Price'];

	//If anything was ordered
	if ($totalqty > 0) {
		echo "<p>Order processed at $date</p>";

		echo "Items ordered: $totalqty <br />";

		echo "Subtotal: $".number_format($totalamount,2)."<br />";

		$taxrate = 0.065; // local sales tax is 6.5%
		$totalamount *= (1 + $taxrate); // get the total with tax

		//Prepare $totalamount for output
		$totalamount = number_format($totalamount,2, '.', ' ');

		echo "Total including tax: $".number_format($totalamount,2)."<br />";

		echo "<p>Your order is as follows: </p>";
		if ($tireqty > 0) {
			echo "$tireqty tire(s)<br />";
		}
		if ($oilqty > 0) {
			echo "$oilqty bottle(s) of oil<br />";
		}
		if ($sparkqty > 0) {
			echo "$sparkqty spark plug(s)<br />";
		}

		//How did you find us
		if ($find) {
			echo "<p>You heard of us by: ";
			if ($find == "a") {
				echo "Regular customer</p>";
			} elseif ($find == "b") {
				echo "TV</p>";
			} elseif ($find == "c") {
				echo "Phone</p>";
			} elseif ($find == "d") {
				echo "Word of mouth</p>";
			}
		}

		//Output string to save
		$outputstring = "$date | $tireqty tires | $oilqty oil | $sparkqty spark plugs | $totalamount | $ordernumber | $address"."\n";
		echo $outputstring;

	}
	//If nothing was ordered
	 else {
		echo '<p>You have not ordered any items</p>';
		echo "<h3><a href='test.php'>Order page</a></h3>";
	}

	//If there's a shipping address, display it.
	if (!empty($address)) { echo "<p>Shipping Address: $address </p>"; } 

	//Open our order file
	$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
	@ $fp = fopen("$DOC_ROOT/orders.txt", 'ab');
	
	if (!$fp) { 
		echo "<h1 style='color:red;'>Your order is unable to be processed at this time.</h1></body></html>";
		exit;
	}
	else {
		flock($fp, LOCK_EX);			// Lock file for writing
		fwrite($fp, $outputstring);		// Write to file
		flock($fp, LOCK_UN);			// UnLock file
		fclose($fp);					// Close file

		echo "Order number: $ordernumber saved!";				// Report file saved.
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