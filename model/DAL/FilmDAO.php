<?php
class FilmDAO extends Dao {
    public function getAll()
    {
        $query = $this->BDD->prepare("SELECT f.idFilm, f.titre, f.realisateur, f.affiche, f.annee, a.nom 
        AS acteur_nom, a.prenom AS acteur_prenom, r.personnage AS role
        FROM films f
        JOIN roles ro ON f.idFilm = ro.idFilm
        JOIN acteurs a ON ro.idActeur = a.idActeur
        JOIN roles r ON ro.idRole = r.idRole");
        $query->execute();
        $films = array();

        while ($data = $query->fetch()) {
            $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], array($data['role']));
            $films[] = $film;
        }

        return $films;
    }

    public function getOne($id)
    {
        $query = $this->BDD->prepare("SELECT idFilm, titre, realisateur, affiche, annee FROM films WHERE idFilm = :id");
        $query->bindParam(":id", $id);
        $query->execute();

        $data = $query->fetch();
        if ($data) {
            $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
            return $film;
        } else {
            return null;
        }
    }

    public function add($film)
    {
        $valeurs = [
            'titre' => $film->getTitre(),
            'realisateur' => $film->getRealisateur(),
            'affiche' => $film->getAffiche(),
            'annee' => $film->getAnnee()
        ];
        $query = 'INSERT INTO films (titre, realisateur, affiche, annee) 
                    VALUES (:titre, :realisateur, :affiche, :annee)';
        $insert = $this->BDD->prepare($query);
        if (!$insert->execute($valeurs)) {
            return false;
        } else {
            return true;
        }
    }

    public function delete($id)
    {
        $query = $this->BDD->prepare("DELETE FROM films WHERE idFilm = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }

    public function getOneByEmailAndPass($email, $password)
    {
        $query = $this->BDD->prepare("SELECT idFilm, titre, realisateur, affiche, annee FROM films WHERE email = :email AND password = :password");
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->execute();

        $data = $query->fetch();
        if ($data) {
            $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee']);
            return $film;
        } else {
            return null;
        }
    }

    public function update($film)
    {
        $requete = 'UPDATE films 
                SET titre = :titre, realisateur = :realisateur, affiche = :affiche, annee = :annee 
                WHERE idFilm = :id';
    $query = $this->BDD->prepare($requete);
    $valeurs = [
        'titre' => $film->getTitre(),
        'realisateur' => $film->getRealisateur(),
        'affiche' => $film->getAffiche(),
        'annee' => $film->getAnnee(),
        'id' => $film->getId()
    ];
    if (!$query->execute($valeurs)) {
        return false;
    } else {
        return true;
    }
    }
    public function join()
    {
        $query = $this->BDD->prepare("SELECT f.titre, f.realisateur, f.affiche, f.annee, a.nom 
        AS acteur_nom, a.prenom AS acteur_prenom, r.personnage AS role
        FROM films f
        JOIN roles ro ON f.idFilm = ro.idFilm
        JOIN acteurs a ON ro.idActeur = a.idActeur
        JOIN roles r ON ro.idRole = r.idRole");
        
    $query->execute();
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
        
    return $resultat;
    }

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
}