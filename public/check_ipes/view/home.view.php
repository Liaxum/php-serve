<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Accueil</title>
</head>
<body>
    <header class="w3-container w3-teal">
        <h1>Bienvenue, <?= $_SESSION['user']->getName()?> !</h1>
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

    <div class="w3-row-padding w3-center">
        <a href="player.ctrl.php" class="w3-half w3-button w3-border-black w3-margin-top">
            <div class="w3-container " style="min-height:100%">
                <h3>Joueurs</h3><br>
                <i class="fa fa-user w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
                <p class="w3-hide-small">Consulter les joueurs du club</p>
            </div>
        </a>

        <a href="rules.ctrl.php" class="w3-half w3-button w3-border-black w3-margin-top">
            <div class="w3-container " style="min-height:100%">
                <h3>Règles</h3><br>
                <i class="fa fa-code w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
                <p class="w3-hide-small">Consulter les règles</p>
            </div>
        </a>

        <?php if ($_SESSION['user']->getRole() =='capitaine' or $_SESSION['user']->getRole() =='admin'){ ?>
            <a href="create_team.ctrl.php" class="w3-half w3-button w3-border-black w3-margin-top">
                <div class="w3-container " style="min-height:100%">
                    <h3>Créer votre équipe</h3><br>
                    <i class="fa fa-group w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
                    <p class="w3-hide-small">Créer une nouvelle équipe</p>
                </div>
            </a>
        <?php } ?>

        <a href="team.ctrl.php" class="w3-half w3-button w3-border-black w3-margin-top">
            <div class="w3-container " style="min-height:100%">
                <h3>Consulter les équipes</h3><br>
                <i class="fa fa-group w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
                <p class="w3-hide-small">Consulter et modifier des équipes</p>
            </div>
        </a>

        <?php if ($_SESSION['user']->getRole() =='president' or $_SESSION['user']->getRole() =='admin'){ ?>
            <a href="user_managment.ctrl.php" class="w3-half w3-button w3-border-black w3-margin-top">
                <div class="w3-container " style="min-height:100%">
                    <h3>Gérer les utilisateurs</h3><br>
                    <i class="fa fa-group w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
                    <p class="w3-hide-small">Accéder à l'outil de gestion d'utilisateurs</p>
                </div>
            </a>
        <?php } ?>
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
