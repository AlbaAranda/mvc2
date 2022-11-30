<?php
namespace App\Controllers;
/**
*
*/
class HomeController
{

    function __construct()
    {
         //echo "En HomeController";
    }

    public function index()
    {
        // echo "<p>En Index()</p>";
        require "../app/views/home.php";
    }
}
