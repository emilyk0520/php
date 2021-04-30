<?php
require_once "../classes/Pdo_methods.php";

/*DELETING ALL ROWS FROM TABLE*/
$pdo = new PdoMethods();
$sql = "TRUNCATE TABLE names;"; //create the sql statement that preserves table but deletes all data 
$result = $pdo->otherNotBinded($sql); //calling otherNotBinded method from pdo class 

/*DISPLAYING MESSAGE*/
$response = (object)[
    'masterstatus'=>'success',
    'msg'=>'All names were deleted'
];
echo json_encode($response);
?>