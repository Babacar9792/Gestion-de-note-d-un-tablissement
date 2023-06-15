<?php

require "../Models/AnneeModel.php";
class CoefficientModel extends AnneeModel
{

    public function selectAlldiscipline($id_classe)
    {

        $requete = "SELECT  * FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe ";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    } //d.libelle_discipline, d.code_discipline  , d.id_discipline, noteExamen, noteressource, id_dis
    // public function updateNote($ressource, $exam, $idclasseDis)
    // {
    //     $requete = "UPDATE discipline_groupeDiscipline SET noteExamen = :exam ,  noteressource = :ressource where id_dis = :idclasseDis";
    //     $requete = $this->bd->prepare($requete);
    //     $requete->bindParam(":exam", $exam);
    //     $requete->bindParam(":ressource", $ressource);
    //     $requete->bindParam(":idclasseDis", $idclasseDis);
    //     $requete->execute();
    // }
    public function updateNote($colonne, $exam, $idclasseDis)
    {
        $requete = "UPDATE discipline_groupeDiscipline SET $colonne = :exam where id_dis = :idclasseDis";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":exam", $exam);
        $requete->bindParam(":idclasseDis", $idclasseDis);
        $requete->execute();
    }

    // public function deleteDiscipline($id)
    // {
    //     $requete = "DELETE FROM discipline_groupeDiscipline WHERE id_discipline_association = :idniv";
    //     $requete = $this->bd->prepare($requete);
    //     $requete->bindParam(":idniv", $id);
    //     $requete->execute();
    // }
    public function deletedis($id)
    {
        $requete = "DELETE FROM discipline_groupeDiscipline WHERE id_dis = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
    }
}
