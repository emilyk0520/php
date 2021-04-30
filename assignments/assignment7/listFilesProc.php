<?php
require_once "Pdo_methods.php";

class Links extends PdoMethods{

    public function getData(){
        $pdo = new PdoMethods();

		//CREATE THE SQL
		$sql = "SELECT * FROM file_info";

		//PROCESS THE SQL AND GET THE RESULTS
        $records = $pdo->selectNotBinded($sql);

		//IF THERE WAS AN ERROR DISPLAY MESSAGE
		if($records == 'error'){
			return 'There has been an error processing your request';
        }
        
		else {
			if(count($records) != 0){//runs function to create list if records exists in database
				return $this->createList($records);
			}
			else {//returns empty string if no records in database
				return "";
			}
		}
        
    }

    public function createList($records){
        $list = '<ul>';
        foreach ($records as $row){//creates link per row in database with name as the user-input name and filepath in link
            $list .= "<li><a target='_blank' href='{$row['file_path']}'>{$row['file_name']}</a></li>";
        }
        $list .= '</ul>';
        return $list;
    }

}

?>

