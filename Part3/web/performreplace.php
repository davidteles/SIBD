
<!-- IST MySQL Connection Test -- 2015.09.19 -->

<html>
	
<body>
	
<?php

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
			throw new Exception("Query execution failed.");
		}
	}
	
	$newserial = $_GET['serial'];
	$oldserial = $_GET['oldserial'];
	$patientnumber = $_GET['patientnumber'];
	$now = date("Y-m-d H:i:s", time());
	$now_plus = date("Y-m-d H:i:s", time()+1);
	
	$sql = "select start, end, manufacturer from Wears where serialnum = '$oldserial';";
	$result = $connection->query($sql);
	
	foreach($result as $row){ 
		$start = $row["start"];
		$end = $row["end"];
		$manuf = $row["manufacturer"];
	}
	
	#echo(" $now, $now_plus, $manuf, $oldserial, $newserial, $patientnumber");
			
	try{
		$connection->beginTransaction();
		$sql="delete from Wears where serialnum = ? and ? between start and end;";
		doQuery($connection, $sql, array($oldserial, $now) );
		
		$sql="delete from Period where start = ? and end = ?;";
		doQuery($connection, $sql, array($start, $end ));
		
		$sql="insert into Period values(?, ?);";	
		doQuery($connection, $sql, array($start, $now));
		
		$sql="insert into Period values(?, ?);";	
		doQuery($connection, $sql, array($now_plus, $end));
		
		$sql="insert into Wears values(?,?,?,?,?);";	
		doQuery($connection, $sql, array($now_plus, $end, $patientnumber, $newserial, $manuf));
		
		$sql="insert into Wears values(?,?,?,?,?);";
		doQuery($connection, $sql, array($start, $now, $patientnumber, $oldserial, $manuf));
			
		$connection->commit();
		
		echo("<p></p>Device successfully replaced.</p>");
		//header("Location: /ist189011/medibase.html")
		
	} catch(Exception $e){
		//Rollback the transaction.
		$connection->rollBack();
		echo("</br>".$e->getMessage());
	}
	echo("<form action='/ist189011/medibase.html'><input value='Go back' type='submit'/></form>");
	
?>
</body>
</html>




