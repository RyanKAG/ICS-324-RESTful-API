<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/2/2019
 * Time: 1:59 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../object/appointment.php';
$database = new Database();
$db = $database->getConnection();
//init object
$appointment = new Appointment($db);

$appointment->status_id = $_GET['sid'];

$stmt = $appointment->readOneStatus();
$num = $stmt->rowCount();

if ($appointment->status_id != null)
    if ($num > 0) {
        $appointmentList = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $apm = array(
                "id" => (int)$apm_id,
                "date" => $date_time,
                "dentistId" => (int) $dentist_id,
                "type" => $apm_type,
                "dentist" => $fname . " " . $lname,
                "status" => $status_name,
                'specialty' => $spec_name
            );
            array_push($appointmentList, $apm);
        }
        http_response_code(200);
        echo json_encode($appointmentList);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "No appointment"));//no appointment was found
    } else
    http_response_code(204); //empty id