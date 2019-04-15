<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/13/2019
 * Time: 9:31 PM
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

$appointment->apm_id = $_GET['id'];

if($appointment->apm_id != null)
if($appointment->delete())
    http_response_code(200);
else
    http_response_code(404);
else
    http_response_code(204);