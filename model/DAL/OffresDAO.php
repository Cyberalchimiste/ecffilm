<?php

class OffresDAO extends Dao
{

    //Récupérer toutes les offres
    public function getAll()
    {

        $query = $this->BDD->prepare("SELECT id, title, description FROM offers");
        $query->execute();
        $offers = array();

        while ($data = $query->fetch()) {
            $offers[] = new Offres($data['id'], $data['title'], $data['description']);
        }
        return ($offers);
    }

    //Ajouter une offre
    public function add($data)
    {

        $valeurs = ['title' => $data->getTitle(), 'description' => $data->getDescription()];
        $requete = 'INSERT INTO offers (title, description) VALUES (:title , :description)';
        $insert = $this->BDD->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 offre
    public function getOne($id)
    {

        $query = $this->BDD->prepare('SELECT * FROM offers WHERE offers.id = :id_offer');
        $query->execute(array(':id_offer' => $id));
        $data = $query->fetch();
        $offer = new Offres($data['id'], $data['title'], $data['description']);
        return ($offer);
    }

    public function delete($data)
    {
        $valeurs = ['id' => $data->getId()];
        $requete = "DELETE FROM offers WHERE id = :id";
        $delete = $this->BDD->prepare($requete);
        if (!$delete->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    public function update($data){
        


        $query = $this->BDD->prepare("UPDATE offers SET title = :title, description = :description WHERE id = :id");
        $query->bindParam(':id', $data->getId());
        $query->bindParam(':title', $data->getTitle());
        $query->bindParam(':description', $data->getDescription());
        $query->execute();
        

    }

    public function getOneByEmailAndPass($email, $mdp){
        
    }

}