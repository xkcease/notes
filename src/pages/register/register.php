<?php
    include_once '../../entity/DatabaseTool.php';
    include_once '../../entity/DataJson.php';
    include_once '../../entity/User.php';



    $dbt = DatabaseTool::getInstance();
    $data = $_POST['data'];

    if ($data) {
        $dataUser = json_decode($data);
        if ($dataUser) {
            $user = new User();
            $user->username = $dataUser->username;
            $user->password = md5($dataUser->password);
            $user->phone = md5($dataUser->phone);

            $dbt->insertUser($user);            // 添加
            echo json_encode(new DataJson(true));
        }

    }

?> 