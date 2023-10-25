<?php   require_once('../framework/View.class.php');
        require_once('../model/User.class.php');

    // Session Start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    }

    // view creation
    $view = new View();

    // Display view
    $view->display('rules.view.php');