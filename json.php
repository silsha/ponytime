<?php
header('Content-Type: application/json');
mysql_connect("localhost", "ponytime", "PASSWORD") or die ("Fehler 1337: Keine Verbindung zur Datenbank möglich.");
mysql_select_db("ponytime") or die ("Fehler 2342: DB-Fehler.");

$qry = mysql_query("SELECT * FROM places");
while($row = mysql_fetch_object($qry))
{
	$json[$row->id]['name'] = $row->name;
	$json[$row->id]['lat']	= $row->lat;
	$json[$row->id]['lng']	= $row->log;
	$json[$row->id]['url']	= $row->url;
}


$jsonen = json_encode($json);

echo $jsonen;

//var_dump ($jsonen);

//var_dump(json_decode($jsonen, true));

?>
