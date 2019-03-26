<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 3/26/2019
 * Time: 8:39 PM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../object/user.php';

$database = new Database();
$db=$database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents('php://input'));

if(!empty($data->UserName)){
    $user->UserName = $data->UserName;
    if($user->logout()){
        http_response_code(200);

        echo json_encode("");

        $user->nullifyConnection();
        $db = null;
    }else{
        http_response_code(400);

        json_encode(array('Error' => 'incorrect json'));

        $user->nullifyConnection();
        $db = null;
    }
}else{
    http_response_code();
}