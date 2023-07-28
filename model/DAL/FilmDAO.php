<?php
class FilmDAO extends Dao {
    public function getAll($search='')
    {
        $query = $this->BDD->prepare("
            SELECT 
                f.idFilm, 
                f.titre, 
                f.realisateur, 
                f.affiche, 
                f.annee, 
                GROUP_CONCAT('Avec ', a.prenom, ' ', a.nom, ' dans le rôle de ', r.personnage) AS roles
            FROM films f
            JOIN roles ro ON f.idFilm = ro.idFilm
            JOIN acteurs a ON ro.idActeur = a.idActeur
            JOIN roles r ON ro.idRole = r.idRole
            WHERE f.titre LIKE :search
            GROUP BY f.idFilm
        ");
        $query->execute(['search' => "%$search%"]);
        $films = array();
    
        while ($data = $query->fetch()) {
            $roles = explode(',', $data['roles']);
            $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], $roles);
            $films[] = $film;
        }
    
        return $films;
    }
    


    public function getOne($id)
    {
    }

    public function add($film)
    {
        // Insérer le nouveau film dans la table `films`
        $queryFilm = $this->BDD->prepare("INSERT INTO `films` (`titre`, `realisateur`, `affiche`, `annee`) VALUES (:titre, :realisateur, :affiche, :annee)");
        $titre = $film->getTitre();
        $queryFilm->bindParam(':titre', $titre, PDO::PARAM_STR);
        $realisateur = $film->getRealisateur();
        $queryFilm->bindParam(':realisateur', $realisateur, PDO::PARAM_STR);
        $affiche = $film->getAffiche();
        $queryFilm->bindParam(':affiche', $affiche, PDO::PARAM_STR);
        $annee = $film->getAnnee();
        $queryFilm->bindParam(':annee', $annee, PDO::PARAM_INT);
        $queryFilm->execute();

        // Récupérer l'identifiant (idFilm) du film nouvellement ajouté
        $filmId = $this->BDD->lastInsertId();

        // Insérer les rôles associés au film dans les tables `acteurs` et `roles`
        foreach ($film->getRoles() as $role) {
            $acteur = $role->getActeur();
            $acteurNom = $acteur->getNom();
            $acteurPrenom = $acteur->getPrenom();
            $personnage = $role->getPersonnage();
    
            // Rechercher l'acteur dans la table `acteurs` par nom et prénom
            $queryActeur = $this->BDD->prepare("SELECT idActeur FROM acteurs WHERE nom = :nom AND prenom = :prenom");
            $queryActeur->bindParam(':nom', $acteurNom);
            $queryActeur->bindParam(':prenom', $acteurPrenom);
            $queryActeur->execute();
    
            // Vérifier si l'acteur existe déjà dans la base de données
            if ($queryActeur->rowCount() > 0) {
                // Récupérer l'identifiant (idActeur) de l'acteur existant
                $acteurId = $queryActeur->fetchColumn();
            } else {
                // L'acteur n'existe pas, l'ajouter à la table `acteurs`
                $queryNewActeur = $this->BDD->prepare("INSERT INTO `acteurs` (`nom`, `prenom`) VALUES (:nom, :prenom)");
                $queryNewActeur->bindParam(':nom', $acteurNom);
                $queryNewActeur->bindParam(':prenom', $acteurPrenom);
                $queryNewActeur->execute();
    
                // Récupérer l'identifiant (idActeur) de l'acteur nouvellement ajouté
                $acteurId = $this->BDD->lastInsertId();
            }

            // Insérer le rôle dans la table `roles`
            $queryRole = $this->BDD->prepare("INSERT INTO `roles` (`idActeur`, `idFilm`, `personnage`) VALUES (:idActeur, :idFilm, :personnage)");
            $queryRole->bindParam(':idActeur', $acteurId);
            $queryRole->bindParam(':idFilm', $filmId);
            $queryRole->bindParam(':personnage', $personnage);
            $queryRole->execute();
        }

        // Retourner l'identifiant du nouveau film
        return $filmId;
    }

    

    public function delete($id)
    {
        $query = $this->BDD->prepare("DELETE FROM films WHERE idFilm = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }

    public function update($film)
    {
    }

   

    public function getOneByEmail($email)
    {
    }


}