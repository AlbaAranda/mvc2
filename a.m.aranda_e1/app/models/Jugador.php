<?php
namespace App\Models;

use PDO;
use DateTime;
use Core\Model;
use PDOException;

require_once '../core/Model.php';

class Jugador extends Model
{
    public function __construct()
    {
        $this->nacimiento = \DateTime::createFromFormat('Y-m-d H:i:s', $this->nacimiento);
    }

    public static function find($id) 
    {
        // !!  COMPLETAR  !!
        $db = Jugador::db();
        $sentencia = $db->prepare('SELECT * FROM jugadores WHERE id=:id');
        $sentencia->execute(array(':id' => $id));
        $sentencia->setFetchMode(PDO::FETCH_CLASS, Jugador::class);
        $jugador = $sentencia->fetch((PDO::FETCH_CLASS));

        return $jugador;
        
    }    
    public static function all()
    {
        // !!  COMPLETAR  !!
        $db = Jugador::db();
        $sentencia = $db->query("SELECT * FROM jugadores");
        $jugadores = $sentencia->fetchAll(PDO::FETCH_CLASS, Jugador::class);

        return $jugadores;
    }

    public function insert()
    {
        // !!  COMPLETAR  !!
        $db = Jugador::db();
        $sentencia = $db->prepare('INSERT INTO jugadores(nombre,puesto,nacimiento) VALUES (:nombre,puesto,nacimiento)');
        $sentencia->bindValue(':nombre', $this->nombre);
        $sentencia->bindValue(':puesto', $this->puesto);
        $sentencia->bindValue(':nacimiento', $this->nacimiento);

        return $sentencia->execute();
    }

    public function save()
    {
        // !!  COMPLETAR  !!
    }
}