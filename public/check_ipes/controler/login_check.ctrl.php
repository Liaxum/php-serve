<?php   require_once('../model/DAO.class.php');

    // Identifier check
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = hash('sha256', $_POST['password']);
    } else {
        header('Location: login.ctrl.php?error=true');
    }

    // DAO Creation
    $dao = new DAO();

    // User verrification
    if ($password == $dao->getUser($name)->getPassword() ) {
        session_start();
        $_SESSION['user'] = $dao->getUser($name);
        header('Location: refresh_player.ctrl.php');
    } else {
        header('Location: login.ctrl.php?error=true');
    }