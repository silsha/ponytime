<?php
header('Content-Type: application/json');
mysql_connect("localhost", "ponytime", "PASSWORD") or die ("Fehler 1337: Keine Verbindung zur Datenbank möglich.");
mysql_select_db("ponytime") or die ("Fehler 2342: DB-Fehler.");

$swlat = $_GET['swlat'];
$swlng = $_GET['swlng'];
$nelat = $_GET['nelat'];
$nelng = $_GET['nelng'];


if(isset($swlat, $swlng, $nelat, $swlng)){
    $qry = mysql_query("SELECT * FROM places WHERE lat > $swlat AND lat < $nelat AND log < $nelng AND log > $swlng");
}else{
    $qry = mysql_query("SELECT * FROM places");
}
while($row = mysql_fetch_object($qry))
{
	$json[$row->id]['name'] = $row->name;
	$json[$row->id]['lat']	= $row->lat;
	$json[$row->id]['lng']	= $row->log;
	$json[$row->id]['url']	= $row->url;
}
print json_encode($json);
?>