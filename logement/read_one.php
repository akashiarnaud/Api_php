<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../dbclass.php';
include_once '../logement.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$logement = new Logement($db);
 
// set ID property of record to read
$logement->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$logement->readOne();
 
if($logement->numero!=null){
    // create array
    $logement_arr = array(
        "numero" => $logement->numero,
        "rue" => $logement->rue,
        "ville" => $logement->ville,
        "code_postal" => $logement->code_postal,
        "date creation" => $logement->date_creation
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($logement_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the logement product does not exist
    echo json_encode(array("message" => "logement does not exist."));
}
?>