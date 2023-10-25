<?php

	require_once('DAO.class.php');
	$dao = new  DAO();
  foreach ($dao->getPlayers() as $player) {
    if($dao->checkPlayer($player->getId(),12)) {
      printf("Le joueur est validé <br>");
    } else {
      printf("Le joueur ne peut pas intégrer cette équipe <br>");
    }
  }