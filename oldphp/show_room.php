<?php
$encoding = "utf-8";

$db = mysql_connect("localhost", "wgenstar_somapus", "3SqIawG3OFamTs9Gj");
mysql_select_db ("wgenstar_somapus", $db); 

$room = "moflo";

$query = sprintf("SELECT updated, room, X(location), Y(location), user FROM somapus WHERE room = '%s'", mysql_real_escape_string($room));
$result = mysql_query($query);

$resultJson = array();
while($row = mysql_fetch_array($result))
{
  $resultJson[$row['user']] = array("X" => $row['X(location)'], "Y" => $row['Y(location)']);
}
echo json_encode($resultJson);
mysql_close($db);
?>