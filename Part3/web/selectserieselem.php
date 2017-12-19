<!DOCTYPE html>
<html>
	<head>
	<title>Add Series DHD DB Solutions</title>
	</head>
	<center>
	<body>
		<?php		
			$patient = $_POST["patient"];
			
			
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
		 
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			$sql = "select distinct series_id from Series;";
			$series = $connection->query($sql);
			
			$sql = "select distinct elem_index from Element;";
			$elems = $connection->query($sql);
			
			$sql = "select patient_id from Request, Study, Series;";  
			
			$date = date("Y-m-d", time());
					
		?>
		
		<h1>Add Region</h1>
		<form action='/ist189011/addregion.php' method="post" id='requestform' >
			<strong>Series id:
			<select name="series_id" >
			<?php
				foreach($series as $row){
					$d= $row['series_id'];
					echo("<option value=$d> $d </option>");
				}
	  		?>	
			</select>
			<br></br>
			<strong><p>Element index:
			<select name="elem_index" > 
			<?php
				foreach($elems as $row){
					$d= $row['elem_index'];
					echo("<p><option value=$d> $d </option></p>");
				}
			?>
			</p>
			</br>
			<p>
			</select></br>
			<input type="number" name="x1" placeholder="x1" min="0" max="1" step="0.01"></br>
			<input type="number" name="x2" placeholder="x2" min="0" max="1" step="0.01"></br>
			<input type="number" name="y1" placeholder="y1" min="0" max="1" step="0.01"></br>
			<input type="number" name="y2" placeholder="y2" min="0" max="1" step="0.01"></br>
			</p><br></br>
			<input type='submit' value='Add region of interest'>
		</form>
		
	</br>
	<p>
	<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
	</p>
	</body></center>
</html>

