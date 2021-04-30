<?php
require_once "Pdo_methods.php";
class Files extends PdoMethods{

    public function verifyFile(){//function that checks file type and size before allowing file to be added
        if (isset($_POST["submitbutton"])){//if submit button is pressed
            if ($_FILES["fileSelectField"]["type"] != "application/pdf"){//checks file type
                return "File must be a pdf file";
            }
            else if ($_FILES["fileSelectField"]["size"] > 100000){//checks file size
                return "File is too big";
            }
            else {//runs function to add file if no problems
                return $this->addFile();
            }
        }
    }

    public function addFile(){
        $filename = $_POST["filename"]; //gets file name that user inputs
            if (move_uploaded_file($_FILES["fileSelectField"]["tmp_name"], "files/{$filename}.pdf")){//moves file from temp storage into files directory with user-inputed name
                $filepath = "files/{$filename}.pdf";
                return $this->insertDb($filepath);
            }

            else{//returns error if problem 
                echo "There was a problem";
            }
    }

    public function insertDb($filepath){//inserts filename and path to database
        $pdo = new PdoMethods();

        /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
        $sql = "INSERT INTO file_info (file_name, file_path) VALUES (:fname, :fpath)";
            
        /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
        $bindings = [
            [':fname',$_POST['filename'],'str'],
            [':fpath',$filepath,'str'],
        ];
        
        /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
        $result = $pdo->otherBinded($sql, $bindings);
        
        /* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
        if($result === 'error'){
            return 'There was an error adding the file';
        }
        else {
            return 'File has been added';
        }
    }

}

?>

