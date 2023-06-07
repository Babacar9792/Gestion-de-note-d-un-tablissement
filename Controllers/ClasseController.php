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
        $currentYear = $this->model->SelectYear(1);
        $years = $this->model->SelectYear(0);
        $student = $this->model->allStudent($id);
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
}
