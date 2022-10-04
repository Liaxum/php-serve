<?php   require_once('../framework/View.class.php');

    // Session Start
    session_start();

    // Session end
    session_unset();
    session_destroy();

    // Login page
    header('Location: login.ctrl.php');