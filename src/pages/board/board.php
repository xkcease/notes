<?php

    if (!session_id()) {
        session_start();
    }

    // 登录状态验证
    if (!isset($_SESSION["logon"]) && !isset($_SESSION["id"])) {
        header('Location: ../../login.html');
    }
    else {
        header('Location: board.html');
    }

?>