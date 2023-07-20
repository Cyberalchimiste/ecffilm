<?php

class UserDAO extends Dao
{

    //Récupérer un user par son email et mdp
    public function getOneByEmail($email)
    {
        $query = $this->BDD->prepare('SELECT * FROM users WHERE email = :email');
        $query->bindParam(':email', $email);
        $query->execute();
        $user = null;
        while ($data = $query->fetch()) {
            $user = new User($data['idUser'], $data['userName'], $data['email'], $data['password']);
        }
        return $user;
    }


    public function add($user)
    {
        $valeurs = ['username' => $user->getNom(),'email' => $user->getEmail(), 'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)];
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
