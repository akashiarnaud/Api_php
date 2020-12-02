<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../dbclass.php';
    include_once '../logement.php';
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
    // initialize object
    $logement = new Logement($db);

    $data = json_decode(file_get_contents("php://input"));
    // set product property values
    $logement->numero = $data->firstname;
    $logement->rue = $data->rue;
    $logement->ville = $data->ville;
    $logement->code_postal = $data->code_postal;
    $logement->date_creation = $data->date_creation;
    
    // update the product
    if($logement->update()){
    
        // set response code - 200 ok
        http_response_code(200);
    
        // tell the logement
        echo json_encode(array("message" => "Product was updated."));
    }
    
    // if unable to update the product, tell the logement
    else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the logement
        echo json_encode(array("message" => "Unable to update product."));
    }
?>