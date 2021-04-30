<?php
    require_once 'listFilesProc.php';
    $listFiles = new Links();
    $output = $listFiles->getData();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 7 File List</title>
  </head>
  <body>
    <main>
        <div class="container">
            <h1>List Files</h1>
            <a href="form.php">Add File</a>
            <?php 
                echo $output;
            ?>
        </div>
    </main>
</body>
</html>