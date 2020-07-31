<?php
    include_once "entity/DatabaseTool.php";
    include_once "entity/DataJson.php";
    

	session_start();

    $dbt = DatabaseTool::getInstance();

    $data = $_POST['data'];

    if ($data) {
        $dataUser = json_decode($data);
        if ($dataUser) {
            $user = $dbt->queryUserByName($dataUser->username);

            if ($user) {
                if (strcmp($user->password, md5($dataUser->password)) === 0 && strcmp($dataUser->captcha, $_SESSION["captcha"]) === 0) {
                    
                    $_SESSION["logon"] = true;
                    $_SESSION["id"] = $user->id;

                    echo json_encode(new DataJson(true));
                }
                else {
                    echo json_encode(new DataJson(false));
                }
            }
            else {
                echo json_encode(new DataJson(false));
            }
        }
    }
        
        
?>