<?php
namespace App\Controllers;

use App\Models\Jugador;
/**
*
*/
class JugadorController
{

    function __construct()
    {
        // echo "En JugadorController";
    }

    public function index()
    {
        // !!  COMPLETAR  !!
       // $jugadores = Jugador::all();
        require "../app/views/jugador/index.php";        
    }

    public function create()
    {
        require "../app/views/jugador/create.php";
    }

    public function edit($arguments)
    {
        // !!  COMPLETAR  !!
        require "../app/views/jugador/create.php";
    }

    public function store()
    {             
        // !!  COMPLETAR  !!
        $jugador = new Jugador();
        $jugador->nombre = $_REQUEST['nombre'];
        $jugador->puesto = $_REQUEST['puesto'];
        $jugador->nacimiento = $_REQUEST['nacimiento'];
        $jugador->insert();

        header('Location: /jugador');
    }

    public function titular($arg)
    {
        // !!  COMPLETAR  !!
        header('Location: /jugador');
    }
    public function titulares()
    {
        // !!  COMPLETAR  !!
        require "../app/views/jugador/titulares.php";        
    }
    public function quitar($arg)
    {
        // !!  COMPLETAR  !!
        header('Location: /jugador/titulares');
    }

    public function show($args){
        list($id) = $args;
        $jugador = Jugador::find($id);
        require('../app/views/jugador/show.php');
    }
}
