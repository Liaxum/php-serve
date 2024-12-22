<?php   require '../library/vendor/autoload.php';
        require_once('../model/DAO.class.php');
        require_once('../model/Player.class.php');

    // DAO creation
    $dao = new DAO();

    // Find date in source code
    $i = 1;

    do {
        $client = new GuzzleHttp\Client();
        $doc = new DOMDocument();

        $res = $client->post('http://www.echecs.asso.fr/ListeJoueurs.aspx?Action=JOUEURCLUBREF&ClubRef=524', [
                'form_params' => [
                    '__EVENTTARGET' => 'ctl00$ContentPlaceHolderMain$PagerFooter',
                    '__EVENTARGUMENT' => "$i"
                ]
            ]
        );
	
        $doc->loadHTML($res->getBody());
        $tags = $doc->getElementsByTagName('tr');
        $player = null;

        foreach($tags as $tag) {
            if ($tag->getAttribute('class') == 'liste_clair' || $tag->getAttribute('class') == 'liste_fonce') {
                $playerInfo = explode("\n", trim($tag->nodeValue));

                if (trim($playerInfo[2]) == "A") {
                    $player = new Player(null, trim($playerInfo[0]), trim($playerInfo[1]), substr(trim($playerInfo[4]), 0, 4), substr(trim($playerInfo[7]), 3), trim($playerInfo[8]), null, null);
                    $dao->addPlayer($player);
                }
            }
        }

        $i++;

    } while ($player != null);

    if (isset($_POST['manualRefresh'])) {
        header('Location: player.ctrl.php');
    } else {
        header('Location: home.ctrl.php');
    }
