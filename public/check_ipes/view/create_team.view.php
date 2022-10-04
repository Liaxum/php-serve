<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Création d'une équipe</title>
    <style>
        .mySlides {display:none}
        .w3-left, .w3-right, .w3-badge {cursor:pointer}
        .w3-badge {height:13px;width:13px;padding:0}
    </style>
  </head>
  <body>

  <header class="w3-container w3-teal">
        <h1>Création d'une équipe</h1>
        <nav>
            <div class="w3-bar" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="home.ctrl.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
                <a href="player.ctrl.php" class="w3-bar-item w3-button w3-hide-small">Joueurs</a>
                <a href="rules.ctrl.php" class="w3-bar-item w3-button w3-hide-small">Règles</a>
                <?php if ($_SESSION['user']->getRole() =='capitaine' or $_SESSION['user']->getRole() =='admin'){ ?>
                    <a href="create_team.ctrl.php" class="w3-bar-item w3-button w3-hide-small">Créer votre équipe</a>
                <?php } ?>
                <a href="team.ctrl.php" class="w3-bar-item w3-button w3-hide-small">Consulter les équipes</a>
                <?php if ($_SESSION['user']->getRole() =='president' or $_SESSION['user']->getRole() =='admin'){ ?>
                    <a href="user_managment.ctrl.php" class="w3-bar-item w3-button w3-hide-small">Comptes</a>
                <?php } ?>
                <a href="logout.ctrl.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
                    <i class="fa fa-sign-out" style="font-size:24px"></i>
                </a>
            </div>

            <!-- Navbar on small screens -->
            <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
                <a href="player.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Joueurs</a>
                <a href="rules.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Règles</a>
                <a href="create_team.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Créer votre équipe</a>
                <a href="team.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Consulter les équipes</a>
                <a href="logout.ctrl.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </div>
        </nav>
    </header>

      <form class="w3-container w3-card" action="create_team.ctrl.php" method="post">
          <input type="hidden" name="team_param_set" value="true">
          <p>
              <label for="ronde">Ronde :</label>
              <select onchange="createRonde(this.selectedIndex)" class="w3-select" name="ronde" <?php if (isset($this->param['team_param_set'])) { ?> disabled <?php } ?> required >
                <?php if (isset($this->param['team_param_set'])) { ?>
                  <option value="" disabled selected>Ronde n° <?= $this->param['ronde']->getNRonde() . " de " . $this->param['ronde']->getLevel() ?></option> <?php
                } else {?>
                  <option value="" disabled selected>Choisissez la ronde</option>
                <?php } ?>
                <option value="" >Ajouter une ronde</option>
                <?php foreach ($this->param['rondes'] as $ronde) {
                  if ($ronde->getCurrentRonde()) { ?>
                    <option value="<?=$ronde->getId()?>">Ronde n° <?= $ronde->getNRonde()?> de <?=$ronde->getLevel()?></option>
                  <?php }
                } ?>
              </select>
          </p>
          <p>
            <label for="name">Indiquez le nom de votre équipe :</label>
            <input class="w3-input" type="text" name="name" placeholder="<?php if (isset($this->param['team_param_set'])) { echo($this->param['team']->getName()); } else { ?> Exemple : Echiquier Grenoblois<?php }?>" <?php if (isset($this->param['team_param_set'])) { ?> disabled <?php } ?> required>
          </p>
              <input class="w3-button w3-light-gray w3-hover-green w3-ripple w3-round" type="submit" value='Enregistrer'>
      </form>

      <div id="createRonde" class="w3-modal">
        <div class="w3-modal-content w3-card w3-padding">
          <form action="create_team.ctrl.php" method="post">
            <input type="hidden" name="createRonde" value="true" required>
            <span onclick="document.getElementById('createRonde').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <p>
              <label for="nRonde">Indiquez le numéro de la nouvelle ronde :</label>
              <input type="number" min="1" name="nRonde" placeholder="Numero de la ronde" required>
            </p>
            <p>
                <label for="level">Selectionnez le niveau :</label>
                  <select class="w3-select" name="level" required >
                    <option value="" disabled selected>Choisissez le niveau</option>
                    <option value="NI">National I</option>
                    <option value="NII">National II</option>
                    <option value="NIII">National III</option>
                    <option value="NIV">National IV</option>
                  </select>
            </p>
            <p>
              <label for="place">Indiquez le lieu de la ronde :</label>
              <input type="text" name="place" class="w3-input" placeholder="Grenoble" required>
            </p>
            <p>
              <label for="date">Indiquez la date de la ronde :</label>
              <input type="date" name="date" required>
            </p>
            <p class="w3-container">
              <button class="w3-button w3-right" type="submit">Valider</button>
            </p>
          </form>
        </div>
      </div>

      <?php if (isset($this->param['team_param_set'])) { ?>
        <div class="w3-display-container">
        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle">
            <div class="w3-left w3-text-black w3-hover-text-khaki" onclick="lessDivs(1)">&#10094;</div>
            <div class="w3-right w3-text-black w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
            <span class="w3-badge demo w3-border w3-transparent w3-hover-black" onclick="currentDiv(1)"></span>
            <span class="w3-badge demo w3-border w3-transparent w3-hover-black" onclick="currentDiv(2)"></span>
          </div>
          <div class="mySlides">
            <div class="w3-container w3-half">
              <p class="w3-center">Cliquez sur un joueur pour l'enregistrer dans l'équipe.</p>
              <p class="w3-center"><b>Liste des joueurs possible</b></p>
              <p class="w3-block w3-center"><span class="w3-half">Nom</span><span class="w3-half">Elo</span></p>
              <?php foreach ($this->param['playersGreen'] as $player) { ?>
                <form class="" action="create_team.ctrl.php" method="post">
                  <input type="hidden" name="addPlayer" value="true">
                  <input type="hidden" name="teamId" value="<?= $this->param['team']->getId() ?>">
                  <input type="hidden" name="playerId" value="<?= $player->getId() ?>">
                  <p>
                    <button class="w3-button w3-block w3-green" type="submit"> <span class="w3-half"> <?= $player->getName() ?> </span> <span class="w3-half"> <?= $player->getElo() ?> </span> </button>
                  </p>
                </form>
              <?php } ?>
            </div>
          </div>

          <div class="mySlides">
            <div class="w3-container w3-half">
            <p class="w3-center">Cliquez sur un joueur pour l'enregistrer dans l'équipe.</p>
              <p class="w3-center"><b>Liste des joueurs ne respectant pas les règles de création d'équipes</b></p>
              <p class="w3-block w3-center"><span class="w3-half">Nom</span><span class="w3-half">Elo</span></p>
              <?php foreach ($this->param['playersRed'] as $player) { ?>
                <form class="" action="create_team.ctrl.php" method="post">
                  <input type="hidden" name="addPlayer" value="true">
                  <input type="hidden" name="teamId" value="<?= $this->param['team']->getId() ?>">
                  <input type="hidden" name="playerId" value="<?= $player->getId() ?>">
                  <p>
                    <button class="w3-button w3-block w3-red" type="submit"> <span class="w3-half"> <?= $player->getName() ?> </span> <span class="w3-half"> <?= $player->getElo() ?> </span> </button>
                  </p>
                </form>
              <?php } ?>
            </div>
          </div>




        </div>

        <div>
          <div  class="w3-half">
              <p class="w3-center">Cliquez sur un joueur pour le supprimer de l'équipe.</p>
              <p class="w3-center"><b>Liste des joueurs de l'équipe :</b></p> <br>
              <?php if (isset($this->param['team_param_set'])) { $i=1;
              foreach ($this->param['team']->getPlayers() as $playerTeam) { ?>
                <form class="" action="create_team.ctrl.php" method="post">
                  <input type="hidden" name="removePlayer" value="true">
                  <input type="hidden" name="teamId" value="<?= $this->param['team']->getId() ?>">
                  <input type="hidden" name="playerId" value="<?= $playerTeam->getId() ?>">
                  <p>
                    <button class="w3-button w3-block w3-blue-grey w3-hover-red" type="submit"> <span class="w3-half"> <?= $i . ". ". $playerTeam->getName() ?> </span> <span class="w3-half"> <?= $playerTeam->getElo() ?> </span> </button>
                  </p>
                </form>
                <?php $i++;
              }} ?>
              <a class="w3-button w3-gray w3-right" href="team.ctrl.php">Accéder aux équipes</a>
              <button class="w3-button w3-green" onclick="validate(<?=$this->param['team']->getId()?>)">Valider</button>
          </div>
        </div>
      <?php } ?>

      <?php if (isset($this->param['team'])) { ?>
      <div id="<?= $this->param['team']->getId() ?>" class="w3-modal">
        <div class="w3-modal-content w3-padding">
          <form action="team.ctrl.php" method="post">
            <span onclick="document.getElementById('<?= $this->param['team']->getId() ?>').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
            <input type="hidden" name="validate" value="<?= $this->param['team']->getId() ?>">
            <p>Êtes-vous sûr de vouloir valider votre équipe ? Toute modification ou tentative de suppression sera impossible.</p>
            <input class="w3-btn w3-green" type="submit" value="Enregistrer">
            <span onclick="document.getElementById('<?= $this->param['team']->getId() ?>').style.display='none'" class="w3-btn w3-red">Annuler</span>
          </form>
        </div>
      </div>
      <?php } ?>

        <script>
          // Used to toggle the menu on small screens when clicking on the menu button
          function toggleFunction() {
              var x = document.getElementById("navDemo");
              if (x.className.indexOf("w3-show") == -1) {
                  x.className += " w3-show";
              } else {
                  x.className = x.className.replace(" w3-show", "");
              }
          }
          // Create Ronde
          function createRonde(index) {
              if (index == 1) {
                  document.getElementById('createRonde').style.display='block';
              }
          }

          var slideIndex = 1;
          showDivs(slideIndex);

          function plusDivs(n) {
              showDivs(slideIndex += n);
          }
          function lessDivs(n) {
              showDivs(slideIndex -= n);
          }

          function currentDiv(n) {
              showDivs(slideIndex = n);
          }

          function showDivs(n) {
              var i;
              var x = document.getElementsByClassName("mySlides");
              var dots = document.getElementsByClassName("demo");
              if (n > x.length) {slideIndex = 1}
              if (n < 1) {slideIndex = x.length}
              for (i = 0; i < x.length; i++) {
                  x[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                  dots[i].className = dots[i].className.replace(" w3-black", "");
              }
              x[slideIndex-1].style.display = "block";
              dots[slideIndex-1].className += " w3-black";
          }

          function validate(teamId) {
            document.getElementById(teamId).style.display="block";
          }
        </script>
  </body>
</html>
