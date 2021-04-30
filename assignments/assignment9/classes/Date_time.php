<?php
require_once "Pdo_methods.php";

class Date_time extends PdoMethods{

    /* CHECKS WHAT FUNCTIONS TO RUN BASED ON BUTTON PRESSED */
    public function checkSubmit(){
        if (isset($_POST["addnotes"])){//if addnotes button is pressed, function to add note is run
            return $this->addName();
        }
        if (isset($_POST["displaynotes"])){//if displaynotes button is pressed, function to check date range is run
            return $this->checkDate();
        } 
    }

    /* INSERTS NOTE WITH DATE/TIME INTO DATABASE */
    public function addName(){
        $pdo = new PdoMethods();

        /* SQL STATEMENT CREATED AND PARAMETERS BINDED */
        $sql = "INSERT INTO notes_info (note_timestamp, note_contents) VALUES (:ntime, :ncontents)";
            
        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
        $bindings = [
            [':ntime',strtotime($_POST["dateTime"]),'str'], //change time string into timestamp
            [':ncontents',$_POST["noteContents"],'str'],
        ];
        
        /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
        $result = $pdo->otherBinded($sql, $bindings);
        
        /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
        if($result === 'error'){
            return 'There was an error adding the note';
        }
        else {
            return 'Note has been added';
        }
    }

    /* SELECTS FROM DATABASE USING DATE RANGE AND PREPARES TO DISPLAY RESULTS */
    public function checkDate(){
        $pdo = new PdoMethods();

        /* SQL STATEMENT CREATED AND PARAMETERS BINDED */
        $sql = "SELECT * FROM notes_info WHERE note_timestamp >= :begdate AND note_timestamp <= :enddate ORDER BY note_timestamp ASC"; //selects all where the timestamp is greater than beginning date and less than end date and orders properly
            
        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
        $bindings = [
            [':begdate',strtotime($_POST["begDate"]),'str'], //beginning date's timestamp is binded to be used to compare
            [':enddate',strtotime($_POST["endDate"]),'str'], //end date's timestamp is binded to be used to compare
        ];
        
        /* I AM CALLING THE SELECTBINDED METHOD FROM MY PDO CLASS */
        $records = $pdo->selectBinded($sql, $bindings);

        if($records === 'error'){
            return 'There was an error finding the note';
        }
        else {
            if(count($records) != 0){//runs function to create table if records exists in database
                return $this->createTable($records);
            }
            else {//returns error message if no records in database
                return "<br>No notes found for the date range selected";
            }
        }
    }

    /* CREATES TABLE WITH MATCHED ROWS FROM DATABASE */
    public function createTable($records){
        $list = '<br><table class="table table-striped table-bordered"><thead><tr><th>Date and Time</th><th>Note</th></tr><thead><tbody>';//uses bootstrap classes for proper display
        foreach ($records as $row){
            $dateformat = date("n/d/Y g:i a", $row['note_timestamp']); //turns timestamp into human-readable string
            $list .= "<tr><td>{$dateformat}</td><td>{$row['note_contents']}</td></tr>"; //creates a row with date/time and note per match in database
        }
        $list .= '</tbody></table>'; //closes table
        return $list;
    }
}
?>