<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/14/2019
 * Time: 1:56 AM
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../object/clinic.php';
include_once '../object/dentist.php';

$database = new Database();
$db = $database->getConnection();





$clinic = new Clinic($db);

$stmt = $clinic->readAll();
$num = $stmt->rowCount();
$dentist = new Dentist($db);

if ($num > 0) {
    $clinics = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $dentist->clinic_id = $c_id;
        $dstmt = $dentist->getDentistsIn();
            $dentists = array();
            while ($tuple = $dstmt->fetch(PDO::FETCH_ASSOC)) {
                extract($tuple);
                $dts = array(
                    'id' => (int)$d_id,
                    'name' => $fname . ' ' . $lname,
                    'email' => $email,
                    'office' => $clinic_office,
                    'status' => $status_name
                );

                array_push($dentists, $dts);
            }

            $cls = array(
                'id' => (int)$c_id,
                'services' => $services,
                'email' => $email,
                'website' => $website,
                'rating' => (real)$rating,
                'name' => $name,
                'status' => $status_name,
                'dentists'=>$dentists
            );
            array_push($clinics,$cls);
    }
    http_response_code(200);
    echo json_encode($clinics);
}else
    http_response_code(204);