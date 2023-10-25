<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Joueurs</title>
</head>
<body>
<header class="w3-container w3-teal">
        <h1>Liste des joueurs</h1>
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
                <?php if ($_SESSION['user']->getRole() =='capitaine' or $_SESSION['user']->getRole() =='admin'){ ?>
                <a href="create_team.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Créer votre équipe</a>
                <?php } ?>
                <?php if ($_SESSION['user']->getRole() =='president' or $_SESSION['user']->getRole() =='admin'){ ?>
                    <a href="user_managment.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-small">Comptes</a>
                <?php } ?>
                <a href="team.ctrl.php" class="w3-bar-item w3-button w3-hide-large w3-hide-medium">Consulter les équipes</a>
                <a href="logout.ctrl.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
            </div>
        </nav>
    </header>
    <form action="refresh_player.ctrl.php" method="post" style="display:flex; justify-content:flex-end;" onsubmit="refreshIcon()">
        <input type="hidden" name="manualRefresh" value="true">
        <button id="refreshButton" class="w3-button w3-margin-top w3-margin-right" type="submit">Actualiser</button>
    </form>

    <div class="w3-responsive">
        <table class="w3-table-all w3-striped w3-margin-top ">
            <tr class="w3-red">
                <th>Nom</th>
                <th>Élo</th>
                <th class="w3-hide-small">Identifiant FFE</th>
                <th class="w3-hide-small">Muté</th>
                <th class="w3-hide-small">Information complémentaire</th>
            </tr>
            <?php foreach($this->param['players'] as $key => $player) {
                ?>
                <tr>
                    <td><?= $player->getName() ?></td>
                    <td><?= $player->getElo() ?></td>
                    <td class="w3-hide-small"><?= $player->getNFFE()?></td>
                    <td class="w3-hide-small"><?= $player->getMute()?></td>
                    <td class="w3-hide-small">
                        <form action="update_info_player.ctrl.php" method="get" style="display:flex">
                            <input type="hidden" name="info" value="modif">
                            <input type="hidden" name="player" value="<?= $player->getId()?>">
                            <input type="hidden" name="firstId" value="<?= $this->param['firstId']?>">
                            <input class="w3-input w3-animate-input" type="text" name="information" value="<?= $player->getInfo()?>" placeholder="Modifier" style="width:50%">
                            <input class="w3-button" type="submit" value="Enregistrer">
                        </form>
                    </td>

                </tr>
            <?php }?>
        </table>
    </div>

    <div class="w3-bar w3-border w3-round w3-margin-top w3-container">
        <form action="player.ctrl.php" method="post" class="w3-half">
            <input type="hidden" name="firstId" value="<?=$this->param['firstId']-12?>">
            <input type="hidden" name="way" value="pred">

            <button type="submit" class="w3-button" <?php if ($this->param['firstId'] == 0) { ?> disabled <?php } ?>>&#10094; Précédent</button>
        </form>
        <form action="player.ctrl.php" method="post" class="w3-half">
            <input type="hidden" name="firstId" value="<?=$this->param['firstId']+12?>">
            <input type="hidden" name="way" value="next">
            <button type="submit" class="w3-button w3-right" <?php if ($this->param['firstId']+12 >= $this->param['max']) { ?> disabled <?php } ?>>Suivant &#10095;</button>
        </form>
    </div>

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

        function refreshIcon() {

            document.getElementById('refreshButton').innerHTML = '<i class="w3-spin w3-xxlarge fa fa-refresh"></i>';
            document.getElementById('refreshButton').disabled = "true";
        }
    </script>
</body>
</html>
