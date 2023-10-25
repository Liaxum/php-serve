<!DOCTYPE html>
<html>
<title>Bientôt disponible</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url('../data/img/pexels-photo-51055.jpeg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
<body>

    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
        <div class="w3-display-middle">
            <h1 class="w3-jumbo w3-animate-top">Bientôt disponible</h1>
            <hr class="w3-border-grey" style="margin:auto;width:40%">
            <div class="w3-center">
                <a href="home.ctrl.php" class="w3-large w3-button">Revenir a l'accueil</a>
            </div>
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
    </script>
</body>
</html>
