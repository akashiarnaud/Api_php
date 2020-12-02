<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Credentials: true");
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"));

    // query to read single record
    $query = "SELECT * FROM user WHERE email = ?";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $data->current_token);
 
    // execute query
    $stmt->execute();
?>