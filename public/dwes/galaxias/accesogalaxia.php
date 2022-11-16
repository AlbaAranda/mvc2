<?php
    namespace Dwes\Galaxias;

    echo "<br> Namespace actual: " . __NAMESPACE__;   /* se pone así el name espace porque es de una clase magica*/

    /**
     *  Direccionamiento namespace:
     *      1 - Sin direccionamiento  (Cuando se encuentra al mismo nivel )
     *      2 - Direccionamiento relativo --> Acceder a las carpetas desde mi ubicación actual
     *      3 - Direccionamiento absoluto
     */


     //1
     include "galaxia1.php";

     echo "<h2>Sin direccionamiento</h2>";

     echo "<br>Radio de la galaxia: " .  RADIO; //radio va sin dolar porque es una constante y a estas no se le ponen dolar

     observar("Via lactea");

     $gl = new Galaxia();

     Galaxia::muerte();



    //2
     echo "<h2>Direccionamiento Relativo</h2>";

     include "pegaso/pegaso.php";


     echo "<br>Radio de la galaxia: " .  Pegaso\RADIO; //radio va sin dolar porque es una constante y a estas no se le ponen dolar

     Pegaso\observar("Pegaso");

     $gl = new Pegaso\Galaxia();

     Pegaso\Galaxia::muerte();


     //3
     echo "<h2>Direccionamiento Absoluto</h2>";

    //navego desde el directorio raiz del servidor web (desde public)
     echo "<br>Radio de la galaxia: " .  \Dwes\Galaxias\Pegaso\RADIO; //radio va sin dolar porque es una constante y a estas no se le ponen dolar

     \Dwes\Galaxias\Pegaso\observar("Pegaso");

     $gl = new \Dwes\Galaxias\Pegaso\Galaxia();

     \Dwes\Galaxias\Pegaso\Galaxia::muerte();

     echo "<br>el radio es: " .  RADIO;
     echo "<br>el radio es: " .  RADIO;
     echo "<br>";

     use const \Dwes\Galaxias\Pegaso\RADIO; //para usar elementos individuales de lo que estoy importando
     use function \Dwes\Galaxias\Pegaso\observar;
     use \Dwes\Galaxias\Galaxia;

     echo "<br>el radio es: " .  RADIO;
     echo "<br>Observo en pegaso: " .observar("Otra galaxia");
     echo "<br>Objeto de galaxia genérico: " .new Galaxia();

     //Apodar namespace -> alias  (esto es para acortar una ruta si es muy larga)
     use \Dwes\Galaxias\Pegaso\Galaxia as Seiya;
     use \Dwes\Galaxias\Galaxia as Galaxus;

     echo "<br><br>";
     $pg = new Seiya();
     $glc = new Galaxus();

     //Seiya\observar("Observando a Seiya");
     //Galaxus\observar("Observando a Galaxus");