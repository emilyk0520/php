<?php
    require_once 'classes/Date_time.php';
    $dt = new Date_time();
    $notes = $dt->checkSubmit();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 9 Display Note</title>
  </head>
  <body>
    <main>
        <div class="container">
            <h1>Display Note</h1>
            <a href="addNote.php">Add Note</a>
            <form method="post" action="displayNote.php">
                <div class="form-group">
                    <label for="begDate">Beginning Date</label>
                    <input type="date" class="form-control" id="begDate" name="begDate">
                </div>
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
                <button type="submit" class="btn btn-primary" name="displaynotes">Get Notes</button>
            </form>
            <div>
            <?php
                echo $notes;
            ?>
            </div>
        </div>
    </main>
</body>
</html>