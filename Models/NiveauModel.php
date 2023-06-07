<?php
require "../Models/ConexionBd.php";
class NiveauModel
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
    public function SelectYear($statut)
    {
        $requete = "SELECT * FROM annee where statut = :statut and archive = 0";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":statut", $statut);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function addLevel($data, $id)
    {
        $requete = "INSERT INTO GroupeNiveau(libelleGN, id_GNiveau_annee) values(:libelle, :id_GNiveau_annee)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $data);
        $requete->bindParam(":id_GNiveau_annee", $id);
        $requete->execute();
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
        $requete= $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchAll();

    }
    public function updateStatus(int $id, $statut)
    {
        $requete = "UPDATE annee SET statut =:statut WHERE id_annee = :id";
        $stmt = $this->bd->prepare($requete);
        $stmt-> bindParam(":id", $id);
        $stmt-> bindParam(":statut", $statut);
        $stmt->execute();
        echo "wou";
        
    }
}
