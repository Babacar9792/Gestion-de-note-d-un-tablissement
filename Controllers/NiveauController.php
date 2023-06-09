<?php
require "../Models/NiveauModel.php";
session_start();
class NiveauController
{
    private $model;
    public function __construct()
    {
        $this->model = new NiveauModel();
    }
    public function Niveau()
    {
        $years = $this->model->SelectYear(0);
        $currentYear = $this->model->SelectYear(1);
        $id = $currentYear[0]["id_annee"];
        $level = $this->model->AllGN($id);
        require "../Views/Niveau.php";
    }
    public function addnewLevel()
    {
        $currentYear = $this->model->SelectYear(1);
        if (isset($_POST["NewLevel"])  && $_POST["NewLevel"]) {
            $newLevel = $_POST["NewLevel"];
            // echo "en cours";
            // var_dump($currentYear[0]["id_annee"]);
            //var_dump($currentYear[0]["id_annee"]);
             $this->model->addLevel($newLevel, $currentYear[0]["id_annee"]);
            //  echo "success";
             $this->Niveau();
        }
    }
    public function classe($id)
    {
        $_SESSION["currentLevel"] = $id;
        $monNiveau = $this->model->getLibelleByID($id)[0]["libelleGN"];
        $currentYear = $this->model->SelectYear(1);
        $years = $this->model->SelectYear(0);
        $classes = $this->model->allclasse($id);
        require "../Views/Classe.php";
    }
    public function updateYear()
    {
        $currentYear = $this->model->getCurrentYear();
        if (isset($_POST["yearchoose"])) {
            $id = $currentYear[0]["id_annee"];
            $nextYear = $_POST["yearchoose"];
            $this->model->updateStatus($id, 0);
            $this->model->updateStatus($nextYear, 1);
            $this->Niveau();
        }
        //echo "nbv";
    }
}
