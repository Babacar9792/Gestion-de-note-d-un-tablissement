<?php 
    class MotherController
    {
        public function render($file)
        {
            require "../Views/".$file."php";
        }
    }