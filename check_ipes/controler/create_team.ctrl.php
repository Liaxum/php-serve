<?php   require_once("../framework/View.class.php");
        require_once("../model/DAO.class.php");

    //Session start
    session_start();

    // Session verification
    if (! isset($_SESSION['user'])) {
        header('Location: login.ctrl.php');
    } else if ($_SESSION['user']->getRole() != "capitaine" && $_SESSION['user']->getRole() != "admin") {
        header('Location: login.ctrl.php');
    }


    // View creation
    $view = new View();

    // DAO Creation
    $dao = new DAO();

    // Parameters Check
    if (isset($_POST['team_param_set'])) {
        $view->assign('team_param_set', $_POST['team_param_set']);

        $dao->addTeam(intval($_POST['ronde']), $_POST['name'], $_SESSION['user']->getName());

        $team = $dao->getTeam(intval($_POST['ronde']), $_POST['name']);

        $playersGreen = array();
        $playersRed = array();
        foreach ($dao->getPlayers() as $player) {
            if ($dao->checkPlayer($player->getId(), $team->getId())) {
                $playersGreen[] = $player;
            } else {
                $playersRed[] = $player;
            }
        }

        foreach ($team->getPlayers() as $teamMember) {
            for ($i = 0; $i < count($playersGreen); $i++) {
                if (isset($playersGreen[$i])) {
                    if ($teamMember->getId() == $playersGreen[$i]->getId()) {
                        unset($playersGreen[$i]);
                    }
                }
            }
            for ($i = 0; $i < count($playersRed); $i++) {
                if (isset($playersRed[$i])) {
                    if ($teamMember->getId() == $playersRed[$i]->getId()) {
                        unset($playersRed[$i]);
                    }
                }
            }
        }
        $view->assign('playersGreen', $playersGreen);
        $view->assign('playersRed', $playersRed);

        $view->assign('ronde', $dao->getRondeId($team->getRondeId()));
        $view->assign('team', $team);

    } else if (isset($_POST['createRonde'])) {

        $dao->addRonde($_POST['nRonde'], $_POST['level'], $_POST['place'], $_POST['date']);

    } else if (isset($_POST['addPlayer'])) {

        $param_set = "team_param_set";
        $view->assign('team_param_set', $param_set);
        $dao->addPlayerToTeam($_POST['playerId'], $_POST['teamId']);

        $playersGreen = array();
        $playersRed = array();
        foreach ($dao->getPlayers() as $player) {
            if ($dao->checkPlayer($player->getId(), $dao->getTeamId($_POST['teamId'])->getId())) {
                $playersGreen[] = $player;
            } else {
                $playersRed[] = $player;
            }
        }

        $team = $dao->getTeamId($_POST['teamId']);

        foreach ($team->getPlayers() as $teamMember) {
            for ($i = 0; $i < count($playersGreen); $i++) {
                if (isset($playersGreen[$i])) {
                    if ($teamMember->getId() == $playersGreen[$i]->getId()) {
                        unset($playersGreen[$i]);
                    }
                }
            }
            for ($i = 0; $i < count($playersRed); $i++) {
                if (isset($playersRed[$i])) {
                    if ($teamMember->getId() == $playersRed[$i]->getId()) {
                        unset($playersRed[$i]);
                    }
                }
            }
        }

        $view->assign('playersGreen', $playersGreen);
        $view->assign('playersRed', $playersRed);

        $view->assign('team', $team);
        $view->assign('ronde', $dao->getRondeId($dao->getTeamId($_POST['teamId'])->getRondeId()));

    } else if (isset($_POST['removePlayer'])) {
        //var_dump($_POST);
        $param_set = "team_param_set";
        $view->assign('team_param_set', $param_set);
        $dao->removePlayerFromTeam($_POST['playerId'], $_POST['teamId']);

        $playersGreen = array();
        $playersRed = array();
        foreach ($dao->getPlayers() as $player) {
            if ($dao->checkPlayer($player->getId(), $dao->getTeamId($_POST['teamId'])->getId())) {
                $playersGreen[] = $player;
            } else {
                $playersRed[] = $player;
            }
        }

        $team = $dao->getTeamId($_POST['teamId']);

        foreach ($team->getPlayers() as $teamMember) {
            for ($i = 0; $i < count($playersGreen); $i++) {
                if (isset($playersGreen[$i])) {
                    if ($teamMember->getId() == $playersGreen[$i]->getId()) {
                        unset($playersGreen[$i]);
                    }
                }
            }
            for ($i = 0; $i < count($playersRed); $i++) {
                if (isset($playersRed[$i])) {
                    if ($teamMember->getId() == $playersRed[$i]->getId()) {
                        unset($playersRed[$i]);
                    }
                }
            }
        }

        $view->assign('playersGreen', $playersGreen);
        $view->assign('playersRed', $playersRed);

        $view->assign('team', $team);
        $view->assign('ronde', $dao->getRondeId($dao->getTeamId($_POST['teamId'])->getRondeId()));

    } else if ((isset($_POST['modifiedTeam']))) {
        $view->assign('team_param_set','team_param_set');

        $team = $dao->getTeamId($_POST['modifiedTeam']);

        $playersGreen = array();
        $playersRed = array();
        foreach ($dao->getPlayers() as $player) {
            if ($dao->checkPlayer($player->getId(), $team->getId())) {
                $playersGreen[] = $player;
            } else {
                $playersRed[] = $player;
            }
        }

        foreach ($team->getPlayers() as $teamMember) {
            for ($i = 0; $i < count($playersGreen); $i++) {
                if (isset($playersGreen[$i])) {
                    if ($teamMember->getId() == $playersGreen[$i]->getId()) {
                        unset($playersGreen[$i]);
                    }
                }
            }
            for ($i = 0; $i < count($playersRed); $i++) {
                if (isset($playersRed[$i])) {
                    if ($teamMember->getId() == $playersRed[$i]->getId()) {
                        unset($playersRed[$i]);
                    }
                }
            }
        }

        $view->assign('playersGreen', $playersGreen);
        $view->assign('playersRed', $playersRed);

        $view->assign('ronde', $dao->getRondeId($team->getRondeId()));
        $view->assign('team', $team);

    }

    // Parameters assignation
    $view->assign('rondes', $dao->getRonde());

    // Loading view
    $view->display("create_team.view.php");
