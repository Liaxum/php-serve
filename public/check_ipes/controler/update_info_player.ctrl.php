<?php   require_once('../model/DAO.class.php');

    // DAO creation
    $dao = new DAO();

    // Parameters check
    if (isset($_GET['info']) && isset($_GET['player'])) {
        if (isset($_GET['information'])) {
            $dao->setInfo($_GET['player'], $_GET['information']);
        }
    }

    if (isset($_GET['firstId'])) {
        $firstId = $_GET['firstId'];
        header("Location: player.ctrl.php?firstId=$firstId");
    } else {
        header("Location: player.ctrl.php");
    }