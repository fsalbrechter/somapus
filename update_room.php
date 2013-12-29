<?php

$db = mysql_connect("localhost", "wgenstar_somapus", "3SqIawG3OFamTs9Gj");
mysql_select_db ("wgenstar_somapus", $db); 

$encoding = "utf-8";


$room = "moflo";
$user = $_GET["userId"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];

$query = sprintf("REPLACE somapus (updated, room, location, user) values (now(), '%s', GeomFromText('POINT($lat $lng)'), '%s')",
    mysql_real_escape_string($room),
    mysql_real_escape_string($user));

echo $query;
mysql_query($query);

?>