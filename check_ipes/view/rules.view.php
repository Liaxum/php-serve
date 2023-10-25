<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Règles</title>
</head>
<body>
<header class="w3-container w3-teal">
        <h1>Règles</h1>
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

    <div class="w3-responsive">
        <table class="w3-table-all w3-striped">
            <tr>
                <td>
                    <h4>Règle français 2 | Top 12, NI, NII</h4>
                    <p>Chaque équipe doit contenir au moins un joueur et une joueuse de nationalité française.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle du même niveau | NI, NII, NII</h4>
                    <p>Chaque équipe doit aligner à chaque ronde au moins 4 joueurs ayant déjà participé au moins une fois pour le compte de cette équipe depuis le début de la saison (sauf ronde 1).</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle de l'Elo | NIV et inférieur</h4>
                    <p>Les joueurs ayant un classement Elo supérieur à 2400 ne sont pas autorisés à joueur en NIV ou inférieur, sauf si moins de deux équipes du club participent aux divisions supérieures pendant la saison en cours.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle des trois fois | Tous niveaux</h4>
                    <p>Lorsqu'un club a plusieurs équipes engagées dans différentes divisions, un joueur ne peut participer dans une division inférieure s'il a déjà joué trois fois en division(s) supérieure(s). </p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle du même niveau | Tous niveaux</h4>
                    <p>Lorsqu'un club a plusieurs équipes engagées dans une même division, tout joueur ayant participé pour le compte d'une de ces équipes ne peut plus jouer dans une autre des ces équipes.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle avoir moins de rondes jouées que le numéro de la ronde | Tous niveaux</h4>
                    <p>Pour disputer une ronde n, un joueur doit avoir joué moins de n rondes dans le championnat.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle du muté | Tous niveaux</h4>
                    <p>Dans un match, une équipe ne peut aligner 3 joueurs mutés.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Règle français | Tous niveaux</h4>
                    <p>Au moins 5 des joueurs composant une équipe doivent posséder la nationalité française ou être ressortissant de l'Union Européenne résidant en France, ou extracommunautaires résidant en France depuis 5 ans.</p>
                </td>
            </tr>

            <tr>
                <td>
                    <h4>Règle de l'Elo | NIV et inférieur</h4>
                    <p>Les joueurs ayant un classement Elo supérieur à 2400 ne sont pas autorisés à joueur en NIV ou inférieur, sauf si moins de deux équipes du club participent aux divisions supérieures pendant la saison en cours.</p>
                </td>
            </tr>

        </table>
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
    </script>
</body>
</html>
