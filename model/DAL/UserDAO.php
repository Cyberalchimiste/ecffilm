<?php


class UserDAO extends Dao
{

    public function getAll()
    {
        $query = $this->BDD->prepare("SELECT * FROM users");
        $query->execute();
        $users = array();

        while ($data = $query->fetch()) {
            $users[] = new Users($data['id'], $data['email'], $data['password']);
        }
        var_dump($users);
        return ($users);
    }

    public function add($user)
    {
        $valeurs = ['email' => $user->getEmail(), 'password' => $user->getPassword()];
        $requete = 'INSERT INTO users (email, password) VALUES (:email , :password)';
        $insert = $this->BDD->prepare($requete);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    //Récupérer un user par son email et mdp
    public function getOneByEmailAndPass($email, $mdp)
    {
        $query = $this->BDD->prepare('SELECT * FROM users WHERE email = :email AND password = :mdp');
        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $mdp);
        $query->execute();
        $users = array();
        while ($data = $query->fetch()) {
            $users = new Users($data['id'], $data['email'], $data['password']);
        }
        return ($users);
    }

    public function delete($id)
    {
    }

    public function update($data){
        
    }

    public function getOne($id)
    {
    }
}
