<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/4/2019
 * Time: 1:06 AM
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

if (
    !empty($data->date_time) &&
    !empty($data->type) &&
    !empty($data->patientId) &&
    !empty($data->dentistId)
) {
    $appointment->apm_date =date('Y-m-d H:i:s', strtotime($data->date_time));
    $appointment->apm_type =$data->type;
    $appointment->patient_id =$data->patientId;
    $appointment->dentist_id = $data->dentistId;

    if($appointment->create())
        http_response_code(201);
    else
        http_response_code(409);
}else
    http_response_code(204);