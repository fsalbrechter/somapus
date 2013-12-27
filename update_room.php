<?

$encoding = "utf-8";
require ("functions.php");

$Date = Date;
$updated = date( 'Y-m-d H:i:s', strtotime($Date));
$room = "moflo";
$user = "111thisuser111";
$lat = "37.7913155";
$lon = "-122.3926051";

$sql = "replace into somapus (updated, room, location, user) values (now(), '$room', GeomFromText('POINT($lat $lon)'), '$user')";
echo $sql;
mysql_query($sql);


?>