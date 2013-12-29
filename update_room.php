<?php

$encoding = "utf-8";
require ("functions.php");
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