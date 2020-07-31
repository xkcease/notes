<?php
     include_once '../../entity/DataJson.php';
     include_once '../../entity/DatabaseTool.php';

    session_start();

    if (isset($_SESSION['id'])) {
        
        if ($_POST['data']) {
            $data = json_decode($_POST['data']);

            $_SESSION['bid'] = $data->bid;

            echo json_encode(new DataJson(true));
            return;
        }
    }
    else {
        echo json_encode(new DataJson(false));
    }


?>