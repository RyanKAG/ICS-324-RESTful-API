<?php
/**
 * User: Alghraybi
 * Date: 2019-03-21
 * Time: 12:57
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/database.php');
include_once('../object/user.php');

$database = new Database();
$db = $database->getConnection();

//instatiating the user object
$user = new User($db);

$data = json_decode(file_get_contents('php://input'));

if (
    !empty($data->UserName) ||
    !empty($data->Email) &&
    !empty($data->password)
) {
    $user->UserName = $data->UserName;
    $user->Email = $data->Email;

    if ($user->isUser()) {
        if ($user->login($data->password)) {
            http_response_code(303);

            echo json_encode(array('message' => 'Login was successful'));

            $db = null;
            $user->nullifyConnection();
        } else {
            http_response_code(422);

            echo json_encode(array('message' => 'invalid password'));

            $db = null;
            $user->nullifyConnection();
        }
    } else {
        http_response_code(401);

        echo json_encode(array("message" => "could not find the user"));

        $db = null;
        $user->nullifyConnection();
    }
}else{
    echo json_encode(array('message'=> 'empty input'));

    $user->nullifyConnection();
    $db = null;
}
