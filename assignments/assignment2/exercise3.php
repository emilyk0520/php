<?php 

//creates empty arrays to be filled
$rowNumbers = [];
$cellNumbers = [];

//adds the 15 rows
for ($i=1; $i<=15; $i++){
    array_push($rowNumbers,$i);
}

//adds the 5 columns
for ($j=1; $j<=5; $j++){
    array_push($cellNumbers, $j);
}

//creates opening table tag with necessary attribute to view borders
$html = "<table border='1'>";

//concatenates row for each element in row array and then a cell for each element in the column array with the variable names
foreach($rowNumbers as $row){
    $html .= "<tr>";
    foreach($cellNumbers as $cell){
        $html .= "<td>Row $row Cell $cell</td>";
    }
    $html .= "</tr>";
}

//creates ending table tag
$html .= "</table>";

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Exercise 3</title>
  </head>
  <body>

    <?php 
    
    echo $html;
    
    ?>


  </body>
</html>