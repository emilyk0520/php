<?php

class Directories {

    public function submit(){
        if (isset($_POST["submitbutton"])){//if submit button is pressed
            $foldername = $_POST["foldername"]; //gets folder name that user inputs

            if (!glob("directories/{$foldername}")){ //if no directories with same name can be found make directory
                return $this->createDirectories();
            }
                
            else if (glob("directories/{$foldername}")){//if directory with same name is found send error message
                return $this->duplicateError();
            }
        }
    }

    public function createDirectories(){ //creates directory
        $foldername = $_POST["foldername"]; //gets folder name that user inputs
        $filecontents = $_POST["filecontents"]; //gets file contents from user input as a string

        $success = mkdir ("directories/{$foldername}"); //makes directory with provided folder name

            if ($success){//if directory is created successfully

                chmod ("directories/{$foldername}", 0777); //changes permissions to 777 just in case
                file_put_contents("directories/{$foldername}/readme.txt", $filecontents); //inside folder, creates readme.txt file with file contents 

                $string = <<<HTML
                <p>File and directory where created</p>
                <a href = 'directories/{$foldername}/readme.txt'>Path were file is located</a>
HTML;
                return $string;//contains HTML with success message and link to associated readme file
            }

            else {//if error when making directory
                $string = <<<HTML
                <p>Something went wrong! Directory or file cannot be created!</p>
HTML;
                return $string;//contains error message

            }
    }

    public function duplicateError(){ //creates error message
        $string = <<<HTML
        <p>A directory already exists with that name.</p>
HTML;
        return $string;//contains error message warning duplicate name
    }    
}

?>

