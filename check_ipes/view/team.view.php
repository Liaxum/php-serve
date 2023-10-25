<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .mySlides {display:none}
        .w3-left, .w3-right, .w3-badge {cursor:pointer}
        .w3-badge {height:13px;width:13px;padding:0}
    </style>
    <title>Equipe</title>
</head>
<body>
<header class="w3-container w3-teal">
        <h1>Liste des équipes</h1>
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

    <div class="w3-row-padding w3-center w3-margin-top w3-display-container">
        <?php foreach ($this->param['teams'] as $team) {
            $i = 1;?>
            <div class="w3-third w3-hide-small w3-card w3-margin" style="max-width:31%;">
                <div class="w3-container ">
                    <p><?=$team->getName() ?></p>
                    <?php foreach ($team->getPlayers() as $player) { ?>
                        <p>Joueur <?= $i . " : " . $player->getName() ?></p>
                        <?php $i++;
                    } ?>
                    <?php if (intval($team->getValidate()) == 0 ) {
                        if (($_SESSION['user']->getRole() == "capitaine" or $_SESSION['user']->getRole() == "admin") and $this->param['dao']->isCapitaineOf($_SESSION['user']->getName(), $team->getId())){ ?>
                    <form action="create_team.ctrl.php" method='post'>
                        <input type="hidden" name="modifiedTeam" value="<?= $team->getId() ?>">
                        <button type="submit" class="w3-btn">Modifier</button>
                        <span class="w3-btn w3-red" onclick="removeTeam(<?=$team->getId()?>)">Supprimer</span>
                    </form>
                    <?php }} ?>
                </div>
            </div>
        <?php } ?>

        <di></div>

        <?php foreach ($this->param['teams'] as $team) {
            $i = 1;?>
            <div class="mySlides w3-hide-medium w3-hide-large"  >
                <div class="w3-container ">
                    <p><?=$team->getName() ?></p>
                    <?php foreach ($team->getPlayers() as $player) { ?>
                        <p> Joueur <?= $i . " : " . $player->getName() ?></p>
                        <?php $i++;
                    } ?>
                    <?php if (intval($team->getValidate()) == 0)  {
                        if (($_SESSION['user']->getRole() == "capitaine" or $_SESSION['user']->getRole() == "admin") and $this->param['dao']->isCapitaineOf($_SESSION['user']->getName(), $team->getId())){ ?>
                    <form action="create_team.ctrl.php" method='post'>
                        <input type="hidden" name="modifiedTeam" value="<?= $team->getId() ?>">
                        <button type="submit" class="w3-btn">Modifier</button>
                        <span class="w3-btn w3-red" onclick="removeTeam(<?=$team->getId()?>)">Supprimer</button>
                    </form>
                    <?php }}?>
                </div>
            </div>

            <div id="<?= $team->getId() ?>" class="w3-modal">
                <div class="w3-modal-content w3-padding">
                    <form action="team.ctrl.php" method="post">
                        <span onclick="document.getElementById('<?= $team->getId() ?>').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
                        <input type="hidden" name="removeTeam" value="<?=$team->getId() ?>">
                        <p>
                            Etes vous sur de vouloir supprimer l'équipe : <?= $team->getName() ?>
                        </p>
                        <p>
                            <button type="submit" class="w3-btn w3-green">Confirmer</button>
                            <span onclick="document.getElementById('<?= $team->getId() ?>').style.display='none'" class="w3-btn w3-red">Annuler</span>
                        </p>
                    </form>
                </div>
            </div>
        <?php } ?>
        <br>
        <br>
        <br>

        <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle w3-hide-medium w3-hide-large" style="width:100%;">
            <div class="w3-left w3-text-black w3-hover-text-khaki" onclick="lessDivs(1)">&#10094;</div>
            <div class="w3-right w3-text-black w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
            <?php foreach ($this->param['teams'] as $team) {
                $i = 1;?>
                <span class="w3-badge demo w3-border w3-transparent w3-hover-black" onclick="currentDiv(<?=$i?>)"></span>
                <?php $i++;
            } ?>
        </div>
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

        function removeTeam(teamId) {
            document.getElementById(teamId).style.display="block";
        }
    </script>
</body>
</html>
