<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../dbclass.php';
    include_once '../user.php';
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
	echo $db;
	echo 'wawaawaawaaa';
    // initialize object
    $user = new User($db);
    
    $stmt = $user->read();
    $num = $stmt->rowCount();
	echo 'wawawa' .$num;
    if($num>0){
		echo 'Leo be pory ahhh zany';
        // products array
        $user_arr=array();
        $user_arr["records"]=array();
     
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
     
            $user_item=array(
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "password" => $password,
                "adresse" => $adresse,
                "date creation" => $date_creation,
                "current token" => $current_token
            );
     
            array_push($user_arr["user"], $user_item);
        }
     
        // set response code - 200 OK
        http_response_code(200);
     
        // show products data in json format
        echo json_encode($user_arr);
    }else{
        // set response code - 404 Not found
        http_response_code(404);
     
        // tell the user no products found
        echo json_encode(
            array("message" => "No products found.")
        );
    }
     