
<?php
class dbconn {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect() {
        $this->servername = "localhost";
        $this->username = "newuser";
        $this->password = "password";
        $this->dbname = "budgety";

        //to return the db connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname)or die(mysqli_connect_error());
        return $conn;
    }
}
?>