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
        $requete = "SELECT * FROM inscription, eleve WHERE id_classe_inscription = :id_classe and id_eleve_inscription = id_eleve";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function insertStudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut)
    {
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

    public function insertInscription($id_eleve_inscription, $id_classe_inscription, $id_annee_inscription)
    {
        $requete = "INSERT INTO inscription(id_annee_inscription, id_classe_inscription, id_eleve_inscription) VALUES(:id_annee_inscription, :id_classe_inscription, :id_eleve_inscription)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_eleve_inscription", $id_eleve_inscription);
        $requete->bindParam(":id_classe_inscription", $id_classe_inscription);
        $requete->bindParam(":id_annee_inscription", $id_annee_inscription);
        $requete->execute();
    }

    public function getLastStudent()
    {
        $requete = "SELECT id_eleve FROM eleve ORDER BY id_eleve DESC LIMIT 1";
        $requete = $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchColumn();
    }

    public function registerStudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut, $id_classe_inscription, $id_annee_inscription)
    {
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
    public function selectAlldiscipline($id_classe)
    {

        $requete = "SELECT * FROM discipline AS d INNER JOIN discipline_groupeDiscipline AS dg ON d.id_discipline = dg.id_discipline_association INNER JOIN classe AS c ON dg.id_classe_association = c.id_classe WHERE c.id_classe = :id_classe ";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_classe", $id_classe);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function getNote($colonne, $id)
    {
        $requete = "SELECT $colonne FROM discipline_groupeDiscipline WHERE id_dis = :id";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id", $id);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function nombreLigne()
    {
        $requete = "SELECT COUNT(*) AS total FROM classe";
        $requete = $this->bd->prepare($requete);
        $requete->execute();
        return $requete->fetchAll();

    }
    public function insertNote($note, $id_eleveInscription, $id_semestreNiveau, $id_disciplineClasse, $typeNote)
    {
        $requete = "INSERT INTO note (note, id_inscription_note, id_semestreNiveau_note, id_disciplineClasse_note, typeNote) VALUES (:note, :id_inscription, :idSemestre, :id_discipline, :typeNote)";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":note", $note);
        $requete->bindParam(":id_inscription", $id_eleveInscription);
        $requete->bindParam(":idSemestre", $id_semestreNiveau);
        $requete->bindParam(":id_discipline", $id_disciplineClasse);
        $requete->bindParam(":typeNote", $typeNote);
        $requete->execute();
    }
    public function getIdSemestreNiveau($id_semestre, $id_niveau)
    {
        $requete = "SELECT * FROM semestreNiveau where  id_semestre_association = :id_semestre and id_Gniveau_association = :id_niveau";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":id_semestre", $id_semestre);
        $requete->bindParam(":id_niveau", $id_niveau);
        $requete->execute();
        return $requete->fetchAll();
    }
    public function uptdateNote($idNote, $note)
    {
        $requete = "UPDATE note set note = :note where id_Note_ = :idNote";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":note", $note);
        $requete->bindParam(":idNote", $idNote);
        $requete->execute();
    }
    public function searchNote($idInscription, $idsemestre, $idDiscipline, $typeNote)
    {
        $requete = "SELECT * from note where id_inscription_note = :inscription and id_semestreNiveau_note = :idSemestre and id_disciplineClasse_note = :idDiscipline and typeNote = :typeNote";
        $requete = $this->bd->prepare($requete);    
        $requete->bindParam(":inscription", $idInscription);
        $requete->bindParam(":idSemestre", $idsemestre);
        $requete->bindParam(":idDiscipline", $idDiscipline);
        $requete->bindParam(":typeNote", $typeNote);
        $requete->execute();
        return $requete->fetchAll();
    }

    public function CountClasse($idClasse)
    {
        $requete = "SELECT COUNT(*) AS total FROM  inscription where id_classe_inscription = :idClasse";
        $requete = $this->bd->prepare($requete);
        $requete->bindParam(":idClasse", $idClasse);
        $requete->execute();
        return $requete->fetchAll();
    }

   
}
