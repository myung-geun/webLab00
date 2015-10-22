<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		if(empty($_POST["name"]) || empty($_POST["number"]) || empty($_POST["cardNum"]) || !isset($_POST["name"]) || !isset($_POST["number"]) || !isset($_POST["cardNum"]) || !isset($_POST["option"]) || !isset($_POST["fruits"]) || !isset($_POST["quantity"]) || !isset($_POST["cardtype"])){
		?>

		<!-- Ex 4 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely.
				<a href="fruitstore.html">Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/^[a-zA-Z]+([\-\s]{1}[a-zA-Z]+)*$/",$_POST["name"])) { 

		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. 
				<a href="fruitstore.html">Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		} elseif (strlen($_POST["cardNum"]) != 16 || 
		($_POST["cardtype"] == "visa" && !preg_match("/^4/", $_POST["cardNum"])) ||
		($_POST["cardtype"] == "master card" && !preg_match("/^5/", $_POST["cardNum"]))) {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number.
				<a href="fruitstore.html">Try again?</p>

		<?php
		# if all the validation and check are passed 
		} else {
		?>

		<h1>Thanks!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["name"] ?></li>
			<li>Membership Number: <?= $_POST["number"] ?></li>
			<li>Options:
				<?php 
					$temp = array();
					$option=array("Organic" , "Domestically Produced" , "Genetically Modified", "Newly Harvested");
					$i = 0;
					foreach ($_POST["option"] as $ch) {
						array_push($temp, $ch);
						$i++;
					}
					$fruits = implode(", ",$temp);
					print $fruits;
				?>
			</li>
			<li>Fruits: <?= $_POST["fruits"] ?> - <?= $_POST["quantity"] ?></li>
			<li>Credit <?= $_POST["cardNum"] ?>(<?= $_POST["cardtype"] ?>)</li>
		</ul>
		
		<!-- Ex 3 : 
			<p>This is the sold fruits count list:</p> -->
		<?php
			$filename = "customers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
			$save_data="";
			if(file_exists($filename)){
				$save_data = file_get_contents($filename);
			}
			$save_data=$save_data.$_POST["name"].";".$_POST["number"].";".$_POST["fruits"].";".$_POST["quantity"]."\n";
			file_put_contents($filename, $save_data);
		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		<p>This is the sold fruits count list:</p>
		<ul>
		<?php 
			$fruitcounts = soldFruitCount($filename);
			foreach($fruitcounts as $count) {
		?>
				<li><?=$count?></li>
		<?php	
			}
		?>
		</ul>
		
		<?php
		 }
		?>
		
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/
			function soldFruitCount($filename) { 
				$infile = file($filename);
				$soldFruit = array();
				$i=0;
				foreach ($infile as $fruit) {
					$substr = explode(';',$fruit);
					$str=$substr[2]." - ".$substr[3];
					array_push($soldFruit,$substr[2]." - ".$substr[3]);	
				} 
				return $soldFruit;
			}
		?>
		
	</body>
</html>
