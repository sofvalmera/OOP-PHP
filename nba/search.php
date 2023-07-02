<?php
include 'nba1.php';
header("Content-Type: application/json; charset=utf-8");
$u=new nba();
$u->createTable();
echo $u->search($_GET);

?>