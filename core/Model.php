<?php
    namespace Core;
    use PDO;
    use PDOException;

    require_once '../config/db.php';
    use const Config\DSN;
    use const Config\USER;
    use const Config\PASSWORD;

    class Model {
        protected static function db(){
            try {
                $db = new PDO(DSN, USER, PASSWORD);
                $db ->setAttribute(PDO:ATTR_ERRMODE, PDO::EXCEPTION);

            }
            catch (PDOException $e){
                echo 'Falló la conexión: ' . $e->getMessage();
            }
            return $db;
        }
    }