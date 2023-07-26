<?php

class Acteur
{
    private $idActeur;
    private $nom;
    private $prenom;

    public function __construct($idActeur, $nom, $prenom)
    {
        $this->idActeur = $idActeur;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getIdActeur()
    {
        return $this->idActeur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
}