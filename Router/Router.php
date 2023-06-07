<?php
class Router
{
    public function __construct()
    {
        $uri = $_SERVER["REQUEST_URI"];
        //var_dump($uri[-1]);
        if ($uri[-1] === '/') {
            $supp = substr($uri, 1, -1);
        } else {
            $supp = substr($uri, 1);
        }
        $slach = explode('/', $supp);
        // var_dump($slach);
        if (isset($slach[0]) && $slach[0]) {
            //echo "controller present" . "<br>";
            $controleur = ucfirst(strtolower($slach[0])) . "Controller";
            if (file_exists("../Controllers/" . $controleur . ".php")) {
                // echo "controleur existe" . "<br>";
                require_once "../Controllers/" . $controleur . ".php";
                $ctrl = new $controleur();
                if (isset($slach[1]) && $slach[1]) {
                    //  echo "methode present" . "<br>";
                    if (method_exists($controleur, $slach[1])) {
                        $link = $slach[1];
                        array_shift($slach);
                        array_shift($slach);
                        //var_dump($slach);
                        call_user_func_array([$ctrl, $link], $slach);
                    } else {
                        echo "methode n'existe pas";
                        echo "page not found";
                    }
                } else {
                    //echo " methode absent";
                    call_user_func([$ctrl, $slach[0]]);
                }
            } else {
                echo "page not found";
            }
        } else {
            // echo "page connexion";
            require "../Views/PageConnexion.php";
           
        }
    }
}
