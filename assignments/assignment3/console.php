<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <title>Assignment 3 Console</title>
  </head>
  <body>
    <?php
        require_once "Calculator.php";
        $Calculator = new Calculator();
        echo $Calculator->calc("/", 10, 0);
        echo $Calculator->calc("*", 10, 2);
        echo $Calculator->calc("/", 10, 2);
        echo $Calculator->calc("-", 10, 2);
        echo $Calculator->calc("+", 10, 2);
        echo $Calculator->calc("*", 10);
        echo $Calculator->calc(10);
    ?>

  </body>
</html>