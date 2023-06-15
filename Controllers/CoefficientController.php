<?php
require "../Models/CoefficientModel.php";
session_start();
class CoefficientControlleR
{
    private $model;
    public function __construct()
    {
        $this->model = new CoefficientModel();
    }
    public function Coefficient($id)
    {


        try {
            $maClasse = $this->model->getLibelleById($id)[0]["libelle_classe"];
            $years = $this->model->SelectYear(0);
            $currentYear = $this->model->SelectYear(1);
            $discipline = $this->model->selectAlldiscipline($id);
            $_SESSION["currentClasse"] = $id;
            // echo json_encode($discipline);
            require "../Views/coefficient.html.php";
        } catch (Exception $th) {
            echo "error" . $th->getmessage();
        }
    }
    public function update()
    {
        $data =  file_get_contents('php://input');
        $donnee = json_decode($data);
        foreach ($donnee as $value) {
            $this->model->updateNote($value->colonne, $value->note, $value->id);
        }

        // echo json_encode(["message" => "mise à jour reussi"]);
      
    }
    public function delete($id)
    {
        
     
        // $idClasse = $_SESSION["currentClasse"];
        $this->model->deletedis($id);
        // $discipline = $this->model->selectAlldiscipline($idClasse);
        // file_put_contents("../Public/fichier.json", json_encode($discipline));
    }
  
}
