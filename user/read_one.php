<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../dbclass.php';
include_once '../user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare product object
$user = new User($db);
 
// set ID property of record to read
$user->id = isset($_GET['token']) ? $_GET['token'] : die();
 echo 'ici';
// read the details of product to be edited
$user->readOne();
 
if($user->email!=null){
    // create array
    $user_arr = array(
        "id" => $user->id,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
        "email" => $user->email,
        "password" => $user->password,
        "adresse" => $user->adresse,
        "date creation" => $user->date_creation,
        "current token" => $user->current_token
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($user_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "User does not exist."));
}
?>