<?php
include 'nba1.php';
header("Content-Type: application/json; charset=utf-8");
$user=new nba();
$user->createtable();
echo $user->read($_GET);
?>