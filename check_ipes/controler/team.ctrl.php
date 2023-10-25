<?php   require_once('../framework/View.class.php');
        require_once('../model/DAO.class.php');

    // Session Start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    }

    // DAO Creation
    $dao = new DAO();

    // View Creation
    $view = new View();

    // Parameters assignation
    if (isset($_POST['removeTeam'])) {
        $dao->removeTeam($_POST['removeTeam']);
    }else if (isset($_POST['validate'])) {
        $dao->validateTeam($_POST['validate']);
    }

    $view->assign('dao', $dao);
    $view->assign('teams', $dao->getTeams());

    // Display view
    $view->display('team.view.php');
