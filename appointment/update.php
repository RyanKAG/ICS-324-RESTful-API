<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/16/2019
 * Time: 12:36 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../object/appointment.php');
include_once('../config/database.php');

$database = new Database();
$db = $database->getConnection();

$appointment = new Appointment($db);

$data = json_decode(file_get_contents('php://input'));
if(!empty($data->id) && !empty($data->rid)){
    $appointment->apm_date =!empty($data->date_time) ? date('Y-m-d H:i:s', strtotime($data->date_time)) : null;
    $appointment->apm_id = $data->id;
    $appointment->recept_id = $data->rid;
    $appointment->apm_type = !empty($data->type) ? $data->type : null;
    $appointment->dentist_id = !empty($data->dentistId) ? $data->dentistId : null;

    if($appointment->update())
        http_response_code(201);
    else
        http_response_code(409);
}else
http_response_code(204);