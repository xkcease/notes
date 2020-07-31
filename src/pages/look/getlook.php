<?php
    include_once '../../entity/DataJson.php';
    include_once '../../entity/DatabaseTool.php';

    session_start();

    if (isset($_SESSION['id']) && isset($_SESSION['bid'])) {
        $dbt = DatabaseTool::getInstance();

        $note = $dbt->queryNoteByBid($_SESSION['bid']);
        $note->picList = $dbt->queryItems($_SESSION['bid'], 0);
        $note->audioList = $dbt->queryItems($_SESSION['bid'], 1);

        $dataJson = new DataJson(true);
        $dataJson->data = $note;
        
        echo json_encode($dataJson);
        return;
    }
    else {
        echo json_encode(new DataJson(false));
    }


?>