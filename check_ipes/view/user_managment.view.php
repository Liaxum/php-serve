<!DOCTYPE html>
<html lang="fr">
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
        <h1>Liste des utilisateurs</h1>
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

    <div class="w3-responsive">
        <table class="w3-table-all w3-striped w3-margin-top ">
            <tr class="w3-red">
                <th>Nom</th>
                <th>Rôle</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach($this->param['users'] as $user) {
                ?>
                <tr>
                    <td><?= $user->getName() ?></td>
                    <td><?= $user->getRole() ?></td>
                    <td>
                        <button class="w3-btn" onclick="editUser('<?= $user->getName() ?>')">
                            <i class="fa fa-edit w3-Xlarge"></i>
                        </button>
                    </td>
                    <td>
                        <button class="w3-btn w3-red" onclick="removeUser('<?= $user->getName()?>')">
                            <i class="fa fa-trash w3-Xlarge"></i>
                        </button>
                    </td>
                </tr>
            <?php }?>
        </table>
        <p>
            <button class="w3-block w3-btn w3-topmiddle" onclick="addUser()">Ajouter un nouvel utilisateur</button>
        </p>
    </div>

    <?php foreach ($this->param['users'] as $user) {
        $userNameE =$user->getName() ."e";
        $userNameR = $user->getName() ."r" ?>
        <div id="<?=$user->getName()."e"?>" class="w3-modal">
            <div class="w3-modal-content w3-card w3-padding">
                <form action="user_managment.ctrl.php" method="post">
                    <input type="hidden" name="editUser" value="<?=$user->getName()?>">
                    <span onclick="document.getElementById('<?= $userNameE ?>').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
                    <p>
                        <label for="role">Sélectionnez le rôle de l'utilisateur :</label>
                        <select name="role" class="w3-select">
                            <option value="" disabled selected >Rôle</option>
                            <option value="president">Président</option>
                            <option value="capitaine">Capitaine</option>
                        </select>
                    </p>
                    <p>
                        <label for="password">Modification du mot de passe :</label>
                        <input class="w3-input" type="password" name="password">
                    </p>
                    <p>
                        <input class="w3-btn w3-green" type="submit" value="Enregistrer">
                        <span onclick="document.getElementById('<?= $userNameE ?>').style.display='none'" class="w3-btn w3-red">Annuler</span>
                    </p>
                </form>
            </div>
        </div>

        <div id="<?= $user->getName(). "r"?>" class="w3-modal">
            <div class="w3-modal-content w3-card w3-padding">
                <form action="user_managment.ctrl.php" method="post">
                    <span onclick="document.getElementById('<?= $userNameR ?>').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
                    <input type="hidden" name="removeUser" value="<?=$user->getName()?>">
                    <p>
                        Voulez vous vraiment supprimez l'utilisateur <?= $user->getName() ?> ?</p>
                        <button class="w3-btn w3-green">Confirmer</button>
                        <span onclick="document.getElementById('<?= $userNameR ?>').style.display='none'" class="w3-btn w3-red">Annuler</span>

                </form>
            </div>
        </div>
    <?php }?>

    <div id="addUser" class="w3-modal">
        <div class="w3-modal-content w3-card w3-padding">
            <form action="user_managment.ctrl.php" method="post">
                <span onclick="document.getElementById('addUser').style.display='none'" class="w3-btn w3-display-topright">&times;</span>
                <input type="hidden" name="addUser">
                <p>
                    <label for="name">Indiquez le nom de l'utilisateur :</label>
                    <input type="text" name="name" class="w3-input" placeholder="Exemple : Romain" required autofocus>
                </p>
                <p>
                    <label for="role">Selectionnez le rôle de l'utilisateur:</label>
                    <select name="role" class="w3-select" required>
                        <option value="" disabled selected >Rôle</option>
                        <option value="president">Président</option>
                        <option value="capitaine">Capitaine</option>
                    </select>
                </p>
                <p>
                    <label for="password"> Entrez votre mot de passe :</label>
                    <input type="password" name="password" class="w3-input" placeholder="Mot de passe" required>
                </p>
                <p>
                    <button class="w3-btn w3-green">Confirmer</button>
                    <span onclick="document.getElementById('addUser').style.display='none'" class="w3-btn w3-red">Annuler</span>
                </p>
            </form>
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


        // Edit user
        function editUser(userName) {
            document.getElementById(userName+"e").style.display='block';
        }

        function removeUser(userName) {
            document.getElementById(userName+"r").style.display='block';
        }

        function addUser() {
            document.getElementById('addUser').style.display='block';
        }
    </script>
</body>
</html>
