<?php
require "../Models/InscriptionModel.php";
class InscriptionController
{
    private $model;
    public function __construct()
    {
        $this->model = new InscriptionModel();
        // $niveau = $this->model->getLevel();
        // require "../Views/test.php";
    }
    public function Inscription()
    {
        $niveau = $this->model->getLevel();
        require "../Views/test.php";
    }
    public function getClasse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data["niveau"];
        // var_dump($name);
      
       
        $id_annee_inscription = $this->model->SelectYear(1)[0]["id_annee"];
        $idNiveau = $this->model->getIdbyNamejs($name, $id_annee_inscription);
        $id = $idNiveau[0]["id_GNiveau"];
        $classe = $this->model->allclasse($id);
        header('Content-Type: application/json');
    
        file_put_contents("../Public/fichier.json", json_encode($classe));
        //echo json_encode($classe);
    }

    public function register()
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
                $statut = $_POST["typeEleve"];
                $id_classe_inscription = $_POST["id_classe"];
                $id_annee_inscription = $this->model->SelectYear(1)[0]["id_annee"];
                $this->model->registerstudent($prenom, $nom, $numero, $dateNaissance, $lieuNaissance, $sexe, $statut, $id_classe_inscription, $id_annee_inscription);
               // $this->liste($id_classe_inscription);
            } catch (Exception $th) {
                echo "erreur , Le numero est deja attribuer à un éléve";
            }
        }
    }
}
