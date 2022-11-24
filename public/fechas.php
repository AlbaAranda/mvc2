<?php

//horas
//devuelve la cantidad de segundos desde 1970
echo "<br>La hora es: " . time();

//la fecha desde hoy hasta dentro de un mes en segundos
echo "<br>La hora es: " . strtotime("+1 month");


//fechas: date, DateTime 
//date solo devuelve la hora actual
echo "<br>La fecha es: " . date("d/F/y");

//DateTime devuelve el objeto de la clase, por defecto crea una hora de tipo americano, año/mes/dia
$fecha = new DateTime("now");
echo "<br><br>";
var_dump($fecha);

//DateTime puede trabajar como strtotime
//$fecha es un objeto de DateTime, por lo que no se puede imprimir como string
$fecha = new DateTime("+11 weeks");
echo "<br>";
var_dump($fecha);
echo "<br>Intento de fecha: " . $fecha->format("d@M@Y");

//Crear un formato propio 
echo "<br>Mi fecha personalizada:";
$mifecha = DateTime::createFromFormat("d/m/Y", "12/10/2018");
var_dump($mifecha);
echo"<br>Fecha en español: " . $mifecha->format("j-n-Y");


