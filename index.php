<?php

require("testclass.php");

$homepage = new Page();

$homepage->content = "<form id=\"processorder\" action=\"testprocess.php\" method=\"post\">
	<fieldset>
	<legend>Place your order:</legend>

	<label for=\"tireqty\">Tires: </label>
	<input type=\"text\" name=\"tireqty\" size=\"3\" maxlength=\"3\" /><br />

	<label for=\"oiqty\">Oil: </label>
	<input type=\"text\" name=\"oilqty\" size=\"3\" maxlength=\"3\" /><br />

	<label for=\"sparkqty\">Spark Plugs: </label>
	<input type=\"text\" name=\"sparkqty\" size=\"3\" maxlength=\"3\" /><br />

	<label for=\"address\">Shipping Address: </label>
	<input type=\"text\" name=\"address\" size=\"50\" maxlength=\"128\" /><br /><br />

	<label for=\"find\">How did you find Bob's? </label>
		<select name=\"find\">
			<option value=\"a\">Regular customer</option>
			<option value=\"b\">TV</option>
			<option value=\"c\">Phone</option>
			<option value=\"d\">Word of mouth</option>
		</select>
	<br /><br />
	<p><input type=\"submit\" value=\"Submit Order\" /></p>
	</fieldset>
</form>

<h4>Please tell us what you think:</h4>
<form id=\"feedback\" action=\"testfeedback.php\" method=\"post\">
	<fieldset>
	<legend>Your Feedback:</legend>
	<label for=\"name\">Name:</label>
	<input type=\"text\" name=\"name\" size=\"32\" maxlength=\"128\" /><br />
	<label for=\"from\">Email:</label>
	<input type=\"text\" name=\"from\" size=\"32\" maxlength=\"128\" /><br />
	<label for=\"feedback\">Feedback:</label>
	<textarea name=\"feedback\" rows=\"4\" cols=\"32\"></textarea><br /><br />
	<p><input type=\"submit\" value=\"Submit Feedback\" /></p>
	</fieldset>
</form>

<br /><br />";

$homepage->Display();


?>