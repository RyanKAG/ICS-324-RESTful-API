<?php
    header("Access-Control-Allow: *");
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow, Autherization, X-Requested-With');

    include_once ('../object/user.php');
    include_once ('../object/Database.php');


    $database = new Databse();
    $db = $databse->getConnection();

    $user = new User($db);

    //retrieve posted user data
    $data = json_decode(file_get_contents('php://input'));

    //check if data is not empty
    if(
        !empty($data->FName)&&
        !empty($data->LName)&&
        !empty($data->Email)&&
        !empty($data->Hashed_pw)&&
        !empty($data->UserName) &&
        !empty($data->status_ID) &&
        !empty($data->U_ID) &&
        !empty($data->type_IDs)
    ){
        $user->FName = $data->FName;
        $user->LName = $data->LName;
        $user->Email = $data->Email;
        $user->Hashed_pw = $data->Hashed_pw;
        $user->UserName = $data->UserName;
        $user->Reg_Date = date('d-m-Y H:i:s');
        $user->type_IDs = $data->type_IDs;
        $user->U_ID = $data->U_ID;
        $user->status_ID = $data->status_ID;
        if($user->create()){
            http_response_code(201);

            echo json_encode(array("message" => 'User has been registered'));
        }
        else{
            http_response_code(503);

            echo json_encode(array("message" => "Unable to create product."));
        }
    }
    else{
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    }
