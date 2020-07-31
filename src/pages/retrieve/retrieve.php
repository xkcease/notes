<?php
    include_once '../../entity/DatabaseTool.php';
    include_once '../../entity/DataJson.php';
    include_once '../../entity/User.php';


    $dbt = DatabaseTool::getInstance();

    $data = $_POST['data'];

    if ($data) {
        $dataUser = json_decode($data);
        if ($dataUser) {
            $temp = $dbt->queryUserByName($dataUser->username);
            if ($temp && strcmp($temp->phone, md5($dataUser->phone)) === 0) {
                $user = new User();
                $user->username = $dataUser->username;
                $user->password = md5($dataUser->password);

                $dbt->updateUser($user);
                echo json_encode(new DataJson(true));
            }
            else {
                echo json_encode(new DataJson(false));
            }
        }
    }
?>