<?php

$encoding = "utf-8";
require ("functions.php");

$Date = Date;
$updated = date( 'Y-m-d H:i:s', strtotime($Date));
$room = "moflo";
$user = "111thisuser111";
$lat = "37.7913155";
$lon = "-122.3926051";


$query = sprintf("REPLACE somapus (updated, room, location, user) values (now(), '%s', GeomFromText('POINT($lat $lon)'), '%s')",
    mysql_real_escape_string($room),
    mysql_real_escape_string($user));

echo $query;
mysql_query($query);

?>