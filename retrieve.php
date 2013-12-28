<?

$encoding = "utf-8";
require ("functions.php");
$room = "abc";
SELECT firstname, lastname, address, age FROM friends WHERE room = 

$query = sprintf("SELECT firstname, lastname, address, age FROM friends 
	    WHERE firstname='%s' AND lastname='%s'",
	    mysql_real_escape_string($firstname),
	    mysql_real_escape_string($lastname));
$sql = "insert replace into somapus (updated, room, location, user) values ()";	
mysql_query($sql);





?>