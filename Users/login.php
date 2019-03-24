<?php
/**
 * User: Alghraybi
 * Date: 2019-03-21
 * Time: 12:57
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../config/database.php');
include_once('../object/user.php');

$database = new Database();
$db = $database->getConnection();

//instatiating the user object
$user = new User($db);

$data = json_decode(file_get_contents('php://input'));
echo "1";

if (
    !epmty($data->UserName) ||
    !epmty($data->Email) &&
    !epmty($data->password)
) {
    echo "1";
    $user->UserName = $data->UserName;
    $user->Email = $data->Email;
    echo "1";
    if ($user->isUser()) {
        if ($user->login($data->password)) {
            http_response_code(303);
            echo json_encode(array('message' => 'Login was successful'));
        } else {
            http_response_code(422);
            echo json_encode(array('message' => 'invalid password'));
        }
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "could not find the user"));
    }
}
