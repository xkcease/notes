<?php
     include_once '../../entity/DataJson.php';

    session_start();

    if (isset($_SESSION['id'])) {
        
        if ($_POST['data']) {
            $data = json_decode($_POST['data']);

            if ($data->new === 0 && $data->bid) {   // 编辑
                $_SESSION["new"] = 0;   
                $_SESSION["bid"] = $data->bid;
            }
            else if ($data->new === 1) {   // 添加
                $_SESSION["new"] = 1;
            }
            echo json_encode(new DataJson(true));
            return;
        }
    }
    else {
        echo json_encode(new DataJson(false));
    }


?>