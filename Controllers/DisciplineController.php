<?php
require "../Models/DisciplineModel.php";
session_start();
class DisciplineController
{
    private $model;
    public function __construct()
    {
        $this->model = new DisciplineModel();
    }
    public function gestion()
    {
       
        $id = $this->model->getCurrentYear()[0]["id_annee"];
        $level = $this->model->AllGN($id);
        $classes = $this->model->allclasse(3);
        $Gdiscilpline = $this->model->AllGroupeDiscipline();
       // var_dump($Gdiscilpline);
        require_once "../Views/Disciplines.php";
    }
    public function getClasse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data["Disciplineniveau"];
        
        $classe = $this->model->allclasse($id);
        header('Content-Type: application/json');
        echo json_encode($classe);
        // file_put_contents("../Public/fichier.json", json_encode($classe));
        // var_dump($data);
    }

    public function getdisciplineClasse()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data["classe"];
        
        $classe = $this->model->allclasse($id);
        header('Content-Type: application/json');
        $discipline = $this->model->selectAlldiscipline($id);
    
        file_put_contents("../Public/fichier.json", json_encode($discipline));
        var_dump($data);

    }
    public function addGroupeDiscipline()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data["discipline"];
        
        $classe = $this->model->addNewGdiscipline($id);
        $Gdiscilpline = $this->model->AllGroupeDiscipline();
        file_put_contents("../Public/fichier.json", json_encode($Gdiscilpline));
        header('Content-Type: application/json');
    
        
        $this->gestion();
    }




    public function addDiscipline()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data["discipline"];
        
        $id_classe = $data["idClasse"];
        $id_groupe = $data["idGroupeDiscipline"];
        $code = strtoupper($data["code"]);
        $longueurCode = strlen($code);
        // $classe = $this->model->addNewGdiscipline($id);
        header('Content-Type: application/json');
        $codeVerifie = $this->model->getCode($code);
        $libelle = $this->model->getDisciplineByname($name);
        if(count($libelle) === 0)
        {
            while(count($codeVerifie) != 0)
            {
                $newcode = explode(" ", $name);
                if(count($newcode) !=1)
                {
                    $int = count($newcode);
                    $code = "";
                    for ($i=0; $i <$int ; $i++) { 
                        $code = $code.$newcode[$i][0];
                    }
                }
                else 
                {
                    $code = strtoupper(substr($name, 0, $longueurCode+1));
                    $longueurCode = strlen($code);
                    
                }
                $codeVerifie = $this->model->getCode($code);
            }
            $this->model->insertDiscipline($name, $code, $id_groupe);
        }
        $libelle = $this->model->getDisciplineByname($name)[0]["id_discipline"];
       
        $this->model->insertDisciplineGroupe($libelle, $id_classe);
        $discipline = $this->model->selectAlldiscipline($id_classe);
    
        file_put_contents("../Public/fichier.json", json_encode($discipline));
        var_dump($data);

    }
    public function delete()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data["level"];
        $id = $data["id"];
        for ($i=0; $i < count($name); $i++) { 
            echo "en cours";
            $this->model->deleteDiscipline($name[$i]);
            echo "terminée";
        }
        $discipline = $this->model->selectAlldiscipline($id);
        file_put_contents("../Public/fichier.json", json_encode($discipline));
        
    }
}

