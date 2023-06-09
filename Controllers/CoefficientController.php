<?php 
require "../Models/CoefficientModel.php";
session_start();
    class CoefficientController
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
                // echo json_encode($discipline);
                require "../Views/coefficient.html.php";
            } catch (Exception $th) {
                echo "error". $th->getmessage();
            }
        }
        public function update()
        {
           // $id = $_SESSION["currentClasse"];
           $data =  file_get_contents('php://input');
           
             
            // $donnee = $_POST["tab"];
            $donnee = json_decode($data);
            // var_dump($donnee);
            // foreach ($donnee as $value) {
                
            //     $this->model->updateNote($value->ressource, $value->examen, $value->id);
            // }

             foreach ($donnee as $value) {
                
                $this->model->updateNote($value->ressource, $value->examen, $value->id);
            }
           
            echo json_encode(["message"=>"mise à jour reussi"]);
            //  header('Location:/Coefficient/update/');
            //file_put_contents("../Public/fichier.json", json_encode($data));

            // print_r($data);
        }
    }