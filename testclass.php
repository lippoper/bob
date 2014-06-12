<?php

class Page {
	public $content;
	public $title = "Bob's Consulting";
	public $keywords = "Bob Consulting. Three Letter Abbreviation. some of my best friends are search engines";
	public $buttons = array( 	"Home | Place Orders" 		=> 	"/home.php",
								"View Orders" 				=>	"/testview.php",
								"View Feedback"				=>	"/testfeedback.php");

	public function __set($name, $value) {
		$this->$name = $value;
	}

	public function Display() {
		echo "<html><head>\n";
		$this->DisplayTitle();
		$this->DisplayKeywords();
		$this->DisplayStyles();
		echo "</head>\n<body>\n";
		$this->DisplayHeader();
		$this->DisplayMenu($this->buttons);
		echo $this->content;
		$this->DisplayFooter();
		echo "</body>\n</html>\n";
	}

	public function DisplayTitle() {
		echo "<title>".$this->title."</title>";
	}

	public function DisplayKeywords() {
		echo "<meta name=\"keywords\" content=\"".$this->keywords."\" />";
	}

	public function DisplayStyles() {
?>
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
<?php
	}

	public function DisplayHeader() {
		echo 	"<h1>Bob's Auto Parts - ".$this->title."</h1>
				<h2>$this->title</h2>";
	}

	public function DisplayMenu($buttons) {
		echo "<ul class=\"buttons\">";
		//calculate button size
		$width = 100/count($buttons);

		while (list($name, $url) = each($buttons)) {
			$this->DisplayButton($width, $name, $url
					//, !this->IsURLCurrentPage($url)
				);
		}
		echo "</ul>";
	}

	public function IsURLCurrentPage($url) {
		if(strpos($_SERVER['PHP_SELF'], $url) == false)	{
			return false;
		} else {
			return true;
		}
	}

	public function DisplayButton($width,$name,$url,$active=true) {
		if ($active) {
			echo "<li width=\"$width\"><a href=\"$url\">$name</a></li>";
		} else {
			echo "<li width=\"$width\">$name</li>";
		}
	}

	public function DisplayFooter() {
		echo "<h5>Copyright year etc.</h5>";
	}


}


?>



	<!--<li><a href="testview.php">View Orders</a></li>
	<li><a href="test.php">Place Orders | Feedback</a></li>
	<li><a href="testfeedback.php">View Feedback</a></li> -->