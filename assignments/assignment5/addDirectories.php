<?php
    $output = "";
    if(count($_POST) > 0){
        require_once 'Directories.php';
        $addDirectory = new Directories();
        $output = $addDirectory->submit();
       }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 5 Form</title>
  </head>
  <body>
    <main>
        <div class="container">
            <h1>File and Directory Assignment</h1>
            <form method="post" action="addDirectories.php">
                <div class="form-group">
                    <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>
                    <?php 
                        echo $output;
                    ?>
                </div>
                <div class="form-group">
                    <label for="foldernamefield">Folder Name</label>
                    <input type="text" class="form-control" id="foldernamefield" name="foldername">
                </div>
                <div class="form-group">
                    <label for="fileContents">File Contents</label>
                    <textarea style="height: 150px;" type="password" class="form-control" id="fileContents" name="filecontents"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submitbutton">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>