<?php
include '../polymorphism.php';
class Database extends Goat
{
    //declare tag variable para sa database
    protected $con;
    private $sn="localhost";
    private $un="root";
    private $pw="";
    private $dbn="lategamer";
//himo tag another funct. para sa dbconn
    public function dbcon(){


     $this->con = new mysqli($this->sn,$this->un,$this->pw);
     $this->con->query("CREATE DATABASE IF NOT EXISTS $this->dbn");
     $this->con = new mysqli($this->sn,$this->un,$this->pw,$this->dbn);
    }

    function kungError(){

    return $this->con->error;

    }

}
?>
