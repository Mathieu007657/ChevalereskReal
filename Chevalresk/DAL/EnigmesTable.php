<?php
include_once 'DAL/models/enigmes.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class EnigmesTable extends MySQLTable
{
    public function __construct(){
        parent::__construct(DB(), new Enigme());
    }

    //À faire
    public function getEnigme() {
        $tableName = "Enigmes";
    
        // Obtenir le nombre d'énigmes non pigées
        $countQuery = "SELECT count(Enonce) FROM dbchevalersk8.$tableName WHERE estPigee = 'N';";
        $countResult = $this->_DB->querySqlCmd($countQuery);
    
        // Vérifier si le résultat est un tableau
        if (is_array($countResult)) {
            $countResult = $this->toObjectArray($countResult);
            $numUnpicked = isset($countResult[0]);
        } else {
            // Gérer le cas où $countResult n'est pas un tableau
            $numUnpicked = 0;
        }
    
        // Générer un ID aléatoire pour sélectionner une énigme non pigée
        $idRandom = rand(0, $numUnpicked + 1);

        // Requête pour obtenir une énigme non pigée aléatoire
        $sql = "SELECT Enonce FROM dbchevalersk8.$tableName WHERE estPigee = 'N' AND idEnigme = $idRandom;";
        $data = $this->_DB->querySqlCmd($sql);

        return $data;
    }    
    public function getDifficulte($question) {
        $tableName = "Enigmes";

        // Requête pour obtenir une énigme non pigée aléatoire
        $sql = "SELECT Enonce, Difficulte FROM dbchevalersk8.$tableName WHERE estPigee = 'N' AND idEnigme = $question;";
        $data = $this->_DB->querySqlCmd($sql);
    
        // Vérifier si des données ont été récupérées
        if ($data && count($data) > 0) {
            // Récupérer l'énoncé de l'énigme depuis le tableau retourné
            $difficulte = '';
            if ($data[0]['Difficulte'] == 'F') {
                $difficulte = "Facile";
            } elseif ($data[0]['Difficulte'] == 'M') {
                $difficulte = "Moyenne";
            } elseif ($data[0]['Difficulte'] == 'D') {
                $difficulte = "Difficile";
            }
            $enigme = $data[0]['Enonce'] . " (".$difficulte.")";
            return $enigme;
        } else {
            // Aucune énigme trouvée, retourner null ou gérer l'erreur selon vos besoins
            return null;
        }
    }
    public function getReponses($question) {
        $tableName = "Enigmes";
        
        $sql1 = "SELECT idEnigme FROM dbchevalersk8.$tableName WHERE Enonce Like '%$question%';";
        $data1 = $this->_DB->querySqlCmd($sql1);
        $tableName = "Reponses";
        $sql = "SELECT LaReponse FROM dbchevalersk8.$tableName WHERE idEnigme = $data1;";
        $data = $this->_DB->querySqlCmd($sql);
    
        // Vérifier si des données ont été récupérées
        if ($data && count($data) > 0) {
            //ici, dis toi qu'il y a 4 reponses en tout avec estBonne, pas 5 et faire un foreach, puisqu'il n'y a pas de Choix1,2,3,4
            $choix1 = $data[0]['Choix1'];
            $choix2 = $data[0]['Choix2'];
            $choix3 = $data[0]['Choix3'];
            $choix4 = $data[0]['Choix4'];
            $estBonne = $data[0]['EstBonne'];
    
            // Générer le contenu HTML avec les choix et le bouton de vérification
            $reponsesContent = <<<HTML
                <div class='Reponses'>
                    <form id="reponsesForm">
                        <input type="radio" id="choix1" name="reponse" value="$choix1">
                        <label for="choix1">$choix1</label><br>
                        <input type="radio" id="choix2" name="reponse" value="$choix2">
                        <label for="choix2">$choix2</label><br>
                        <input type="radio" id="choix3" name="reponse" value="$choix3">
                        <label for="choix3">$choix3</label><br>
                        <input type="radio" id="choix4" name="reponse" value="$choix4">
                        <label for="choix4">$choix4</label><br>
                        <button type="button" onclick="verifierReponse($estBonne)">Vérifier</button>
                    </form> 
                </div>
    HTML;
    
            return $reponsesContent;
        } else {
            // Aucune donnée trouvée, retourner une chaîne vide ou gérer l'erreur selon vos besoins
            return "";
        }
    }
    
    
    //À faire
    public function updateEnigme($data){
        $sql = "UPDATE  SET  = $data->";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
}