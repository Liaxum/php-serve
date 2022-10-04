<?php   require_once('../framework/View.class.php');

    $view = new View();

    session_start();

    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    }

    $view->display('coming.view.php');