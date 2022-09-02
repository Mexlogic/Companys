<?php 
class connection {
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $database = "usercustomer";

    public $con = null;

    public function __construct() {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($this->con->connect_error){
            echo "Connection failed". $this->connect_error;
        }
    }

    public function getConnection() {
        return $this->con;
    }
}
?>