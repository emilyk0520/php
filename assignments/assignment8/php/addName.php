<?php

require_once "../classes/Pdo_methods.php";

$data = json_decode($_POST["data"]);

/*PUTTING NAMES INTO PROPER FORMAT*/
$holdingArray = explode(" ", $data->name);
$names = $holdingArray[1].", ".$holdingArray[0]; 


/*ADDING TO THE DATABASE*/
$pdo = new PdoMethods();
$sql = "INSERT INTO names (name) VALUES (:name)"; // CREATE THE SQL STATEMENT AND BINDING THE PARAMETERS
$bindings = [ // THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS
    [':name',$names,'str'],
];
$result = $pdo->otherBinded($sql, $bindings);// CALLING THE OTHERBINDED METHOD FROM PDO CLASS

/*DISPLAYING MESSAGE*/
$response = (object)[
	'masterstatus'=>'success',
	'msg'=>'Name has been added'
];
echo json_encode($response);

?>