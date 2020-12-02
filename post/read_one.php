<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../dbclass.php';
include_once '../post.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$post = new Post($db);
 
// set ID property of record to read
$post->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$post->readOne();
 
if($post->numero!=null){
    // create array
    $post_arr = array(
        "date_post" => $post->date_post,
        "contenue" => $post->contenue
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($post_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the post product does not exist
    echo json_encode(array("message" => "post does not exist."));
}
?>