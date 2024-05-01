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
        $sql = "UPDATE dbchevalersk8.$tableName SET estPigee = 'O' WHERE idEnigme = $enigmeId";
        $data = $this->_DB->querySqlCmd($sql);

        if ($estReussi) {
            $sql = "SELECT Enonce, recompense FROM dbchevalersk8.$tableName WHERE idEnigme = $enigmeId";
            $data = $this->_DB->querySqlCmd($sql);

            if ($data && count($data) > 0) {
                $enigme = $data[0]['Enonce'];
                $recompense = $data[0]['recompense'];
                echo "enonce : $enigme ";
                echo "recomp : $recompense";
                $idpp = $_SESSION["currentUserId"];
                $Joueur = JoueursTable()->get($idpp);
                $questrep = $Joueur->QuestRep;
                $sql = "UPDATE dbchevalersk8.Joueurs SET QuestRep = $questrep + 1 where JoueurId=$idpp;";
                $data = $this->_DB->nonQuerySqlCmd($sql);
                echo"<br>$sql";
                $sql = "UPDATE dbchevalersk8.Joueurs SET Solde=$Joueur->Solde+$recompense where JoueurId=$idpp;";
                $data = $this->_DB->nonQuerySqlCmd($sql);
                echo"<br>$sql";
                $Joueur = JoueursTable()->get($idpp);
                if($Joueur->QuestRep == 3){
                    $sql = "UPDATE dbchevalersk8.Joueurs SET estAlch=1 where JoueurId=$idpp;";
                    $data = $this->_DB->nonQuerySqlCmd($sql);
                    echo"<br>$sql";

                }
            }
        }

        return $data;
    }
}