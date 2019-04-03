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

$stmt = $advertisement->read();
$num = $stmt->rowCount();
if ($num > 0) {
    $advertisement_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $advertisement_flyer = array(
            "id" => $Apm_ID,
            "date" => $Apm_Date,
            "type" => $Apm_Type,
            "content" => $pa,
            "sysAdmin_id" => $sysAdmin_ID
        );
        array_push($advertisement_arr, $advertisement_flyer);
    }
    http_response_code(200);
    echo json_encode($advertisement_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No advertisements"));
}