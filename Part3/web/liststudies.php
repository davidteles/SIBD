<!DOCTYPE html>
<html>
	<head>
	<title>Devices worn by patient</title>
	</head>
	<style>
	table, th, td {
    	border: 1px solid black;
    	border-collapse: collapse;
	}
	th, td {
    	padding: 5px;
	}
	</style>
	<body>
	<?php
		$host="db.ist.utl.pt";	// MySQL is hosted in this machine
		$user="ist189011";	// <== replace istxxx by your IST identity
		$password="jkru7758";	// <== paste here the password assigned by mysql_reset
		$dbname = $user;	// Do nothing here, your database has the same name as your username.
 
		$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		
		$name = $_GET["name"];
		$number = $_GET["number"]; 
		
		echo("<h1>List of devices worn by patient $number: " . $name . "</h1>");
		
		$sql = "select serialnum, model, manufacturer, start, end from Device natural join Wears, Patient where patient= Patient.number and Patient.number=" . $number . " ORDER BY end DESC;";
		$result = $connection->query($sql);
		
		$now = time();
		$num = $result->rowCount();
		if ($num == 0){
			echo("There is no devices associated to this Patient!");
		}
		else
		{
		
		
		echo("<table border=\"1\">\n");
		echo("<tr> <td>Serialnum</td> <td>Model</td> <td>Manufacturer</td> <td>Start</td> <td>End</td></tr>\n");
		foreach($result as $row)
		{
			if (strtotime($row["end"]) > $now && strtotime($row["start"]) < $now){
				echo("</td><td bgcolor='#DDDDDD'>");
				echo("<strong>" . $row['serialnum'] . "</strong>");
				echo("</td><td bgcolor='#DDDDDD'>");
				echo($row["model"]);
				echo("</td><td bgcolor='#DDDDDD'>");
				echo($row["manufacturer"]);
				echo("</td><td bgcolor='#DDDDDD'>");
				echo($row["start"]);
				echo("</td><td bgcolor='#DDDDDD'>");
				echo($row["end"]);
				echo("</td><td bgcolor='#DDDDDD'>");
				$manuf=$row['manufacturer'];
				$serial=$row['serialnum'];
				echo("<form action='/ist189011/replaceDevice.php'> 
				<input type='hidden' name='manufacturer' value='$manuf'/>
				<input type='hidden' name='oldserial' value='$serial'/>
				<input type='hidden' name='patientnumber' value='$number'/>
				 <input value='Replace' type='submit'/>
				 </form>");
				echo("</td></tr>\n");
			} else {
				echo("<tr><td>");
				echo($row["serialnum"]);
				echo("</td><td>");
				echo($row["model"]);
				echo("</td><td>");
				echo($row["manufacturer"]);
				echo("</td><td>");
				echo($row["start"]);
				echo("</td><td>");
				echo($row["end"]);
				echo("</td></tr>\n");
			}
		}
		}
	
	?>
		<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
	</body>
</html>
