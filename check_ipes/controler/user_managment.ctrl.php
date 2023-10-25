<?php   require_once('../model/DAO.class.php');
        require_once('../model/User.class.php');
        require_once('../framework/View.class.php');

    // Session Start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    } else if ($_SESSION['user']->getRole() != "president" && $_SESSION['user']->getRole() != "admin") {
        header('Location: login.ctrl.php');
    }

    // DAO creation
    $dao = new DAO();

    // View creation
    $view = new View();

    // Parameter Assign

    if (isset($_POST['addUser'])) {
        $dao->addUser($_POST['name'], hash('sha256', $_POST['password']), $_POST['role']);
    } else if (isset($_POST['removeUser'])) {
        $dao->removeUser($_POST['removeUser']);
    } else if (isset($_POST['editUser'])) {
        if (isset($_POST['role'])) {
            $dao->setRoleUser($_POST['editUser'], $_POST['role']);
        }

        if ($_POST['password'] != '') {
            $dao->setPassUser($_POST['editUser'], hash('sha256', $_POST['password']));
        }
    }

    $view->assign('users', $dao->getUsers());

    // Loading view
    $view->display('user_managment.view.php');
