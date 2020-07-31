<?php
    include_once "../../entity/DatabaseTool.php";
    include_once "../../entity/DataJson.php";


    if (!session_id()) {
        session_start();
    }

    $dataJson = new DataJson(true);

    if (isset($_SESSION["id"]) && isset($_SESSION["new"])) {
        
        if ($_SESSION["new"] === 0 && $_SESSION["bid"]) {       // 编辑
            $dbt = DatabaseTool::getInstance();
            $note = $dbt->queryNoteByBid($_SESSION["bid"]);
            $note->picList = $dbt->queryItems($_SESSION["bid"], 0);
            $note->audioList = $dbt->queryItems($_SESSION["bid"], 1);

            $dataJson->data = $note;
        }
        else if ($_SESSION["new"] === 1) {          // 添加
            $dataJson->state = false;
        }

    }
        echo json_encode($dataJson);
?>