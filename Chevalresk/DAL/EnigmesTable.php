<?php
include_once 'DAL/models/enigmes.php';
include_once "DAL/MySQLDataBase.php";
include_once 'php/imageFiles.php';

final class EnigmesTable extends MySQLTable
{
    public function __construct()
    {
        parent::__construct(DB(), new Enigme());
    }

    //À faire
    public function getEnigme($difficulte)
    {
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
        $idRandom = rand(0, $numUnpicked + 2);

        // Requête pour obtenir une énigme non pigée aléatoire
        if ($difficulte !== "") {
            $sql = "SELECT Enonce FROM dbchevalersk8.$tableName WHERE estPigee = 'N' AND idEnigme = $idRandom and Difficulte = $difficulte;";
            $data = $this->_DB->querySqlCmd($sql);
        } else {
            $sql = "SELECT Enonce FROM dbchevalersk8.$tableName WHERE estPigee = 'N' AND idEnigme = $idRandom;";
            $data = $this->_DB->querySqlCmd($sql);
        }

        // Vérifier si des données ont été récupérées
        if ($data && count($data) > 0) {
            // Récupérer l'énoncé de l'énigme depuis le tableau retourné
            $enigme = $data[0]['Enonce'];
        } else {
            // Aucune énigme trouvée, retourner null ou gérer l'erreur selon vos besoins
            return null;
        }
        return $enigme;
    }

    public function getDifficulte($question)
    {
        $tableName = "Enigmes";

        // Requête pour obtenir une énigme non pigée aléatoire
        $sql = "SELECT Difficulte FROM dbchevalersk8.$tableName WHERE Enonce LIKE '%$question%';";
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
            $enigme = " (" . $difficulte . ")";
            return $enigme;
        } else {
            // Aucune énigme trouvée, retourner null ou gérer l'erreur selon vos besoins
            return null;
        }
    }
    public function getReponses($question)
    {
        $tableName = "Enigmes";

        $sql1 = "SELECT idEnigme, Difficulte FROM dbchevalersk8.$tableName WHERE Enonce LIKE '%$question%';";
        $data1 = $this->_DB->querySqlCmd($sql1);

        if ($data1 && count($data1) > 0) {
            $idEnigme = $data1[0]['idEnigme'];
            $difficulte = $data1[0]['Difficulte'];

            $tableName = "Reponses";
            $sql = "SELECT LaReponse, EstBonne FROM dbchevalersk8.$tableName WHERE idEnigme = $idEnigme;";
            $data = $this->_DB->querySqlCmd($sql);

            if ($data && count($data) > 0) {
                $reponsesContent = '<form id="reponsesForm">';
                foreach ($data as $row) {
                    $reponse = $row['LaReponse'];
                    // Utilisez le nom de la réponse comme valeur et l'ID comme identifiant
                    $reponsesContent .= "<input type='radio' id='rep' name='reponse' value='$reponse'>
                                     <label for='$reponse'>$reponse</label><br>";
                }
                $reponsesContent .= "<button type='button' onclick='verifierReponse(\"$difficulte\")'>Vérifier</button>";
                $reponsesContent .= "</form>";

                return $reponsesContent;
            } else {
                // Aucune réponse trouvée pour cette énigme
                return "";
            }
        } else {
            // Aucune énigme trouvée avec cette question
            return "";
        }
    }


    //À faire
    public function updateEnigme($data)
    {
        $sql = "UPDATE  SET  = $data->";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
}