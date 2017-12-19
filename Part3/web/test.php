<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
<body>
<?php

	$host="db.ist.utl.pt";	// MySQL is hosted in this machine
	$user="ist189011";	// <== replace istxxx by your IST identity
	$password="jkru7758";	// <== paste here the password assigned by mysql_reset
	$dbname = $user;	// Do nothing here, your database has the same name as your username.

	$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");

	$sql = "SELECT * FROM account;";

	echo("<p>Query: " . $sql . "</p>\n");

	$result = $connection->query($sql);
	
	$data = array();
	while($row = mysql_fetch_assoc($result))
	{
	 $data[] = $row;
	}

	$colNames = array_keys(reset($data))
	
	echo("<table border='1'>");
	echo("<tr>");
	//print the header
	foreach($colNames as $colName){
	  echo "<th>$colName</th>";
	}
	echo("</tr>");

	//print the rows
	foreach($data as $row){
	  echo "<tr>";
	  foreach($colNames as $colName)
	  {
		 echo "<td>".$row[$colName]."</td>";
	  }
	  echo "</tr>";
   }
    
	echo("</table>");
		
	$connection = null;

?>
</body>
</html>
