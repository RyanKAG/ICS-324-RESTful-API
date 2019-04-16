<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 4/16/2019
 * Time: 12:02 AM
 */


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once ('../config/database.php');
include_once('../object/dentist.php');

$database = new Database();
$db = $database->getConnection();

$dentist = new Dentist($db);

$dentist->d_id = $_GET['id'];


if($dentist->d_id != null) {
    $stmt = $dentist->getOrigin();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);

    http_response_code(200);
    echo (int) $clinic_id;
}
else
    http_response_code(204);