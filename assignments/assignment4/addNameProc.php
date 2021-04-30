<?php

class AddNamesProc {

    private $finalDisplay; //variable holding final display of names
    private $nameList=[]; //array that holds all names 
    private $name; //variable holding each name in proper format

    public function addClearNames(){//if Add Names button is pressed, runs addNames function
        if (isset($_POST["addNamesBtn"])){
            return $this->addNames();
        }
        else if (isset($_POST["clearNameBtn"])){// if Clear Names button is pressed, runs clearNames function
            return $this->clearNames();
        }
    }

    public function addNames(){
        $holdingArray = explode(" ", $_POST["name"]);
        $this->name = $holdingArray[1].", ".$holdingArray[0]; //puts in proper format
        $this->nameList = explode ("\n", $_POST["namelist"]); //gets names in text message box and puts in array
        array_push($this->nameList, $this->name); //add on to array that contains list of names in text message box
        sort($this->nameList); //sorts array containing all names alphabetically
        $this->finalDisplay = implode ("\n", $this->nameList); //holds a long string of names separated by line breaks
        return $this->finalDisplay;
    }
    
    public function clearNames(){
        $this->finalDisplay = "";//clears variable
        return $this->finalDisplay;
    }

}


?>