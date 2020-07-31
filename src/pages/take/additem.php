<?php
    include_once "../../entity/Item.php";
    include_once '../../entity/DatabaseTool.php';

    session_start();
    
    if ($_FILES['file']) {
        $item = new Item();
        $item->bid = $_SESSION['bid'];
        $item->url = '../../assets/'. $_FILES['file']['name'];
        

        if (strcmp($_FILES['file']['type'], "image/jpeg") === 0) {
            $item->kind = 0;
        }
        else if (strcmp($_FILES['file']['type'], "audio/mpeg") === 0) {
            $item->kind = 1;
        }
        
        $dbt = DatabaseTool::getInstance();
        $dbt->insertItem($item);
        
        move_uploaded_file($_FILES['file']['tmp_name'], '../../assets/'. $_FILES['file']['name']);
    }


?>