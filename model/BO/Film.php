<?php

class Film
{
    private $id;
    private $titre;
    private $realisateur;
    private $affiche;
    private $annee;
    private array $roles;

    public function __construct($id, $titre, $realisateur, $affiche, $annee, array $roles)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->realisateur = $realisateur;
        $this->affiche = $affiche;
        $this->annee = $annee;
        $this->roles = $roles;
    }


    public function addRole(Role $role)
    {
        $this->roles[] = $role;
    }
    


    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function getAffiche()
    {
        return $this->affiche;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}