<?php
    if(count($_POST) >= 0){
        require_once 'addNameProc.php';
        $addName = new AddNamesProc();
        $output = $addName->addClearNames();
       }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Assignment 4 Form</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>Add Names</h1>
            <form method="post" action="nameform.php">
                <button type="submit" class="btn btn-primary" name="addNamesBtn">Add Name</button>
                <button type="submit" class="btn btn-primary" name="clearNameBtn">Clear Names</button>
                <div class="form-group">
                    <label for="namefield">Enter Name</label>
                    <input type="text" class="form-control" id="namefield" name="name">
                </div>
                <div class="form-group">
                    <label for="nameList">List of Names</label>
                    <textarea style="height: 500px;" type="password" class="form-control" id="namelist" name="namelist"><?php echo $output;?></textarea>
                </div>
            </form>
        </div>
        
    </main>
    
</body>
</html>