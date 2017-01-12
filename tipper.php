<?php
	// Initialize the variables used by the app
	$custom = 5;
	$bill = 0;
	$tip_per = "";
	$tip = "";
	$total = "";
	$errBill = false;
	$errTip = false;
	$errSplit = false;
	$showTotal = false;
	$showSplit = false;
	$lastChoice = 0;
	$numTippers = 1;
	$splitTip = "";
	$splitTotal = "";
	
	function computeTip(){
		// The global keyboard allows us to access the same variables declared outside of the function scope
		// This prevents the function from creating its own local copy of the variable
		global $custom;
		global $bill;
		global $tip_per;
		global $tip;
		global $total;
		global $errBill;
		global $errTip;
		global $errSplit;
		global $showTotal;
		global $showSplit;
		global $lastChoice;
		global $numTippers;
		global $splitTip;
		global $splitTotal;
		
		// Check to see if the value entered within the 'bill' field is non-numeric or <= 0. If it is, set the error bool to true and return.
		if(!is_numeric($_POST['bill']) || $_POST['bill'] <= 0)
		{
			$errBill = true;
			return;
		}
		
		// Rounds the value stored in 'bill' to the nearest two decimal places
		// Also stores the value of the selected radio button and every other text field
		$bill = round($_POST['bill'],2);
		$tip_per = $_POST['tip'];
		$custom = $_POST['cust_per'];
		$numTippers = $_POST['split'];
		
		switch($tip_per)	// Checks to see which radio button was selected
		{
			case 0.10:
				$lastChoice = 0;	// Keeps track of the currently selected radio button in order to keep it selected after the form is submitted
				break;
			case 0.15:
				$lastChoice = 1;
				break;
			case 0.20:
				$lastChoice = 2;
				break;
			case "custom":
				$tip_per = $custom/100;	// Takes the percent value stored in the "custom" textbox and converts it to decimal form
				$lastChoice = 3;
				break;
			default:
				$lastChoice = 0;
		}
		
		if(!is_numeric($tip_per) || $tip_per <= 0)
		{
			$errTip = true;
			return;
		}
		
		if(!is_numeric($numTippers) || $numTippers < 1)
		{
			$errSplit = true;
			return;
		}
		
		// number_format is used to format the result in standard currency notation, i.e. 1,000.40 instead of 1000.4
		$tip = number_format($bill*$tip_per,2);
		$total = number_format($bill+$tip,2);
		$showTotal = true;
		
		if($numTippers == 1)	// Only one tipper, so split section is not needed/shown
			return;
		else
		{
			$numTippers = floor($numTippers);	// Rounds down to the nearest person
			$splitTip = number_format($tip/$numTippers,2);
			$splitTotal = number_format($total/$numTippers,2);
			$showSplit = true;
		}
	}
	
	if(isset($_POST['bill']))	// Checks to see if the 'bill' field is set so that the function is not executed before the form elements are ready
		computeTip();
?>

<!DOCTYPE html>
<html>
<head>
<title>Tip Calculator</title>
<style type="text/css">

body {
    background-color: lightblue;
}

h1 {
    color: blue;
    text-align: center;
}

#divMain {
	text-align: center;
    background-color: white;
    width: 350px;
    border: 5px solid blue;
    padding: 15px;
    margin: 0 auto;
}

#bill {
	<?php
		if($errBill == true){	// If this flag is set, set the label's formatting to be red and bolded, indicating that there is an error
			echo "font-weight: bold;";
			echo "color: red;";
		}
		else{
			echo "font-weight: normal;";
			echo "color: black;";
		}
	?>
}

#tip {
	<?php
		if($errTip == true){
			echo "font-weight: bold;";
			echo "color: red;";
		}
		else{
			echo "font-weight: normal;";
			echo "color: black;";
		}
	?>
}

#split {
	<?php
		if($errSplit == true){
			echo "font-weight: bold;";
			echo "color: red;";
		}
		else{
			echo "font-weight: normal;";
			echo "color: black;";
		}
	?>
}

#divTotal {
	color: green;
	font-weight: bold;
	text-align: center;
	border: 2px dashed green;
    padding: 15px;
	width:75%;
	margin: 0 auto;
	
	<?php
		if($showTotal == true)	// Shows the div normally if true, hides it if false
			echo "display: block;";
		else
			echo "display: none;";
	?>
}

#divSplit {
	color: purple;
	font-weight: bold;
	text-align: center;
	border: 2px dashed purple;
    padding: 15px;
	width:75%;
	margin: 0 auto;
	
	<?php
		if($showSplit == true)
			echo "display: block;";
		else
			echo "display: none;";
	?>
}
</style>
</head>
<body>

<h1>Tipper</h1>

<div id="divMain">
	<form action="" method="post">
		<label id="bill">Bill Subtotal: $</label> <input type="text" name="bill" value="<?php echo $bill ?>">
		<br><br>
		<label id="tip">Tip Percent: 
		<?php
			$tip_per = array("10", "15", "20");		//Store tip percentages in an array, in case we want to have more than 3 in the future.
			// Creating radio buttons using a loop
			for($i = 0; $i < count($tip_per); $i++) { 
		?>
			<input type="radio" name="tip" value="0.<?php echo $tip_per[$i]; ?>"
			<?php if($i == $lastChoice) echo "checked"; ?>>
			<?php echo $tip_per[$i]; ?>%
		<?php
			}
		?>
		<br>
		<input type="radio" name="tip" value="custom" <?php if($lastChoice == 3) echo "checked"; ?>>
		<label id="custom">Custom</label>
		<input type="text" name="cust_per" value="<?php echo $custom ?>">%</label>
		<br><br>
		<label id="split">Split <input type="text" name="split" value="<?php echo $numTippers ?>"> person(s) </label>
		<br><br>
		<input type="submit" id="compute" value="Compute Tip">
		<br><br>
		<div id="divTotal">
			Tip: $<?php echo $tip ?>
			<br>
			Total: $<?php echo $total ?>
		</div>
		<br>
		<div id="divSplit">
			Tip Each: $<?php echo $splitTip ?>
			<br>
			Total Each: $<?php echo $splitTotal ?>
		</div>
	</form>
</div>

</body>
</html>