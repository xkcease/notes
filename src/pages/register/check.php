<?php
    include_once "../../entity/DatabaseTool.php";
    include_once "../../entity/DataJson.php";


    $dbt = DatabaseTool::getInstance();

    $data = $_POST['data'];

    if($data){
        $dataUser = json_decode($data);

        // 用户名存在校验
        if ($dataUser->username && $dbt->queryUserByName($dataUser->username)) {
            echo json_encode(new DataJson(true));
            return;
        }
        
        // 手机号存在校验
        if ($dataUser->phone && $dbt->queryUserByPhone(md5($dataUser->phone))) {
            echo json_encode(new DataJson(true));
            return;
        }

        echo json_encode(new DataJson(false));
    }
    else {
        echo json_encode(new DataJson(true));
    }
    
    
?>