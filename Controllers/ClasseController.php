<?php
require "../Models/ClasseModel.php";
session_start();
class ClasseController
{
    private $model;
    public function __construct()
    {
        $this->model = new ClasseModel();
    }
    public function classe($id)
    {
        $_SESSION["currentLevel"] = $id;
        $monNiveau = $this->model->getLibelleNiveauByID($id)[0]["libelleGN"];
        var_dump($_SESSION["currentLevel"]);
        $currentYear = $this->model->SelectYear(1);
        $years = $this->model->SelectYear(0);
        $classes = $this->model->allclasse($id);
        require "../Views/Classe.php";
    }
    public function Ajouter()
    {
        if (isset($_POST["newClasse"]) && $_POST["newClasse"]) {
            $clas = $_POST["newClasse"];
            $groupeNiveau = $_SESSION["currentLevel"];
            $niveau = explode(" ", $clas);
            if (count($this->model->getIdByname($niveau[0])) === 0) {
                //Ajout d'un nouveau niveau si celui entrer n'existe pas;
                $this->model->addNewLevel($niveau[0], $groupeNiveau);
            }

            $idNiveau = $this->model->getIdByname($niveau[0])[0]["id_niveau"];
            // var_dump($idNiveau);
            $this->model->addclasse($clas, $idNiveau, $groupeNiveau);
            $this->classe($groupeNiveau);
        }
    }
    public function liste($id)
    {

        $_SESSION["currentClasse"] = $id;
        $maClasse = $this->model->getLibelleById($id)[0]["libelle_classe"];
        $currentYear = $this->model->SelectYear(1);
        $years = $this->model->SelectYear(0);
        $student = $this->model->allStudent($id);
        $mar = $id;
        $level = $_SESSION["currentLevel"];
        $discipline = $this->model->selectAlldiscipline($id);
        $effectif  = $this->model->CountClasse($id);
        require "../Views/Eleve.php";
    }
    public function inscription()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                //code...
                $prenom = $_POST["prenom"];
                $nom = $_POST["nom"];
                $numero = $_POST["numero"];
                $dateNaissance = $_POST["dateNais"];
                $lieuNaissance = $_POST["naissance"];
                $sexe = $_POST["sexe"];
                $statut = $_POST["statut"];
                $id_classe_inscription = $_SESSION["currentClasse"];
                $id_annee_inscription = $this->model->SelectYear(1)[0]["id_annee"];
                $this->model->registerstudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut, $id_classe_inscription, $id_annee_inscription);
                $this->liste($id_classe_inscription);
            } catch (Exception $th) {
                echo "erreur , Le numero est deja attribuer à un éléve";
            }
        }
    }
    public function archiver($id)
    {
        $this->model->updateClasse($id);
        $this->classe($_SESSION["currentLevel"]);
    }
    public function getClasse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data["niveau"];
        $id_annee_inscription = $this->model->SelectYear(1)[0]["id_annee"];
        $idNiveau = $this->model->getIdbyNamejs($name, $id_annee_inscription);
        $id = $idNiveau[0]["id_GNiveau"];
        $classe = $this->model->allclasse($id);
        echo  json_encode($classe);
    }
    public function getNoteDiscipline()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $note = $this->model->getNote($data["colonne"], $data["id"]);
        header('Content-Type: application/json');
        echo json_encode($note);
    }
    public function addNote()
    {
        $data =  file_get_contents('php://input');
        $donnee = json_decode($data);
        $id_niveau = $_SESSION["currentLevel"];
        $id_semestre = 1;
        $id_SemestreNiveau = $this->model->getIdSemestreNiveau($id_semestre, $id_niveau)[0]["idSemestreNiveau"];
        // echo json_encode($donnee);
        $table = [];
        // echo json_encode($data);
        foreach ($donnee as $value) {
            $this->insertOrUpdateNote($value->note, $value->idEleve, $id_SemestreNiveau, $value->discipline, $value->type);
            // array_push($table, ["discipline"=>$value->discipline, "note"=>$value->note,"idEleve"=>$value->idEleve, "type"=>$value->type]);
        }
        // echo json_encode($table);
    }
    public function insertOrUpdateNote($note, $idEleve, $id_semestre, $id_discipline, $type)
    {
        $tab = $this->model->searchNote($idEleve, $id_semestre, $id_discipline, $type);
      if(count($tab) === 0)
      {
        $this->model->insertNote($note, $idEleve, $id_semestre, $id_discipline, $type);
      }
      else{
        $this->model->uptdateNote($tab[0]["id_Note_"], $note);
      }
       
    }
    // public function insertOrUpdateNote($idEleve, $id_semestre, $id_discipline, $type)
    // {
    //     $tab = $this->model->searchNote($idEleve, $id_semestre, $id_discipline, $type);
    //     var_dump(count($tab));
       
    // }
}
