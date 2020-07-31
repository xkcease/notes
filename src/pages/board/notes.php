<?php
    include_once "../../entity/DatabaseTool.php";
    include_once "../../entity/DataJson.php";


    if (!session_id()) {
        session_start();
    }

    $noteList = array();
    $dataJson = new DataJson(true);

    if (isset($_SESSION["id"])) {
        $dbt = DatabaseTool::getInstance();
        
        $noteList = $dbt->queryNotes($_SESSION["id"]);
        $dataJson->data = $noteList;
    }
        echo json_encode($dataJson);
?>