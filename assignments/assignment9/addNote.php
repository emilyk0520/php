<?php
    require_once 'classes/Date_time.php';
    $dt = new Date_time();
    $msg = $dt->checkSubmit();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 9 Add Note</title>
  </head>
  <body>
    <main>
        <div class="container">
            <h1>Add Note</h1>
            <a href="displayNote.php">Display Notes</a>
            <form method="post" action="addNote.php">
                <div class="form-group">
                    <?php 
                        echo $msg;
                    ?>
                </div>
                <div class="form-group">
                    <label for="dateTime">Date and Time</label>
                    <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
                </div>
                <div class="form-group">
                    <label for="noteContents">Note</label>
                    <textarea style="height: 300px;" type="password" class="form-control" id="noteContents" name="noteContents"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="addnotes">Add Note</button>
            </form>
        </div>
    </main>
</body>
</html>