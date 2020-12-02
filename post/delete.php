<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../dbclass.php';
    include_once '../post.php';
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
    // initialize object
    $post = new Post($db);

    // get product id
    $data = json_decode(file_get_contents("php://input"));
    
    // set product id to be deleted
    $post->id = $data->id;
    
    // delete the product
    if($post->delete()){
    
        // set response code - 200 ok
        http_response_code(200);
    
        // tell the post
        echo json_encode(array("message" => "post was deleted."));
    }
    
    // if unable to delete the product
    else{
    
        // set response code - 503 service unavailable
        http_response_code(503);
    
        // tell the post
        echo json_encode(array("message" => "Unable to delete post."));
    }
?>