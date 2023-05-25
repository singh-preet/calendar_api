<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING  & ~E_DEPRECATED);

include_once("./db.php");
$DB = new Database();
$DB->setQuery("SELECT * FROM tbl_events");
$result = $DB->loadResultList();
$DB->close_connection();
echo returnJson($result);


function returnJson($data)
{
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($data);
}
