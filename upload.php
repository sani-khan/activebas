<?php 
require_once('./config/dbconfig.php');
$db = new operations();
//uploading Json file into Datebase
if (isset($_FILES['fileToUpload'])){

    $file = $_FILES['fileToUpload']['tmp_name'];


    $data = file_get_contents($file);

    $array = json_decode($data, true );
  
    foreach( $array as $row){
            $db->insert_record($row);
    }

}
    
?>