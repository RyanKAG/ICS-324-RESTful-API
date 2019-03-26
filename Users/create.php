<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once('../object/user.php');
include_once('../config/database.php');


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

//retrieve posted user data
$data = json_decode(file_get_contents('php://input'));

//check if data is not empty
if (
    !empty($data->FName) &&
    !empty($data->LName) &&
    !empty($data->Email) &&
    !empty($data->Hashed_pw) &&
    !empty($data->UserName) &&
    !empty($data->status_ID) &&
    !empty($data->Reg_Date) &&
    !empty($data->Type_ID)
) {
    $user->FName = $data->FName;
    $user->LName = $data->LName;
    $user->Hashed_pw = password_hash($data->Hashed_pw, PASSWORD_DEFAULT);;
    $user->UserName = $data->UserName;
    $user->Email = $data->Email;
    $user->Reg_Date = $data->Reg_Date;
    $user->type_ID = $data->Type_ID;
    $user->status_ID = $data->status_ID;

    if (!$user->isUser()) {
        if($user->create()){
        http_response_code(201);

        echo json_encode(array("message" => 'User has been registered'));
        }else {
            http_response_code(502);

            echo json_encode(array('Error' => 'in sql execution'));
        }
    } else {
        http_response_code(409);

        echo json_encode(array("message" => "User already exists!."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}