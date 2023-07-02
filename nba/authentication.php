<?php
include "nba1.php";
header('WWW-Authenticate: Basic realm="My Private Area"');
header('HTTP/1.0 401 Unauthorized');
header('Content-type: application/json; charset=UTF-8');

$n = new nba();

$n->createtable();
echo $n->authentication();
?>