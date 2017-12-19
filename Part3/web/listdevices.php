<!DOCTYPE html>
<html>
	<head>
	<title>Devices and Studies associated to the patient</title>
	</head>
	<style>
	table, th, td {
    	border: 1px solid black;
    	border-collapse: collapse;
	}
	th, td {
    	padding: 5px;
	}

	footer{
	clear:both;
	width:100%;
	margin:auto;
	}
	</style>
	
	<div>
	<body>
	<?php
		$host="db.ist.utl.pt";	// MySQL is hosted in this machine
		$user="ist189011";	// <== replace istxxx by your IST identity
		$password="jkru7758";	// <== paste here the password assigned by mysql_reset
		$dbname = $user;	// Do nothing here, your database has the same name as your username.
 
		$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		
		$name = $_GET["name"];
		$number = $_GET["number"]; 
		
		echo("<p>List of devices worn by patient $number: " . $name . "</p>");
		echo("<div>");
		$sql = "select serialnum, model, manufacturer, start, end from Device natural join Wears, Patient where patient= Patient.number and Patient.number=" . $number . " ORDER BY end DESC;";
		$result = $connection->query($sql);
		
		$now = time();
		$num = $result->rowCount();
		if ($num == 0){
			echo("<p>There is no devices associated to this Patient!</p>");
		}
		else
		{
		
		echo("<p><table style='with:100%'");
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
		echo("</p>");
		echo("</div>");
		echo("<span>");
		echo("</br><p>List of Studies associates to the  patient $number: " . $name . "</p>");
		$sql = "select Study.date, description, performing_doctor_id, serialnum from Study, Request  WHERE Study.request_number=Request.request_number and Request.patient_id=" . $number . ";";
		$result = $connection->query($sql);
		
		
		$num = $result->rowCount();
		if ($num == 0){
			echo("<p>There is no studies associated to this Patient!</p>");
		}
		else
		{
		
		
		echo("<p><table style='with:100%'");
		echo("<tr> <td>Study Date</td> <td>Description</td> <td>Doctor ID</td> <td>Device Serial Number</td></tr>\n");
		foreach($result as $row)
		{
		
				echo("<tr><td>");
				echo($row["date"]);
				echo("</td><td>");
				echo($row["description"]);
				echo("</td><td>");
				echo($row["performing_doctor_id"]);
				echo("</td><td>");
				echo($row["serialnum"]);
				echo("</td>");
				
			
		}
		}
	?>
		</p></div>
	</body>
	</main>
	<footer><form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form></footer>
</html>
