<?php

class SPDO
{
    private $PDOInstance = null;
    private static $instance = null;

    private function __construct()
    {
        $this->PDOInstance = new PDO("mysql:host=localhost:3306;dbname=ecf_film", "root", "");
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function query($query)
    {
        return $this->PDOInstance->query($query);
    }

    public function prepare($query)
    {
        return $this->PDOInstance->prepare($query);
    }

    // Méthode pour récupérer l'ID du dernier enregistrement inséré
    public function lastInsertId($name = null)
    {
        return $this->PDOInstance->lastInsertId($name);
    }
}
