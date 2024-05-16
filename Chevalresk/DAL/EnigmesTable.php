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
    public function getId($enonce)
    {
        $tableName = "Enigmes";
        $sql = "SELECT IdEnigme FROM dbchevalersk8.$tableName WHERE Enonce = '$enonce';";
        $data = $this->_DB->querySqlCmd($sql);

        if (isset($data[0]['IdEnigme'])) {
            return $data[0]['IdEnigme'];
        } else {
            return null;
        }
    }

    //À faire
    public function getEnigme($difficulte, $TypeEnigme)
    {
        $tableName = "Enigmes";
        $typeEnigmeCondition = $TypeEnigme != '' ? " WHERE estPigee = 'N' AND TypeEnigme LIKE '$TypeEnigme'" : " WHERE estPigee = 'N'";

        $countQuery = "SELECT count(Enonce) FROM dbchevalersk8.$tableName $typeEnigmeCondition";
        $countResult = $this->_DB->querySqlCmd($countQuery);
        if (is_array($countResult) && isset($countResult[0]['count(Enonce)'])) {
            $numUnpicked = $countResult[0]['count(Enonce)'];
        } else {
            $numUnpicked = 0;
        }
        $sql = "SELECT Enonce FROM dbchevalersk8.$tableName $typeEnigmeCondition ORDER BY RAND() LIMIT 1;";
        $data = $this->_DB->querySqlCmd($sql);

        if ($data && count($data) > 0) {
            $enigme = $data[0]['Enonce'];
            return $enigme;
        } else {
            return "Aucune énigme libre, toutes les enigmes ont été répondues";
            ;
        }
    }


    public function getDifficulte($question)
    {
        $tableName = "Enigmes";
        $sql = "SELECT Difficulte FROM dbchevalersk8.$tableName WHERE Enonce LIKE '%$question%';";
        $data = $this->_DB->querySqlCmd($sql);
        if ($data && count($data) > 0) {
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
            return "";
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
                    $estBonne = $row['EstBonne'];
                    // Utilisez le nom de la réponse comme valeur et l'ID comme identifiant
                    $reponsesContent .= "<input type='radio' id='rep' name='reponse' value='$reponse' data-estbonne='$estBonne'>
                                     <label for='$reponse'>$reponse</label><br>";
                }
                $reponsesContent .= "<button type='button' onclick='verifierReponse(\"$difficulte\")'>Vérifier</button>";
                $reponsesContent .= "</form>";

                return $reponsesContent;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
    public function updateEnigme($enigmeId, $estReussi)
{
    $tableName = "Enigmes";
    $idpp = $_SESSION["currentUserId"];

    // Set estPigee to 'O' for the given enigmeId
    $sql = "UPDATE dbchevalersk8.$tableName SET estPigee = 'O' WHERE idEnigme = $enigmeId";
    echo $sql;
    $this->_DB->nonQuerySqlCmd($sql);
    $data = $this->_DB->querySqlCmd($sql);

    if ($estReussi) {
        // If the enigma is successfully solved
        $sql = "SELECT Enonce, recompense FROM dbchevalersk8.$tableName WHERE idEnigme = $enigmeId";
        $this->_DB->querySqlCmd($sql);

        if ($data && count($data) > 0) {
            // Retrieve enigma details
            $enigme = $data[0]['Enonce'];
            $recompense = $data[0]['recompense'];

            // Increment QuestRep for the player
            $sql = "UPDATE dbchevalersk8.Joueurs SET QuestRep = QuestRep + 1 WHERE JoueurId = $idpp";
            $this->_DB->nonQuerySqlCmd($sql);

            // Update player's Solde
            $sql = "UPDATE dbchevalersk8.Joueurs SET Solde = Solde + $recompense WHERE JoueurId = $idpp";
            $this->_DB->nonQuerySqlCmd($sql);

            // Insert entry into Statistiques table
            $sql = "INSERT INTO dbchevalersk8.Statistiques VALUES ($enigmeId, $idpp, 'O')";
            $this->_DB->nonQuerySqlCmd($sql);

            // Check if QuestRep equals 3 to update estAlch
            $sql = "SELECT QuestRep FROM dbchevalersk8.Joueurs WHERE JoueurId = $idpp";
            $questrep = $this->_DB->querySqlCmd($sql)[0]['QuestRep'];
            if ($questrep == 3) {
                $sql = "UPDATE dbchevalersk8.Joueurs SET estAlch = 1 WHERE JoueurId = $idpp";
                $this->_DB->nonQuerySqlCmd($sql);
            }
        }
        $sql = "INSERT INTO dbchevalersk8.Statistiques VALUES ($enigmeId, $idpp, 'O')";
            $this->_DB->nonQuerySqlCmd($sql);
    } else {
        // Insert entry into Statistiques table with EstBonne set to 'N'
        $sql = "INSERT INTO dbchevalersk8.Statistiques VALUES ($enigmeId, $idpp, 'N')";
        echo $sql; // Ajoutez cette ligne pour afficher la requête SQL dans la console
        $this->_DB->nonQuerySqlCmd($sql);
    }
}


    public function getStats($userId)
{
    $tableName = "Statistiques";

    // Get total number of responses for the specified user
    $sqlTotal = "SELECT COUNT(*) AS nbTotal FROM dbchevalersk8.$tableName WHERE IdJoueur = $userId;";
    $dataTotal = $this->_DB->querySqlCmd($sqlTotal);
    $nbTotal = isset($dataTotal[0]['nbTotal']) ? $dataTotal[0]['nbTotal'] : 0;

    // Get number of correct responses for the specified user
    $sqlCorrect = "SELECT COUNT(*) AS nbBonnes FROM dbchevalersk8.$tableName WHERE IdJoueur = $userId AND estReussie = 'O';";
    $dataCorrect = $this->_DB->querySqlCmd($sqlCorrect);
    $nbBonnes = isset($dataCorrect[0]['nbBonnes']) ? $dataCorrect[0]['nbBonnes'] : 0;

    // Get player alias
    $sqlJoueur = "SELECT Alias FROM dbchevalersk8.Joueurs WHERE JoueurId = $userId;";
    $dataJoueur = $this->_DB->querySqlCmd($sqlJoueur);
    $joueur = isset($dataJoueur[0]['Alias']) ? $dataJoueur[0]['Alias'] : 'Unknown';

    // Create the response string
    $enonce = 'Joueur ' . $joueur . ' a répondu correctement à ' . number_format($nbTotal > 0 ? ($nbBonnes / $nbTotal) * 100 : 0, 2) . '% des énigmes. (' . $nbBonnes . '/' . $nbTotal . ')';

    // Return the statistics
    return $enonce;
}


}