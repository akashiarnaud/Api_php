<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../dbclass.php';
    include_once '../logement.php';
    
    // instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();
    // initialize object
    $logement = new Logement($db);
    
    $stmt = $logement->read();
    $num = $stmt->rowCount();

    if($num>0){
 
        // products array
        $logement_arr=array();
        $logement_arr["records"]=array();
     
        // retrieve our table contents
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
     
            $logement_item=array(
                "numero" => $numero,
                "rue" => $rue,
                "ville" => $ville,
                "code_postal" => $code_postal,
                "date creation" => $date_creation
            );
     
            array_push($logement_arr["logement"], $logement_item);
        }
     
        // set response code - 200 OK
        http_response_code(200);
     
        // show products data in json format
        echo json_encode($logement_arr);
    }else{
        // set response code - 404 Not found
        http_response_code(404);
     
        // tell the logement no products found
        echo json_encode(
            array("message" => "No products found.")
        );
    }
     