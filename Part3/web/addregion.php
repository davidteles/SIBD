<!DOCTYPE html>
<html>
	<head>
	<title>Add Series DHD DB Solutions</title>
	</head>
	<body>
		<?php	
			$series_id = $_POST["series_id"];
			$elem_index = $_POST["elem_index"];
			$x1 = $_POST["x1"];
			$x2 = $_POST["x2"];
			$y1 = $_POST["y1"];
			$y2 = $_POST["y2"];
			#echo("$series_id.....$elem_index</br>");	
			$host="db.ist.utl.pt";	// MySQL is hosted in this machine
			$user="ist189011";	// <== replace istxxx by your IST identity
			$password="jkru7758";	// <== paste here the password assigned by mysql_reset
			$dbname = $user;	// Do nothing here, your database has the same name as your username.
		 
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			
			$sql = "select distinct patient_id from Request as r, Series as ser where r.request_number = ser.request_number and ser.series_id = $series_id;";
			$patients = $connection->query($sql);
			
			foreach($patients as $row){
				$patient= $row['patient_id'];
			}
			
			#echo("patient: $patient, </br>");
			
			$studydate = "select distinct Study.date as dt from Request as r, Series, Study where Series.request_number = Study.request_number and Series.description=Study.description and Series.series_id=$series_id;";
			$res = $connection->query($studydate);
			foreach($res as $row){
				$dt = $row["dt"];
				#echo("dt: $dt </br>");
			}
						
			#echo("</br> laststudy </br>");
			$laststudy = "select s.request_number , description, max(s.date) as mxdt from Study as s, Request as r where s.date < '$dt' and s.request_number = r.request_number and r.patient_id=$patient";			
			$res2 = $connection->query($laststudy);
			
			#echo("<tr> <td>req</td> <td>desc</td> <td>dt</td> </tr>\n");
			foreach($res2 as $row){
				#echo("<tr><td>");
				#echo($row["request_number"]);
				$req = $row["request_number"];
				#echo("</td><td>");
				#echo($row["description"]);
				$desc = $row["description"];
				#echo("</td><td>");
				#echo($row["mxdt"]);
				$mxdt = $row["mxdt"];
				#echo("</td></tr>\n");
			}
			
			
			
			#$regions = "select x1,x2,y1,y2 from Region as r, Study as s, Series as sr, where $req=sr.request_number and $desc=sr.description and sr.series_id=r.series_id;";
			#$regions = "select(r.series_id, r.elem_index, x1,x2,y1,y2) from Region as r, (select series_id from Series where request_number=$req and description='$desc' ) as ss where r.series_id=ss.series_id;";
			
			$overlapping_regions = "select ss.series_id, r.elem_index, region_overlaps_element(ss.series_id, r.elem_index, $x1,$x2,$y1,$y2) as ovrlp from Region as r, (select series_id from Series where request_number=$req and description='$desc' ) as ss where r.series_id=ss.series_id;";
			$overlaps = $connection->query($overlapping_regions);
			echo("$desc, $req</br>");
			foreach($overlaps as $row){
				$ovrlp = $row["ovrlp"];
				echo("$ovrlp</br>");
				$id = $row["series_id"];
				$elem = $row["elem_index"];
				if ($ovrlp==1){
					echo("Overlaps with element $elem in series $id. </br>");
				}
			}
		?>
	<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>
	</body></center>
</html>


