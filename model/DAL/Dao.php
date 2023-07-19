<?php


abstract class Dao
{

    protected $BDD;

    public function __construct()

    {
        // Connexion Database
        try {
            $this->setBDD(SPDO::getInstance());
            $this->BDD->query("SET NAMES UTF8");
        } catch (Exception $e) {
            echo "Problème de connexion à la base de donnée ...";
            die();
        }
    }

    //Récupérer toutes les items
    abstract public function getAll();

    //Récupérer plus d'info sur 1 item à l'aide de son id
    abstract public function getOne($id);

    //Récupérer un user à l'aide de son email et password
    abstract public function getOneByEmailAndPass($email, $mdp);

    //Ajouter un item
    abstract public function add($data);

    //Ajouter un item
    abstract public function update($data);

    //Supprimer un item
    abstract public function delete($id);

    public function setBDD($bdd)
    {
        $this->BDD = $bdd;
    }
}
