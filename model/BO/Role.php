<?php

class Role
{
    private $personnage;
    private $acteur;

    public function __construct($personnage, $acteur)
    {
        $this->personnage = $personnage;
        $this->acteur = $acteur;
    }

    public function getPersonnage()
    {
        return $this->personnage;
    }

    public function getActeur()
    {
        return $this->acteur;
    }
}