<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../dbclass.php';
 
// instantiate product object
include_once '../logement.php';
 
$database = new Database();
$db = $database->getConnection();
 
$logement = new Logement($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->numero) &&
    !empty($data->rue) &&
    !empty($data->ville) &&
    !empty($data->code_postal) &&
    !empty($data->date_creation)
){
 
    // set product property values
    $logement->numero = $data->numero;
    $logement->rue = $data->rue;
    $logement->ville = $data->ville;
    $logement->code_postal = $data->code_postal;
    $logement->date_creation = date('Y-m-d H:i:s');
 
    // create the product
    if($logement->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Logement was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create logement."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create logement. Data is incomplete."));
}
?>