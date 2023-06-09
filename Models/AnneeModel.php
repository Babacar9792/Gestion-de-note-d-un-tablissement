<?php
require "../Models/ConexionBd.php";
class AnneeModel
{
    private $pdo;


    protected   PDO $bd;

    public function __construct()
    {
        $this->pdo = new ConnexionBd();
        $this->bd = $this->pdo->connexion();
    }
public function selectAlldiscipline($id_classe)
    {
       
        $requete = "SELECT d.libelle_discipline, d.code_discipline  , d.id_discipline FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe ";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function SelectYear($statut)
    {
        $requete = "SELECT * FROM annee where statut = :statut and archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":statut", $statut);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function AddYear($data)
    {
        $requete = "INSERT INTO annee(libelle, statut,archive) values(:libelle, 0, 0)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $data);
        $requete->execute();
        
    }
    public function update($id, $newannee)
    {
        $requete = "UPDATE annee SET libelle = :anne WHERE annee.id_annee = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":anne", $newannee);
        $requete->bindParam(":id", $id);
        $requete->execute();
        
    }
    public function archiver($id)
    {
        $requete = "UPDATE annee SET archive = 1 where id_annee = :newd";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":newd", $id);
        $requete->execute();
    }

    public function getLibelleById($id)
    {
        $requete = "SELECT libelle_classe from classe where id_classe = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
        
    }
}
