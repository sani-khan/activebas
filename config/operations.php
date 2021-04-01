<?php 
    require_once('dbconfig.php');
    $db = new dbconfig();

    class operations extends dbconfig
    {
        

      // Insert Record in the Database    
        function insert_record($participant_obj)
        {
            global $db;
            $employeeName=$participant_obj['employee_name'];
            $employeeMail=$participant_obj['employee_mail'];
            $participationFee=$participant_obj['participation_fee'];
            $eventId=$participant_obj['event_id'];
            $eventName=$participant_obj['event_name'];
            $eventDate=$participant_obj['event_date'];
            $version='';
            if(isset($participant_obj['version'])){
                $version=$participant_obj['version'];
            }
            $query = "insert into participation (employee_name,employee_mail,participation_fee,event_id,event_name,event_date,version) values('".$employeeName."','".$employeeMail."','".$participationFee."',".$eventId.",'".$eventName."','".$eventDate."','".$version."')";
            $result = mysqli_query($db->connection,$query);

            if($result)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

       // View Database Record
        public function view_record()
        {
            global $db;
            $query = "select * from participation";
            $result1 = mysqli_query($db->connection,$query);
            $result = array();
            if (mysqli_num_rows($result1) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result1)) {
                    array_push($result,$row);
                }
              } else {
                echo "0 results";
              }
            return $result;
        }
        // View Database Record for filter dates
        public function Get_filter_data_by_date($type,$fromdate,$todate)
        {
            global $db;
            $query = "SELECT * FROM `participation` WHERE event_date >= '".$fromdate."' AND event_date <= '".$todate."'";
             $result1 = mysqli_query($db->connection,$query);
            $result = array();
            if (mysqli_num_rows($result1) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result1)) {
                    array_push($result,$row);
                }
              } else {
                echo "0 results";
              }
            return $result;
        }
        // View Database Record for filter Event name and Employee name
        public function Get_filter_data_by_text($type,$text)
        {
            global $db;
            $query = "select * from participation Where ".$type." LIKE '".$text."%'";
            $result1 = mysqli_query($db->connection,$query);
            $result = array();
            if (mysqli_num_rows($result1) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result1)) {
                    array_push($result,$row);
                }
              } else {
                echo "0 results";
              }
            return $result;
        }




     }
?>