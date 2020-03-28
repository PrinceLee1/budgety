<?php
include "incomeDB.php";
class dbconn{
    public function insert($tab, $col, $val) {
        $sql = "INSERT INTO $tab ($col) VALUES($val)";
        $result = $this->connect()->query($sql);
        return $result ? true : false;
    }
}


?>