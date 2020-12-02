<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../dbclass.php';
    include_once '../post.php';
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
    // initialize object
    $post = new Post($db);
    
    $stmt = $post->get_user_post();
    $num = $stmt->rowCount();
    if($num>0){
 
        // products array
        $post_arr=array();
        $post_arr["records"]=array();
     
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
     
            $post_item=array(
                "date_post" => $date_post,
                "contenue" => $contenue,
            );
     
            array_push($post_arr["post"], $post_item);
        }
     
        // set response code - 200 OK
        http_response_code(200);
     
        // show products data in json format
        echo json_encode($post_arr);
    }else{
        // set response code - 404 Not found
        http_response_code(404);
     
        // tell the post no products found
        echo json_encode(
            array("message" => "No products found.")
        );
    }
     