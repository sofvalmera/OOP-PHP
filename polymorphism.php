<?php
header("Content-Type: application/json; charset=utf-8");
abstract class Goat {
    
abstract function dbcon();

}

interface crocodile {

    public function createtable();
    public function create($params);
    public function read();
    public function update($params);
    public function delete($params);

}
?>