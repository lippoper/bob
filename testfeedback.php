<html>
<head>
	<title>Feedback / PHP Test Stuff</title>
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
<h2>Feedback Results</h2>

<?php
//Getting our values
$customer_name = addslashes(trim($_POST['name']));
$customer_from = addslashes(trim($_POST['from']));
$customer_feedback = addslashes(trim($_POST['feedback']));

//Setting values
$keywords_email = array('bill' => 'billing@localhost', 'delivery'=>'delivery@localhost', 'shop'=>'retail@localhost');

//Static information
$toaddress = "admin@localhost";
$subject = "Feedback from website";

$toaddress = setproperemail($customer_feedback, $keywords_email, $toaddress);

$email_array = explode("@", strtolower($customer_from));
echo "Email: $email_array[0] @ $email_array[1] <br /><br />";

if ($email_array[1] == 'bigcustomer.com') {
	$toaddress = "boss@localhost";
}

$token = strtok($customer_from, "@");
echo "$token <br />";
while ($token != "") {
	$token = strtok("@");
	echo "$token <br />";
}

echo "<h4>To Address: $toaddress</h4>";

$mailcontent = "Customer name: $customer_name \n".
				"Customer email: ".strtolower($customer_from)."\n".
				"Customer comments:\n $customer_feedback";

//Send mail
//mail($toaddress, $subject, $mailcontent, $customer_from);

echo "<h3>Feedback Submitted</h3>";
echo "<p>Your feedback (shown below) has been sent</p>";
echo "<pre>".nl2br($mailcontent)."</pre>";
//echo "<hr />";


function setproperemail($feedback, $key_email, $toaddress) {

	if (stristr($feedback, "bill")) {
		$toaddress = $key_email['bill'];
	} else if (stristr($feedback, "delivery")) {
		$toaddress = $key_email['delivery'];
	} else if (stristr($feedback, "shop")) {
		$toaddress = $key_email['shop'];
	}
	echo "To Address: $toaddress<br /><br />";
	return $toaddress;

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