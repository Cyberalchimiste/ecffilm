<?php

class Role
{
    private $roleId;
    private $personnage;
    private Acteur $acteur;

    public function __construct($roleId, $personnage, Acteur $acteur)
    {
        $this->roleId = $roleId;
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

   
    public function getRoleId()
    {
        return $this->roleId;
    }
}