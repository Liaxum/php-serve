<?php   require_once('../model/DAO.class.php');
        require_once('../framework/View.class.php');

    // Session Start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    }
    
    // DAO creation
    $dao = new DAO();

    // View creation
    $view = new View();

    // Parameter assignation
    if (isset($_POST['firstId'])) {
        $firstId = intval($_POST['firstId']);
    } else {
        $firstId = 0;
    }

    $way = null;

    if (isset($_POST['way'])) {
        $way = $_POST['way'];
    }

    if ($way == 'next') {
        if ($firstId != 1 ) {
            $players = $dao->next(12, $firstId);
        } else {
            $players = $dao->getNPlayer(12);
        }
    } elseif ($way == 'prev') {
        if ($firstId != 1) {
            $players = $dao->prev(12, $firstId);
        } else {
            $players = $dao->getNPlayer(12);
        }
    } else {
        $players = $dao->next(12, $firstId);
    }

    $view->assign('firstId', $firstId);
    $view->assign('players', $players);
    $view->assign('max', $dao->getNbPlayer());
    // Display view
    $view->display('player.view.php');