<?php
    //se pone en mayuscula la primera letra siempre
    namespace Dwes\Galaxias;

    const RADIO =  1.25; //MILLONES DE AÑOS LUZ 


    function observar($mensaje){
        echo "<br>Estoy mirando a la galaxia " . $mensaje;
    }

    class Galaxia {
        
        function __construct(){
            $this->nacimiento();
    
        }

        function nacimiento(){
            echo "<br>Nueva Galaxia";
        }

        function __toString()
        {
            return "esto son galaxias superiores";
        }

        static function muerte(){
            echo "<br>Galaxia destruida";
        }
    }