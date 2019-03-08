<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../objects/advertisement.php';

    $database = new Database();
    $db = $database->getConnection();

    //init object
    $advertisement = new Advertisement($db);
    
    $stmt = $advertisement->read();
    $num = $stmt->rowCount();

    if($num>0){
        $advertisement_arr = arra();
        $advertisement_arr["records"]=array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $advertisement_flyer = array(
            "id"=>$AD_id,
            "startDate"=>$start_date,
            "endDate"=> $end_date,
            "content"=> $content,
            "sysAdmin_id"=> $sysAdmin_id
            );

            array_push($advertisement_arr["records"], $advertisement_flyer);
        }

        http_response_code(200);

        echo json_encode($advertisement_arr);
    }else{
        http_response_code(404);

        echo json_encode(array("message"=>"No advertisements"));
    }
?>