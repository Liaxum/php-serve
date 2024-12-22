<?php   require_once('User.class.php');
        require_once('Player.class.php');
        require_once('Ronde.class.php');
        require_once('Team.class.php');


    // DAO
    class DAO {
        // Attributes
        private $db;

        // Constructor
        function __construct() {
            // REMPLACER ICI PAR LES PARAMETRES DE VOTRE BASE DE DONNEES
            // host : l'hôte du SGBD
            // dbname : le nom de la base de données
            // premier champ : nom d'utilisateur
            // second champ : mot de passe

            $this->db = new PDO('sqlite:../data/check_ipes.db');
        }

        // Getters
        function getUser(string $name): User {
            $sql = "select * from Utilisateur where nom='$name';";
            $res = $this->db->query($sql);

            $user;
            $bool = true;
            foreach ($res as $index => $badUser) {
                $user = new User($badUser['nom'], $badUser['motDePasse'], $badUser['role']);
                $bool = false;
            }
            if ($bool == true) {
                return new User("", "", "");
            } else {
                return $user;
            }
        }

        function getUsers(): array {
            $sql = "select * from Utilisateur;";
            $res = $this->db->query($sql);

            $users = array();
            foreach ($res as $index => $badUser) {
                $users[] = new User($badUser['nom'], $badUser['motDePasse'], $badUser['role']);
            }
            return $users;
        }

        function addUser($name, $password, $role) {
            $sql = 'insert into Utilisateur values (?, ?, ?);';
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->bindParam(2, $password, PDO::PARAM_STR);
            $req->bindParam(3, $role, PDO::PARAM_STR);
            $req->execute();
        }

        function removeUser($name) {
            $sql = "delete from Utilisateur where nom = ?;";
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->execute();
        }

        function setRoleUser($name, $role) {
            $sql = 'update Utilisateur set role = ? where nom = ?;';
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $role, PDO::PARAM_STR);
            $req->bindParam(2, $name, PDO::PARAM_STR);
            $req->execute();
        }

        function setPassUser($name, $password) {
            $sql = 'update Utilisateur set motDePasse = ? where nom = ?;';
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $password, PDO::PARAM_STR);
            $req->bindParam(2, $name, PDO::PARAM_STR);
            $req->execute();
        }

        function getPlayer($name): Player {
            $sql = "select * from Joueur where nom='$name';";
            $res = $this->db->query($sql);

            $player;
            $bool = true;
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $bool = false;
            }
            if ($bool == true) {
                return new Player("", "", "", "", "", "", "", "");
            } else {
                return $player;
            }
        }

        function getPlayers(): array {
            $sql = "select * from Joueur;";
            $res = $this->db->query($sql);
            $players = array();
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $players[] = $player;
            }

            return $players;
        }

        function getNPlayer(int $n): array { // Return the n first players
            $sql = "select * from Joueur limit $n;";
            $res = $this->db->query($sql);

            $players = array();
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $players[] = $player;
            }
            return $players;
        }

        function next(int $n, int $id): array { // Return the n first players after id
            $sql = "select * from Joueur where id > $id limit $n;";
            $res = $this->db->query($sql);

            $players = array();
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $players[] = $player;
            }
            return $players;
        }

        function prev(int $n, int $id): array { // Return the n first players before id
            $sql = "select * from Joueur where id > $id limit $n;";
            $res = $this->db->query($sql);

            $players = array();
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $players[] = $player;
            }
            return $players;
        }

        // Refresh database
        function addPlayer(Player $playerInfo) {
            $nFFE = $playerInfo->getnFFE();
            $name = $playerInfo->getName();
            $elo = $playerInfo->getElo();
            $sex = $playerInfo->getSex();
            $mute = $playerInfo->getMute();

            if ($nFFE != $this->getPlayer($name)->getnFFE()) {
		$sql = "insert into Joueur (nFFE, nom, elo, sexe,mute) values ('$nFFE', '$name', '$elo', '$elo', '$mute');";
		$res = $this->db->query($sql);
            }
        }

        function setInfo(int $id, string $info) {
            $sql = 'UPDATE Joueur SET info = ? where id = ?';
            $sth = $this->db->prepare($sql);
            $sth->bindParam(1, $info, PDO::PARAM_STR);
            $sth->bindParam(2, $id, PDO::PARAM_INT);
            $sth->execute();
        }

        function getRonde(): array {
            $sql = "select * from Ronde;";
            $res = $this->db->query($sql);

            $rondes = array();
                foreach ($res as $index => $badRondes) {
                    $ronde = new Ronde($badRondes['id'], $badRondes['nRonde'], $badRondes['dateRonde'], $badRondes['lieu'], $badRondes['competitionID'], $badRondes['estRondeCourante'], $badRondes['niveau']);
                    $rondes[] = $ronde;
                }
            return $rondes;
        }

        function getTeams(): array {
            $sql = 'select * from Equipe;';
            $res = $this->db->query($sql);

            $teams = array();
            foreach ($res as $index => $badTeam) {
                $team = new Team($badTeam['id'], $badTeam['nom'], $badTeam['idRonde'], $badTeam['estValide']);
                $teams[] = $team;
            }

            foreach ($teams as $team) {
                $idTeam = $team->getId();

                $sql = "select j.* from Joueur as j, JoueurDansEquipe as d where j.id = d.idJoueur and d.idEquipe = $idTeam order by position;";
                $res = $this->db->query($sql);
                foreach ($res as $index => $badPlayer) {
                    $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                    $team->addPlayer($player);
                }
            }
            return $teams;
        }

        function addRonde($nRonde, $level, $place, $date) {
            $sql = 'insert into Ronde (nRonde, dateRonde, lieu, estRondeCourante, niveau, competitionID) values ( ?, ?, ?, true, ?, 1);';
            $req = $this->db->prepare($sql);
            $req->bindParam(1, $nRonde, PDO::PARAM_INT);
            $req->bindParam(2, $date, PDO::PARAM_STR);
            $req->bindParam(3, $place, PDO::PARAM_STR);
            $req->bindParam(4, $level, PDO::PARAM_STR);
            $req->execute();

            if ($nRonde != 1) {
                $sql = "update Ronde set estRondeCourante = false where nRonde = $nRonde-1 and niveau = $level;";
                $this->db->query($sql);
            }
        }

        function addTeam($rondeId, $name, $cap) {
            $sql = 'insert into Equipe (idRonde, nom, estValide) values (?, ?, false);';
            $req = $this->db->prepare($sql);
            $req->bindParam(1, $rondeId, PDO::PARAM_INT);
            $req->bindParam(2, $name, PDO::PARAM_STR);
            $req->execute();

            $sql2 = 'insert into CapitaineDEquipe values ((SELECT id FROM Equipe WHERE idRonde = ? AND nom = ?), ?);';
            $req2 = $this->db->prepare($sql2);
            $req2->bindParam(1, $rondeId, PDO::PARAM_INT);
            $req2->bindParam(2, $name, PDO::PARAM_STR);
            $req2->bindParam(3, $cap, PDO::PARAM_STR);
            $req2->execute();
        }

        function isCapitaineOf($cap, $idEquipe) {
            $sql = "SELECT * FROM CapitaineDEquipe WHERE idEquipe = $idEquipe AND nomUtilisateur = '$cap'";
            $res = $this->db->query($sql);
            $team = 0;
            foreach ($res as $index => $badTeam) {
                $team = 1;
            }
            return ($team == 1);
        }

        function getTeam($rondeId, $name): Team {
            $sql = "select * from Equipe where nom='$name' and idRonde=$rondeId;";
            $res = $this->db->query($sql);
            $team;
            foreach ($res as $index => $badTeam) {
                $team = new Team($badTeam['id'], $badTeam['nom'], $badTeam['idRonde'], $badTeam['estValide']);
            }

            $idTeam = $team->getId();
            $sql = "select j.* from Joueur as j, JoueurDansEquipe as d where j.id = d.idJoueur and d.idEquipe = $idTeam order by position;";
            $res = $this->db->query($sql);
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $team->addPlayer($player);
            }

            return $team;
        }

        function addPlayerToTeam($playerId, $teamId): bool {
            $sql = "select max(position) from JoueurDansEquipe where idEquipe=$teamId;";
            $res = $this->db->query($sql);

            $max;
            foreach ($res as $index => $badMax) { $max = $badMax['max(position)'];}
            $posit;
            if ($max != 'NULL' ) {
                if ($max == 8) {
                    return false;
                } else {
                    $posit = $max+1;
                }
            } else {
                $posit = 1;
            }

            $sql = 'insert into JoueurDansEquipe values (?, ?, ?);';
            $req = $this->db->prepare($sql);
            $req->bindParam(1, $playerId, PDO::PARAM_INT);
            $req->bindParam(2, $teamId, PDO::PARAM_INT);
            $req->bindParam(3, $posit, PDO::PARAM_INT);
            $req->execute();

            return false;
        }

        function removePlayerFromTeam($playerId, $teamId) {
            $SQLPosition = "SELECT position FROM JoueurDansEquipe WHERE idJoueur = $playerId AND idEquipe = $teamId;";
            $ResPosition = $this->db->query($SQLPosition);

            //var_dump($ResNbJoueursRejouant);

            $posit;
            foreach ($ResPosition as $index => $badPosit) {
                $posit = $badPosit['position'];
            }

            if (isset($posit)) {
                $sql = "UPDATE JoueurDansEquipe SET position = position - 1 WHERE position > $posit AND idEquipe = $teamId;";
                $res = $this->db->query($sql);
            }

            $sql2 = "DELETE FROM JoueurDansEquipe WHERE idJoueur = $playerId AND idEquipe = $teamId;";
            $res2 = $this->db->query($sql2);
        }

        function getTeamId($id): Team {
            $sql = "select * from Equipe where id=$id;";
            $res = $this->db->query($sql);

            $team;
            foreach ($res as $index => $badTeam) {
                $team = new Team($badTeam['id'], $badTeam['nom'], $badTeam['idRonde'], $badTeam['estValide']);
            }

            $idTeam = $team->getId();
            $sql = "select j.* from Joueur as j, JoueurDansEquipe as d where j.id = d.idJoueur and d.idEquipe = $idTeam order by position;";
            $res = $this->db->query($sql);
            foreach ($res as $index => $badPlayer) {
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
                $team->addPlayer($player);
            }

            return $team;
        }

        function getIDPlayersDansUneRonde(int $nRonde): array { //returne la liste de players d'une ronde donnée
            $SQLjoueursRondesPred = "SELECT j.idJoueur
                                    FROM JoueurDansEquipe j, Equipe e, Ronde r
                                    WHERE e.idRonde = r.id AND j.idEquipe = e.id AND r.nRonde = $nRonde;";
            $RESjoueursRondesPred = $this->db->query($SQLjoueursRondesPred);
            //ids des joueurs qui ont joué dans la ronde $i
            $idsJoueursRondesPred = array();
            foreach ($RESjoueursRondesPred as $index => $badPlayer) {
                $idsJoueursRondesPred[] = $badPlayer['idJoueur'];
            }

            return $idsJoueursRondesPred;
        }

        function estDansUneRonde($idPlayer, $nRonde): bool {
            $idsJoueursRondesPred = $this->getIDPlayersDansUneRonde($nRonde);
            $i = 0;
            while ($i < sizeof($idsJoueursRondesPred) && $idsJoueursRondesPred[$i] != $idPlayer) {
                $i++;
            }
            if ($i == sizeof($idsJoueursRondesPred)) {
                return false;
            } else {
                return true;
            }
        }

        function checkPlayer(int $idPlayer, int $idEquipe): bool {
            $sql = "select count(*) from JoueurDansEquipe where idEquipe = $idEquipe;";
            $res = $this->db->query($sql);

            $nbPlayer = 0;
            foreach ($res as $index => $badNb) {
                $nbPlayer = $badNb['count(*)'];
            }

            if ($nbPlayer >= 8) {
                return false;
            }



            $sql = "select * from Joueur where id = $idPlayer ;";
            $res = $this->db->query($sql);
            $player; //Objet player de id == $idPlayer
            foreach ($res as $index => $badPlayer) {
                //On obtient toutes les information de $player
                $player = new Player($badPlayer['id'], $badPlayer['nFFE'], $badPlayer['nom'], $badPlayer['elo'], $badPlayer['sexe'], $badPlayer['mute'], $badPlayer['info']);
            }
            //var_dump($player);

            // On récupère les informations sur l'équipe
            $SQLTeam = "select * from Equipe where id = $idEquipe;";
            $RESTeam = $this->db->query($SQLTeam);
            $team;
            foreach ($RESTeam as $index => $badTeam) {
                $team = new Team($badTeam['id'], $badTeam['nom'], $badTeam['idRonde'], $badTeam['estValide']);
            }

            //var_dump($team);

            //Tableaux de correspondance des niveaux
            $niveauxNumeros = array('TOP12' => 5,
                                    'NI'    => 4,
                                    'NII'   => 3,
                                    'NIII'  => 2,
                                    'NIV'   => 1);

            $numerosNiveaux = array(5   => 'TOP12',
                                    4   => 'NI',
                                    3   => 'NII',
                                    2   => 'NIII',
                                    1   => 'NIV');

            //Niveau de la ronde
            $SQLniveauRonde = "SELECT r.niveau FROM Equipe e, Ronde r WHERE e.idRonde = r.id and e.id = $idEquipe;";
            $RESniveauRonde = $this->db->query($SQLniveauRonde);
            $niveauRonde;
            foreach ($RESniveauRonde as $index => $badNiveau) {
                $niveauRonde = $badNiveau['niveau'];
            }
            //var_dump($niveauRonde);

            //Numéro de la ronde courante
            $SQLnumRondeCour = "SELECT nRonde
                                FROM Ronde
                                WHERE estRondeCourante = 1 and niveau = '$niveauRonde';";

            $RESnumRondeCour = $this->db->query($SQLnumRondeCour);
            $numRondeCour;
            foreach ($RESnumRondeCour as $index => $badRonde) {
                $numRondeCour = $badRonde['nRonde'];
            }
            //var_dump($numRondeCour);

            //Règle 3.7c OK

            $nbOcc = 0;
            for($i = $niveauxNumeros[$niveauRonde]; $i <= 5; $i++){
                $niveauTeste = $numerosNiveaux[$i];
                $SQLnbOccNivSup = "SELECT count(*)
                                    FROM Equipe e, Ronde r, JoueurDansEquipe j
                                    WHERE e.idRonde = r.id AND r.niveau = '$niveauTeste'
                                        AND j.idEquipe = e.id AND j.idJoueur = $idPlayer AND r.nRonde < $numRondeCour;";
                $RESnbOccNivSup= $this->db->query($SQLnbOccNivSup);
                $nbOccNivSup;
                foreach ($RESnbOccNivSup as $index => $badNbOcc) {
                    $nbOccNivSup = $badNbOcc['count(*)'];
                }
                $nbOcc += $nbOccNivSup;
            }
            //var_dump($nbOcc);

            if($nbOcc > 3){
                return false; //la règle n'est pas validée
            }

            //Règle 3.7d OK

            $nomEquipe = $team->getName();

            // On récupère toutes les équipes de nom différent par rapport à notre équipe actuelle (autre équipe) et de même division dans lesquelles le joueur a déjà joué
            $SQLAutresEquipesMemeDiv ="SELECT *
                                     FROM Equipe
                                     WHERE nom != '$nomEquipe' AND idRonde IN (SELECT idRonde from Ronde WHERE niveau = '$niveauRonde') AND id IN (SELECT idequipe
                                                       FROM JoueurDansEquipe
                                                       WHERE idJoueur = $idPlayer);";

            $RESAutresEquipesMemeDiv = $this->db->query($SQLAutresEquipesMemeDiv);
            //var_dump($RESAutresEquipesMemeDiv);

            $teams = array();
            foreach ($RESAutresEquipesMemeDiv as $index => $badTeam) {
                $team = new Team($badTeam['id'], $badTeam['nom'], $badTeam['idRonde'], $badTeam['estValide']);
                $teams[] = $team;
            }
            //var_dump(sizeof($teams));

            if (sizeof($teams) > 0) { // S'il y a un résultat le joueur n'est pas valide
                return false;
            }

            //Règle 3.7e OK

            $nbRondesJouees =0;
            for($i = 0; $i < $numRondeCour; $i++){
                if($this->estDansUneRonde($idPlayer,$i)){
                    $nbRondesJouees++;
                }
            }
            //var_dump($nbRondesJouees);
            if($nbRondesJouees > $numRondeCour){
                return false; //la règle n'est pas validée
            }

            //Règle 3.7f OK

            //var_dump($team);

            if ($numRondeCour != 1) {
                // On récupère le nombre de joueurs dans l'équipe qui rejouent après avoir déjà joué dans cette même équipe
                $SQLNbJoueursRejouant = "SELECT count(*) FROM JoueurDansEquipe WHERE idEquipe IN (SELECT id FROM Equipe WHERE nom = '$nomEquipe' AND id != $idEquipe) AND idJoueur IN (SELECT idJoueur FROM JoueurDansEquipe WHERE idEquipe = $idEquipe);";
                $ResNbJoueursRejouant = $this->db->query($SQLNbJoueursRejouant);

                //var_dump($ResNbJoueursRejouant);

                $nbRejouants;
                foreach ($ResNbJoueursRejouant as $index => $badRejouant) {
                    $nbRejouants = $badRejouant['count(*)'];
                }
                //var_dump($nbRejouants);

                $SQLNbJoueursDansEquipe = "SELECT count(*) FROM JoueurDansEquipe WHERE idEquipe = $idEquipe;";
                $ResNbJoueursDansEquipe = $this->db->query($SQLNbJoueursDansEquipe);

                //var_dump($ResNbJoueursDansEquipe);

                $nbJoueursDansEquipe;
                foreach ($ResNbJoueursDansEquipe as $index => $badJoueur) {
                    $nbJoueursDansEquipe = $badJoueur['count(*)'];
                }
                //var_dump($nbJoueursDansEquipe);

                $nbPlacesLibres = 8 - $nbJoueursDansEquipe;
                $nbRejouantsNecessaires = 4 - $nbRejouants;

                //var_dump($nbPlacesLibres);
                //var_dump($nbRejouantsNecessaires);

                if ($nbPlacesLibres <= $nbRejouantsNecessaires) { // S'il nous faut absolument un joueur rejouant
                    $SQLNbRondesJoueesDansEq = "SELECT count(*) FROM JoueurDansEquipe WHERE idEquipe IN (SELECT id FROM Equipe WHERE nom = '$nomEquipe' AND id != $idEquipe) AND idJoueur = $idPlayer;";
                    $ResNbRondesJoueesDansEq = $this->db->query($SQLNbRondesJoueesDansEq);

                    //var_dump($ResNbRondesJoueesDansEq);

                    $nbRondesJouees;
                    foreach ($ResNbRondesJoueesDansEq as $index => $badRondes) {
                        $nbRondesJouees = $badRondes['count(*)'];
                    }

                    //var_dump($nbRondesJouees);

                    if ($nbRondesJouees == 0) {
                        return false;
                    }
                }
            }

            //Règle 3.7g OK

            if ($player->getMute() == "X") {
                $SQLnbMutes = "SELECT distinct count(*)
                                FROM JoueurDansEquipe e, Joueur j
                                WHERE e.idEquipe = $idEquipe AND e.idJoueur = j.id AND j.mute = 'X';";

                $RESnbMutes = $this->db->query($SQLnbMutes);

                $nbMutes;
                foreach ($RESnbMutes as $index => $badMute) {
                    $nbMutes = $badMute['count(*)'];
                }
                //var_dump($nbMutes);

                if($nbMutes >= 3){
                    return false; //la règle n'est pas validée
                }
            }

            //Règle 3.7j OK

            if ($player->getElo() > 2400) {
                //var_dump($player);
                $SQLnbEquipes = "SELECT count(*)
                                FROM Equipe e, Ronde r
                                WHERE r.niveau = 'NIV' AND e.idRonde = r.id";

                $RESnbEquipes = $this->db->query($SQLnbEquipes);
                $nbEquipes;
                foreach ($RESnbEquipes as $index => $badNbEquipes) {
                    $nbEquipes = $badNbEquipes['count(*)'];
                }
                //var_dump($nbEquipes);

                if ($nbEquipes > 2) {
                    return false; //la règle n'est pas validée
                }
            }

            //Le joueur a été validé
            return true;
        }

        function getRondeId($id): Ronde {
            $sql = "select * from Ronde where id = $id;";
            $res = $this->db->query($sql);

            $ronde;
            foreach ($res as $index => $badRondes) {
                $ronde = new Ronde($badRondes['id'], $badRondes['nRonde'], $badRondes['dateRonde'], $badRondes['lieu'], $badRondes['competitionID'], $badRondes['estRondeCourante'], $badRondes['niveau']);
            }
        return $ronde;
        }

        function removeTeam($teamId) {
            $sql = 'delete from Equipe where id = ?;';
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $teamId, PDO::PARAM_INT);
            $req->execute();
        }

        function getNbPlayer(): int {
            $sql = 'select count(*) from Joueur;';
            $res = $this->db->query($sql);

            $max;
            foreach ($res as $index => $badMax) {
                $max = intval($badMax[('count(*)')]);
            }

            return $max;
        }

        function validateTeam($teamId) {
            $sql = 'update Equipe set estValide = true where id = ?;';
            $req = $this->db->prepare($sql);

            $req->bindParam(1, $teamId, PDO::PARAM_INT);
            $req->execute();
        }
    }

    // function checkRonde($nRonde, $level, &$notValidate): boolean {
    //     if ($nRonde > 1) {
    //         $sql = "select * from Ronde where nRonde = $nRonde-1 and niveau = $level;";
    //         $res = $this->db->query($sql);

    //         $ronde;
    //         foreach ($res as $index => $badRonde) {
    //             $ronde = new Ronde($badRondes['id'], $badRondes['nRonde'], $badRondes['dateRonde'], $badRondes['lieu'], $badRondes['competitionID'], $badRondes['estRondeCourante'], $badRondes['niveau']);
    //         }

    //         $RondeId = $ronde->getRondeId();
    //         $sql = "select id, estValide from Equipe where idRonde = $rondeId;";
    //         $res = $this->db->query($sql);
    //         $valide = array();
    //         foreach ($res as $index => $badValide) {
    //             $valide[$badValide['id']] = $badValide['estValide'];
    //         }

    //         foreach ($valide as $index => $value) {
    //             if ($value == 1) {
    //                 $notValidate[] = $index;
    //             }
    //         }
    //         return isset($notValidate);
    //     } else {
    //         $sql = "select * from Ronde where nRonde = $nRonde and niveau = $level;";
    //         $res = $this->db->query($sql);

    //         return isset($res);
    //     }
    // }
