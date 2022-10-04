<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Check'ipes</title>
</head>
<body>
    <header class="w3-container w3-teal">
        <h1>Bienvenue sur Check'ipes</h1>
    </header>

    <div style="min-height: 100%; display: flex; justify-content: center;">
        <div class="w3-container w3-half w3-margin-top">
            <form class="w3-container w3-card" action="../controler/login_check.ctrl.php" method="post"  onsubmit="refreshIcon()">
                <p>
                    <label for="name">Nom :</label><br>
                    <input id="name" class="w3-input" type="text" name="name" style="width: 95%;" autofocus required>
                </p>

                <p>
                    <label for="password">Mot de passe :</label><br>
                    <input id="password" type="password" name="password" class="w3-input" style="width: 95%;" required>
                </p>
                <?php if ($this->param['error']) {
                    ?> <p class="w3-red w3-padding">Erreur : Nom ou mot de passe invalide. Veuillez réessayer, s'il vous plait.</p> <?php
                }?>
                <p class="w3-center">
                    <button id="loginButton" class="w3-button w3-light-gray w3-hover-green w3-ripple w3-round" type="submit">Se connecter</button>
                </p>
            </form>
        </div>
    </div>
    
    <script>
        function refreshIcon() {
            if (document.getElementById('name').value != "" && document.getElementById('password').value != "") {
                document.getElementById('loginButton').innerHTML = '<i class="w3-spin w3-xxlarge fa fa-refresh"></i>';
                document.getElementById('loginButton').disabled = "true";
            }
        }
    </script>
</body>
</html>