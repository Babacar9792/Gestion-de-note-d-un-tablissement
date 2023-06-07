<?php
require "../Models/AnneeModel.php";
class AnneeController
{
    private $model;
    public function __construct()
    {
        $this->model = new AnneeModel();
    }
    public function allYear()
    {
        try {
            $years = $this->model->SelectYear(0);
            $currentYear = $this->model->SelectYear(1);
            require "../Views/Annee.php";
        } catch (Exception $th) {
            echo "error" . $th->getmessage();
        }
    }
    public function addYear()
    {
        if (isset($_POST["nouvelleAnnee"]) && $_POST["nouvelleAnnee"]) {

            try {

                $anne = $_POST["nouvelleAnnee"];
                //var_dump($anne);
                $this->model->AddYear($anne);
                $this->allYear();
                //header("Location:http://Annee/allYear/");
            } catch (Exception $th) {
                echo "Cette annee scolaire existe deja existe deja" . $th->getmessage();
            }
        }
    }
    public function updateYear($id)
    {
        if (isset($_POST["yearUpdate"])) {
            try {
                $anne = $_POST["yearUpdate"];
                $this->model->update($id, $anne);
                $this->allYear();
            } catch (Exception $th) {
                echo "erreur, cette année existe déjà";
            }
        }
    }
    public function archive($id)
    {
        $this->model->archiver($id);
        $this->allYear();
    }
}
