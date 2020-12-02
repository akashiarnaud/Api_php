<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
// get database connection
	include_once '../dbclass.php';
	 
	// instantiate product object
	include_once '../user.php';
	include_once '../relation_user.php';
	$database = new Database();
	$db = $database->getConnection();
	$data = json_decode(file_get_contents("php://input"));
	echo $data
	$user = new User($db);
	$rel_user = new Relation_user($db);
	$test = $user->get_user_by_token('test');
	$someArray = json_decode($test, true);
	$id_user = $someArray['id'];
	//echo $data->id;
	$id_ami = $data->id;
	$rel_user->id_user = $id_user;
	$rel_user->id_ami = $data->id;
	$rel_user->date_ajout = date('Y-m-d');
	
	if($user->add_friend()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "User ".$id_user."add ".$id_ami));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to add friend."));
    }
 ?>
	 