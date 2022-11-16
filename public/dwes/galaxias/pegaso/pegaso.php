<?php
    //se pone en mayuscula la primera letra siempre
    namespace Dwes\Galaxias\Pegaso;
    
    const RADIO =  0.75; //MILLONES DE AÑOS LUZ 


    function observar($mensaje){
        echo "<br>Estoy DIRIGIENDOME a la galaxia " . $mensaje;
    }

    class Galaxia {
        
        function __construct(){
            $this->nacimiento();
    
        }

        function nacimiento(){
            echo "<br>Soy una nueva Galaxia";
        }

        static function muerte(){
            echo "<br>Me estoy destruyendo";
        }
    }