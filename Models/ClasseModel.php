<?php

require "../Models/ConexionBd.php";
class ClasseModel
{
    private $pdo;


    private PDO $bd;

    public function __construct()
    {
        $this->pdo = new ConnexionBd();
        $this->bd = $this->pdo->connexion();
    }
    public function allclasse($id)
    {
        $requete = "SELECT * FROM classe where id_classe_GN = :id and archiveClasse=0";
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
    public function addclasse($libelle, $niveau, $groupeNiveau)
    {
        $requete = "INSERT INTO classe(libelle_classe, id_niveau_classe, id_classe_GN) values(:libelle, :niveau, :groupeNiveau)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":libelle", $libelle);
        $requete->bindParam(":niveau", $niveau);
        $requete->bindParam(":groupeNiveau", $groupeNiveau);
        $requete->execute();
    }
    public function getIdByname($name)
    {
        $requete = "SELECT id_niveau from niveau where libelleNiveau = :name";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":name", $name);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function addNewLevel($name, $id)
    {
        $requete = "INSERT INTO niveau(id_niveau_GN, libelleNiveau) values(:id, :name)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":name", $name);
        $requete->bindParam(":id", $id);
        $requete->execute();
    }
    public function allStudent($id_classe)
    {
        $requete = "SELECT prenom, nom, dateNaissance, numero, lieuNaissance, statutEleve FROM inscription, eleve WHERE id_classe_inscription = :id_classe and id_eleve_inscription = id_eleve";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
  
 //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   
 public function insertStudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut) {
    $requete = "INSERT INTO eleve(prenom, nom, numero, dateNaissance, lieuNaissance, sexe, statutEleve) VALUES(:prenom, :nom, :numero, :dateNaissance, :lieuNaissance, :sexe, :statut)"; 
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":prenom", $prenom);
    $requete->bindParam(":nom", $nom);
    $requete->bindParam(":numero", $numero);
    $requete->bindParam(":dateNaissance", $dateNaissance);
    $requete->bindParam(":lieuNaissance", $lieuNaissance);
    $requete->bindParam(":sexe", $sexe);
    $requete->bindParam(":statut", $statut);
    $requete->execute();
}

public function insertInscription($id_eleve_inscription, $id_classe_inscription, $id_annee_inscription) {
    $requete = "INSERT INTO inscription(id_annee_inscription, id_classe_inscription, id_eleve_inscription) VALUES(:id_annee_inscription, :id_classe_inscription, :id_eleve_inscription)";
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":id_eleve_inscription", $id_eleve_inscription);
    $requete->bindParam(":id_classe_inscription", $id_classe_inscription);
    $requete->bindParam(":id_annee_inscription", $id_annee_inscription);
    $requete->execute();
}

public function getLastStudent() {
    $requete = "SELECT id_eleve FROM eleve ORDER BY id_eleve DESC LIMIT 1";
    $requete = $this->bd->prepare($requete);
    $requete->execute();
    return $requete->fetchColumn();
}

public function registerStudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut, $id_classe_inscription, $id_annee_inscription) {
    $this->insertStudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut);
    $id_eleve_inscription = $this->getLastStudent();
    $this->insertInscription($id_eleve_inscription, $id_classe_inscription, $id_annee_inscription);
}
public function updateClasse($id)
{
    $requete = "UPDATE classe set archiveClasse = 1 where id_classe = :id";
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":id", $id);
    $requete->execute();
}

public function getIdbyNamejs($name, $anne)
{
    $requete = "SELECT id_GNiveau from GroupeNiveau where libelleGN = :name and id_GNiveau_annee = :anne";
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":name", $name);
    $requete->bindParam(":anne", $anne);
    $requete->execute();
    return $requete->fetchAll();
}
public function getLibelleById($id)
{
    $requete = "SELECT libelle_classe from classe where id_classe = :id";
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":id", $id);
    $requete->execute();
    return $requete->fetchAll();
    
}
public function getLibelleNiveauByID($id)
{
    $requete = "SELECT  libelleGN from GroupeNiveau where id_GNiveau = :id";
    $requete = $this->bd->prepare($requete);
    $requete->bindParam(":id", $id);
    $requete->execute();
    return $requete->fetchAll();
    
}
}