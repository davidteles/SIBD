<!DOCTYPE html>
<html>
	<head>
	<title>Add Series DHD DB Solutions</title>
	</head>
	<body>
		<?php		
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
		 
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$base_url = "http://web.tecnico.ulisboa.pt/ist189011/series/";
			$sql = "select doctor_id from Doctor;";
			$doctors = $connection->query($sql);
			$doctors2 = $connection->query($sql);
			
			$sql = "select number from Patient;";
			$patients = $connection->query($sql);
			
			$date = date("Y-m-d", time());
					
		?>
		
		<h1>Add Dataseries</h1>
		<form action='/ist189011/insertnewseries.php' method="post" id='requestform' >
			<strong>Requesting doctor number:
			<select name="rdoc" >
			<?php
				foreach($doctors as $row){
					$d= $row['doctor_id'];
					echo("<option value=$d> $d </option>");
				}
			?>
			</select>
			<br></br>
			<strong>Performing doctor number:
			<select name="pdoc" >
			<?php
				foreach($doctors2 as $row){
					$d= $row['doctor_id'];
					echo("<option value=$d> $d </option>");
				}
			?>
			</select>
			<br></br>
			<strong>Patient number:
			<select name="patient" > 
			<?php
				foreach($patients as $row){
					$d= $row['number'];
					echo("<option value=$d> $d </option>");
				}
			?>
			</select>
			<br></br>
			<textarea name='description' rows='5' cols='40' placeholder='Enter description here'></textarea>
			</br>	
			<?php echo("<input type='hidden' name='date' value='$date'>"); ?>
			
			<input form='requestform' value='Add new dataseries' type='submit'/>	
		</form>
		
	<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
	</body></center>
</html>

