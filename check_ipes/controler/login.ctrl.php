<?php   require_once('../framework/View.class.php');

    // View class
    $view = new View();

    if (isset($_GET['error'])) {
        $view->assign('error', $_GET['error']);
    } else {
        $view->assign('error', false);
    }

    // Diplaying
    $view->display('login.view.php');