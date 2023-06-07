<?php

require "../Models/ConexionBd.php";
class DisciplineModel
{
    private $pdo;


    private PDO $bd;

    public function __construct()
    {
        $this->pdo = new ConnexionBd();
        $this->bd = $this->pdo->connexion();
    }

    public function AllGN($id)
    {
        $requete = "SELECT * FROM GroupeNiveau where id_GNiveau_annee = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function allclasse($id)
    {
        $requete = "SELECT * FROM classe where id_classe_GN = :id and archiveClasse = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function getCurrentYear()
    {
        $requete = "SELECT * FROM annee where statut = 1";
        $requete = $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function AllGroupeDiscipline()
    {
        $requete = "SELECT * FROM GroupeDiscipline";
        $requete = $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function addNewGdiscipline($data)
    {
        $requete = "INSERT INTO GroupeDiscipline(libelle_GroupeDiscipline) values(:libelle)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $data);
        $requete->execute();
    }
    public function insertDiscipline($libelle, $code_libelle, $id_gdis)
    {
        $requete = "INSERT INTO discipline(libelle_discipline, code_discipline, id_discipline_groupe) values (:libelle, :code_libelle, :id_gdis)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $libelle);
        $requete->bindParam(":code_libelle", $code_libelle);
        $requete->bindParam(":id_gdis", $id_gdis);
        $requete->execute();


    }
    public function insertDisciplineGroupe($id_discipline, $id_classe)
    {
        $requete = "INSERT INTO discipline_groupeDiscipline(id_discipline_association, id_classe_association) values (:id_discipline, :id_classe)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->bindParam(":id_discipline", $id_discipline);
        $requete->execute();
    }
    public function getDisciplineByname($name)
    {
        $requete = "SELECT * FROM discipline where libelle_discipline = :nameDiscipline";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":nameDiscipline", $name);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function selectAlldiscipline($id_classe)
    {
       
        $requete = "SELECT d.libelle_discipline, d.code_discipline  , d.id_discipline FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe ";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function deleteDiscipline($id)
    {
        $requete = "DELETE FROM discipline_groupeDiscipline WHERE id_discipline_association = :idniv";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":idniv", $id);
        $requete->execute();
    }
    public function getCode($name)
    {
        $requete = "SELECT id_discipline FROM discipline where code_discipline = :nameDiscipline";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":nameDiscipline", $name);
        $requete->execute();
        return $requete->fetchAll();
    }
}
