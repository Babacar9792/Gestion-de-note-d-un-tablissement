<?php
class ConnexionBd
{
    private $serveur;
    private $dbname;
    private $login;
    private $password;
    private $options;
    public function __construct()
    {
        $this->serveur = 'localhost';
        $this->dbname = 'GestionNote';
        $this->login = 'root';
        $this->password = 'CoB7740337812.';
        $this->options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
    }

    public  function connexion()
    {
        

        try {
            $connexion = new PDO("mysql:host=$this->serveur;dbname=$this->dbname", $this->login, $this->password, $this->options);
           // echo "connexion reussi";

            // $connexion->setFetchMode(PDO::FETCH_ASSOC);

            return $connexion;
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }
    
}