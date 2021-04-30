<?php
    $output = "";
    if(count($_POST) > 0){
        require_once 'fileUploadProc.php';
        $addFiles = new Files();
        $output = $addFiles->verifyFile();
       }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 7 File Upload Form</title>
  </head>
  <body>
    <main>
        <div class="container">
            <h1>File Upload</h1>
            <a href="links.php">Show File List</a>
            <p><?php echo $output ?></p>
            <form method="post" action="form.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="filenamefield">File Name</label>
                    <input type="text" class="form-control" id="filenamefield" name="filename">
                </div>
                <div class="form-group">
                    <label for="fileSelectField"></label>
                    <input type="file" name="fileSelectField" id="fileSelectField">
                </div>
                <button type="submit" class="btn btn-primary" name="submitbutton">Upload File</button>
            </form>
        </div>
    </main>
</body>
</html>