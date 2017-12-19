<!DOCTYPE html>
<html>
	<head>
	<title>Devices worn by patient</title>
	</head>
	<body>
		
		
			<?php
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$manuf = $_GET["manufacturer"];
			$oldserial = $_GET['oldserial'];
			$patientnumber = $_GET['patientnumber'];
			
			$sql = "select serialnum, model from Device where manufacturer = '$manuf' and serialnum NOT IN (select serialnum from Wears where now() between start and end);";
			$result = $connection->query($sql);
			echo("Devices manufactured by: $manuf ");
			echo("<form action='/ist189011/performreplace.php' method='get'><select name='serial'>");
			foreach($result as $row){
				$serial= $row['serialnum'];
				$model = $row['model'];
				echo("<option value=$serial> Model: $model  Serial: $serial   </option>");
			}
			
			echo("<input type='hidden' name='oldserial' value='".$oldserial."'/>");
			echo("<input type='hidden' name='patientnumber' value='".$patientnumber."'/>");
		?>
		
		
		</select>
		<input type='submit' value='Replace'>
		</form>
		</br>
		
		<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
		
	</body>
</html>
