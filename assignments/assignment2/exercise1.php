<?php

//creates two lists of numbers
$mainListNumbers = [1,2,3,4,5];

$subListNumbers = [1,2,3,4,5,6];

//variable that holds opening ul tag of main list
$html = "<ul>";

//concatenates li element for each number in first list and then nest li elements of second list
foreach($mainListNumbers as $i){
    $html .= "<li>$i<ul>";
    foreach($subListNumbers as $j){
        $html .= "<li>$j</li>";
    }
    $html .= "</ul></li>";
}

//concatenates closing ul tag of main list
$html .= "</ul>";

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Exercise 1</title>
  </head>
  <body>

        <?php 
        
        echo $html;
        
        ?>

  </body>
</html>