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

            // Insérer l'acteur dans la table `acteurs` s'il n'existe pas déjà
            $queryActeur = $this->BDD->prepare("INSERT IGNORE INTO `acteurs` (`nom`, `prenom`) VALUES (:nom, :prenom)");
            $queryActeur->bindParam(':nom', $acteurNom);
            $queryActeur->bindParam(':prenom', $acteurPrenom);
            $queryActeur->execute();

            // Récupérer l'identifiant (idActeur) de l'acteur nouvellement ajouté ou déjà existant
            $acteurId = $this->BDD->lastInsertId();

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
    }

    public function searchByTitle($titre)
{
    $query = $this->BDD->prepare("SELECT f.idFilm, f.titre, f.realisateur, f.affiche, f.annee, a.nom 
    AS acteur_nom, a.prenom AS acteur_prenom, r.personnage AS role
    FROM films f
    JOIN roles ro ON f.idFilm = ro.idFilm
    JOIN acteurs a ON ro.idActeur = a.idActeur
    JOIN roles r ON ro.idRole = r.idRole
    WHERE LOWER(f.titre) LIKE :titre"); // Ajouter une clause WHERE pour filtrer par titre
    $query->execute([':titre' => '%' . strtolower($titre) . '%']); // Utiliser directement strtolower() ici

    $films = array();

    while ($data = $query->fetch()) {
        $film = new Film($data['idFilm'], $data['titre'], $data['realisateur'], $data['affiche'], $data['annee'], array($data['role']));
        $films[] = $film;
    }

    return $films;
}
}