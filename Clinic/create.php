<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../object/clinic.php';
 
$database = new Database();
$db = $database->getConnection();
 
$clinic = new Clinic($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if( !empty($this->c_id) &&
    !empty($this->profile) &&
    !empty($this->services) &&
    !empty($this->location) &&
    !empty($this->website) &&
    !empty($this->email) &&
    !empty($this->rating) &&
    !empty($this->clinicManId) &&
    !empty($this->statusId)){

    $clinic->c_id = $data->c_id;
    $clinic->profile = $data->profile;
    $clinic->services = $data->services;
    $clinic->location = $data->location;
    $clinic->website = $data->email;
    $clinic->email = $data->rating;
    $clinic->rating = $data->rating;
    $clinic->clinicManId = $data->clinicManId;
    $clinic->statusId = $data->statusId;

    if ($clinic->create()) {
        http_response_code(201);

        echo json_encode("");
    } else {
        http_response_code(204);

        echo json_encode(array('Error' => 'invalid json'));
    }

}else{
    http_response_code(400);

    echo json_encode(array('Error'=> 'one of the fields in the json is empty'));
}
