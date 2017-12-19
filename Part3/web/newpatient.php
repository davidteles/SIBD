<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
	
<body>
<?php
	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist189011";	// <== replace istxxx by your IST identity
	$password="jkru7758";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.
 
	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	$name = $_GET["name"];
	$birthday = $_GET["birthday"];
	$address = $_GET["address"];
	
	$result = $connection->query("select MAX(number) as num from Patient;");
	
	foreach($result as $row)
	{ 
		$number = 1 + $row["num"];
	}

	$sql = "insert into Patient values('" . $number . "','" . $name . "','" . $birthday . "','" . $address . "');";
	$result = $connection->query($sql);
	echo("<p></p>Patient successfully added.</p>");
	echo("<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>");
	header("Location: /ist189011/medibase.html")
?>
</body>
</html>




