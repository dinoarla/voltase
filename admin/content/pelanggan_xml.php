<?php

$username = "root";
$password = "";
$database = "db_solipad";

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection = mysql_connect('localhost', $username, $password);
if (!$connection) {
    die('Not connected : ' . mysql_error());
}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
    die('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM tbl_dil WHERE 1";
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)) {
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id", $result['id_dil']);
    $newnode->setAttribute("idplg", $row['id_pel']);
    $newnode->setAttribute("namaplg", $row['nama']);

    $newnode->setAttribute("ulpplg", $row['ulp']);
    $newnode->setAttribute("dayaplg", $row['daya_final']);
    $newnode->setAttribute("tarifplg", $row['tarif_final']);

    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
}

echo $dom->saveXML();
