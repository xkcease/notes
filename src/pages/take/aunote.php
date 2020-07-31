<?php
    include_once '../../entity/DatabaseTool.php';
    include_once '../../entity/DataJson.php';
    include_once '../../entity/Note.php';
    include_once '../../entity/Item.php';
    
    session_start();

    $dbt = DatabaseTool::getInstance();
    $data = $_POST['data'];

    if ($data) {
        $dataNote = json_decode($data);
        if ($dataNote && $_SESSION["id"]) {
            $note = new Note();

            if ($_SESSION["new"] === 0 && $_SESSION["bid"]) {       // 编辑
                $note->id = $_SESSION["id"];
                $note->bid = $_SESSION["bid"];
                $note->title = $dataNote->title;
                $note->content = $dataNote->content;
                $note->date = date('Y-m-d', time());

                $dbt->updateNote($note);
            }
            else if ($_SESSION["new"] === 1) {          // 添加
                $note->id = $_SESSION["id"];
                $note->title = $dataNote->title;
                $note->content = $dataNote->content;
                $note->date = date('Y-m-d', time());
                
                $dbt->insertNote($note);

                $_SESSION["bid"] = $dbt->queryNoteByTitle($dataNote->title)->bid;
            }
        }

    }

?>