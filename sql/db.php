<!DOCTYPE html>
<html>
<head>
	<title>DB query</title>
</head>
<body>
		<?php
			$db_name = $_POST["db_name"];
			$db_query = $_POST["query"];
				$db = new PDO("mysql:dbname=$db_name","root","dlthffpt12");
				$rows = $db->query($db_query);
				foreach($rows as $row) {
					$temp='0';
					foreach($row as $r){ 
						if (!strcmp($temp,$r)){
							
					?>
						<ul><li><?= $r?></li></ul>
					<?php }$temp=$r;}
				}
		?>
</body>
</html>