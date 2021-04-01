<?php 

include('dbconnectioninfo.php');
    require_once('operations.php');

    class dbconfig
    {
        public $connection;

        public function __construct()
        {
            $this->db_connect();
        }
       
        public function db_connect()
        {
            
            global $Db_server;
            global $Db_user;
            global $Db_pass;
            global $Db_name;
            //connectng to DB Server
            $conn=mysqli_connect($Db_server,$Db_user,$Db_pass);
            //checking database existence.
            if (!mysqli_select_db($conn,$Db_name)){
                //creating Database
                $sql = "CREATE DATABASE ".$Db_name;
                if ($conn->query($sql) === TRUE) {
                    //Database created successfully"
                }else {
                    echo "Error creating database: " . $conn->error;
                }
            }
            // Connecting to Database
            $this->connection = mysqli_connect($Db_server,$Db_user,$Db_pass,$Db_name);
           //Creating Table If not Exist
           $query = "CREATE TABLE IF NOT EXISTS `participation` (
                `participation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `employee_name` varchar(100) NOT NULL,
                `employee_mail` varchar(50) NOT NULL,
                `participation_fee` varchar(50) NOT NULL,
                `event_id` int(11) NOT NULL,
                `event_name` varchar(255) NOT NULL,
                `event_date` date NOT NULL,
                `version` varchar(50) DEFAULT NULL,
              PRIMARY KEY (`participation_id`), UNIQUE KEY `participant_email` (`employee_mail`,`event_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            $result = mysqli_query($this->connection,$query);
            
            if(mysqli_connect_error())
            {
                die(" Connect Failed ");
            }
        }
    }
?>