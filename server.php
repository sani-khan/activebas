<?php
require_once('./config/operations.php');
$db = new operations();
// filter request 
if(isset($_REQUEST["type"])){
    $type=$_REQUEST["type"];
    if($type=="all"){
        //get all records from database
        $result=$db->view_record();
        print_r(json_encode($result));
    }
    else if($type=="date"){
        $fromdate = $_REQUEST["fromdate"];
        $todate = $_REQUEST["todate"];
        
        //get date filter records from database
        print_r(json_encode($db->Get_filter_data_by_date($type,$fromdate,$todate)));
    }
    else{
        
        $text =$_REQUEST["text"];
        
        //get event name and wemployee name filter records from database
        print_r(json_encode($db->Get_filter_data_by_text($type,$text)));
    }
}


?>