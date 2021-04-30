<?php
require_once "../classes/Pdo_methods.php";

$list = "";//holds list of names to display
$pdo = new PdoMethods();
$sql = "SELECT * FROM names ORDER BY name ASC;";//CREATES THE SQL (IN ALPHABETICAL ORDER)
$records = $pdo->selectNotBinded($sql);//PROCESS THE SQL AND GET THE RESULTS


if($records == 'error'){
	return 'There has been an error processing your request';
}
        
else {//if no errors retrieving data
    if(count($records) != 0){//creates list if records exists in database
        foreach ($records as $row){//adds each name surrounded by paragraph tags to the list to display
            $list .= "<p>{$row['name']}</p>";
        }

        /*DISPLAYING LIST OF NAMES*/
        $response = (object)[
            'masterstatus'=>'success',
            'names'=>$list
        ];
        echo json_encode($response);
    }
            
    else {//returns empty string if no records in database
        
        /*DISPLAYS EMPTY STRING*/
        $response = (object)[
            'masterstatus'=>'error',
            'msg'=>""
        ];
        echo json_encode($response);
	}
}

?>