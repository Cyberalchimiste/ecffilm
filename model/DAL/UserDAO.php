<?php

class UserDAO extends Dao
{

    //Récupérer un user par son email et mdp
    public function getOneByEmailAndPass($email, $mdp)
    {
        $query = $this->BDD->prepare('SELECT * FROM users WHERE email = :email AND password = :mdp');
        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $mdp);
        $query->execute();
        $users = array();
        while ($data = $query->fetch()) {
            $users = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        }
        return ($users);
    }

    //Récupérer toutes les items
    public function add($user)
    {
        $valeurs = ['username' => $user->getNom(),'email' => $user->getEmail(), 'password' => $user->getPassword()];
        $requete = 'INSERT INTO users (userName, email, password) VALUES (:username, :email , :password)';
        $insert = $this->BDD->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer plus d'info sur 1 item à l'aide de son id
    public function getOne($id){

    }


    //Ajouter un item
    public function getAll(){

    }

    //Ajouter un item
    public function update($data){

    }

    //Supprimer un item
    public function delete($id){

    }

}
