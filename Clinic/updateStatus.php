<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/6/2019
 * Time: 1:13 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../config/database.php');
include_once('../object/clinic.php');

$database = new Database();
$db = $database->getConnection();

$clinic = new Clinic($db);


$data = json_decode(file_get_contents('php://input'));

if (
    !empty($data->c_id) &&
    !empty($data->statusId)
)
{
 $clinic ->c_id = $data->c_id;
 $clinic->statusId = $data->statusId;

 if($clinic->isClinic()){
     if($clinic->updateStatus()){

     }
 }
}