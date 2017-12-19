<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
<header>
<title>DHD Search Results</title>
<img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/580dcb270000ff00059677f9/0x0.png" height="75">
</header>
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
		
	$sql = "SELECT * FROM Patient WHERE Patient.name like '%" . $_POST["patient"] . "%';";
	
	$result = $connection->query($sql);
	$num = $result->rowCount();
	
	

	
	if ($num == 0) {
		echo("No Patient Found that corresponds to your search terms!!");
		echo("<p>Would you like to add a record?</p>");
		echo("<form action='/ist189011/newpatient.html'><input value='Add new patient' type='submit'/></form>");
		
	}
	else{
		echo("<p><Strong>$num Patient that correspond to your search retrieved:</Strong></p>\n");
		
		echo("<table style='with:100%'");
		echo("<tr><td>Number</td><td>Name</td><td>Birthday</td><td>Address</td></tr>\n");
		foreach($result as $row)
		{
			echo("<tr><td>");
			echo($row["number"]);
			echo("</td><td>");
			echo("<a href='/ist189011/listdevices.php?number=" .$row['number'] . "&name=". $row['name'] . "'>" .$row['name'] . "</a>");
			echo("</td><td>");
			echo($row["birthday"]);
			echo("</td><td>");
			echo($row["address"]);
			echo("</td></tr>\n");
		}
		echo("</table>\n");
	}
	
		
    $connection = null;
	
	#echo("<button onclick=' window.history.back()'>Go Back</button>");
	
	echo("<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>");
?>
</body>
<footer>Patient Management DB Solutions &copy; Designed By Diogo, Haakon and David DHD.</footer>
</html>
