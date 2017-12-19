<!DOCTYPE html>
<html>
	<head>
	<title>Add Series DHD DB Solutions</title>
	</head>
	<body>
		<?php		
		
			$rdoc = $_POST["rdoc"];
			$pdoc = $_POST["pdoc"];
			$patient = $_POST["patient"];
			$description = $_POST["description"];
			$date = $_POST["date"];
			
			#echo("$patient, $pdoc, $rdoc, $date, $description </br>");
			
			if ($rdoc == $pdoc){
				echo("Performing doctor may not be he same as the requestng doctor."); 
				echo("</br>");
				echo("<button onclick=' window.history.back()'>Go Back</button>");
				die();
			}
			
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
		 
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			
			$sql = "select serialnum, manufacturer from Wears where patient='$patient' and  now() > start ;";
			$devices = $connection->query($sql);
			
			$base_url = "http://web.tecnico.ulisboa.pt/ist189011/series/";		
		?>
		
		<h1>Choose device and upload file</h1>
		<form action='/ist189011/uploadseries.php' method="post" enctype="multipart/form-data">
			Select device:
			</br>
			<select name="device" >
				
			<?php
				foreach($devices as $row){
					$serial= $row['serialnum'];
					$manuf= $row['manufacturer'];
					echo("<option value=$serial|$manuf> Manufacturer: $manuf Serial: $serial   </option>");
				}
			?>
			
			</select>
			</br>
			</br>
			<input type='text' name='name', placeholder='Series name'>
			</br>
			</br>
			Upload data series file:
			</br>
			<input type="file" name="fileToUpload" id="fileToUpload">
			</br>
			
			<?php
			echo("<input type='hidden' name='rdoc' value='$rdoc'>");
			echo("<input type='hidden' name='pdoc' value='$pdoc'>");
			echo("<input type='hidden' name='patient' value='$patient'>");
			echo("<input type='hidden' name='description' value='$description'>");
			echo("<input type='hidden' name='date' value='$date'>");
			?>
			
			</br>
			<input value='Create dataseries' type='submit'/>	
		</form>
		
		</br>
	<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
	</body></center>
</html>


