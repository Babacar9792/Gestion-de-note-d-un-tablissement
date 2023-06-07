<?php
require "../Models/ConexionBd.php";
class AnneeModel
{
    private $pdo;


    private PDO $bd;

    public function __construct()
    {
        $this->pdo = new ConnexionBd();
        $this->bd = $this->pdo->connexion();
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
}
