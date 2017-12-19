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
			
			$device = $_POST["device"];
			$exp = explode('|', $device);
			$serial = $exp[0];
			$manuf = $exp[1];
			
			$description = $_POST["description"];
			$date = $_POST["date"];
			$name = $_POST["name"];
					
			
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
		 
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			
			function doQuery( $connection, $sql, $args){
				$sth = $connection->prepare($sql);
				if (false==$sth) {
					throw new Exception("Query preparation failed.");
				}
				$result = $sth->execute($args);
				if (false==$result) {
					throw new Exception("Query execution failed. Code. " . $sth->errorcode() );
				}
			}
			
			$sql = "select MAX(request_number) as rnum from Request;";
			$res = $connection->query($sql);
			foreach($res as $row){ 
				$reqnumber = 1 + $row["rnum"];
			}
			#echo("$rdoc , $patient");
			#$sql = "select MAX(request_number) as rnum from Request where patient_id=" . $patient . " and requesting_doctor_id=" . $rdoc .";";
                        #$res = $connection->query($sql);
                        #foreach($res as $row){ 
                        #        $reqnumber = 111 + $row["rnum"];
                        #}
			#echo("$reqnumber");

			$sql = "select MAX(series_id) as id from Series;";
			$res = $connection->query($sql);
			foreach($res as $row){ 
				$series_id = 1 + $row["id"];
			}
			
			$elem_index = 0;
			
			$base_url = "http://web.tecnico.ulisboa.pt/ist189011/series/";
			$series_dir = "series/$series_id/";	
			$elem_dir = "$series_dir/$elem_index/";
			
			#echo("$series_id, $reqnumber, ". $patient. ", ". $rdoc .", " . $date ." </br>");
			
			try{
				$connection->beginTransaction();
				
				$sql="insert into Request values (?, ?, ?, ?);";	
				doQuery($connection, $sql, array($reqnumber, $patient, $rdoc, $date) );
				
				$sql="insert into Study values (?, ?, ?, ?, ?, ?);";
				doQuery($connection, $sql, array($reqnumber, $description, $date, $pdoc, $serial, $manuf));
				
				$sql="insert into Series values (?, ?, ?, ?, ?);";	
				doQuery($connection, $sql, array($series_id, $name, $base_url, $reqnumber, $description) );
				
				$sql="insert into Element values (?, ?);";	
				doQuery($connection, $sql, array($series_id, $elem_index) );
				
				if (!file_exists($series_dir)) {
					mkdir($series_dir, 0777, true);
				}
				
				if (!file_exists($elem_dir)) {
					mkdir($elem_dir, 0777, true);
				}
				
				#echo($target_file);
				if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $elem_dir . $_FILES['fileToUpload']['name'])) {
					echo("File uploaded </br>");
				}else {
					throw new Exception("There was an error uploading your file.");
				}
						
				$connection->commit();
				
				echo("Study created");
				//header("Location: /ist189011/medibase.html")
				
			} catch(Exception $e){
				//Rollback the transaction.
				$connection->rollBack();
				echo("Study not created");
				echo("</br>".$e->getMessage());	
			}
			
		?>	
	</br>
	<button value='Go back' onclick=' window.history.back()'>Go Back</button>	
	<form action='/ist189011/medibase.html'><input value='Go back to main page' type='submit'/></form>
	</body></center>
</html>



