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
                $reponsesContent .= "<input type='radio' id='idEnigme' name='idEnigme' value='$reponse'>
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


public function verifierReponse() {
    // Récupérer l'ID de l'énigme et la réponse sélectionnée par l'utilisateur depuis le formulaire
    $idEnigme = $_POST['idEnigme'];
    $reponseUtilisateur = $_POST['reponse'];

    // Récupérer la difficulté de l'énigme
    $tableName = "Enigmes";
    $sql = "SELECT Difficulte FROM dbchevalersk8.$tableName WHERE idEnigme = $idEnigme;";
    $data = $this->_DB->querySqlCmd($sql);

    if ($data && count($data) > 0) {
        $difficulte = $data[0]['Difficulte'];

        // Vérifier si la réponse sélectionnée par l'utilisateur est correcte
        $tableName = "Reponses";
        $sql = "SELECT EstBonne FROM dbchevalersk8.$tableName WHERE idEnigme = $idEnigme AND LaReponse = '$reponseUtilisateur';";
        $data = $this->_DB->querySqlCmd($sql);

        if ($data && count($data) > 0) {
            $estBonne = $data[0]['EstBonne'];
            if ($estBonne === 'O') {
                // La réponse est correcte
                $somme = 0;
                switch ($difficulte) {
                    case 'F':
                        $somme = 50;
                        break;
                    case 'M':
                        $somme = 100;
                        break;
                    case 'D':
                        $somme = 200;
                        break;
                    default:
                        break;
                }
                $message = "Félicitations ! Vous avez réussi la question et vous avez gagné $somme écus.";
            } else {
                // La réponse est incorrecte
                $message = "Désolé, la réponse est incorrecte. Vous n'avez pas gagné de somme cette fois-ci.";
            }
        } else {
            // Erreur lors de la récupération des données de la base de données
            $message = "Une erreur s'est produite lors de la vérification de la réponse. Veuillez réessayer.";
        }
    } else {
        // Erreur lors de la récupération de la difficulté de l'énigme
        $message = "Une erreur s'est produite lors de la récupération de la difficulté de l'énigme. Veuillez réessayer.";
    }

    echo "<script>alert('$message');</script>";
}


    

    //À faire
    public function updateEnigme($data)
    {
        $sql = "UPDATE  SET  = $data->";
        return $this->_DB->nonQuerySqlCmd($sql);
    }
}