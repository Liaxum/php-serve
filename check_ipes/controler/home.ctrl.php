<?php   require_once('../model/DAO.class.php');
        require_once('../framework/View.class.php');

    // Session start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    }
    
    // View Creation
    $view = new View();

    // Assignation viriable
    
    // Loading view
    $view->display('home.view.php');