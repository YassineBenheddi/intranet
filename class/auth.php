<?php class Auth {

    /*
    * Identification d'un utilisateur
    */
    function login($d) {
        global $pdo;
        $req = $pdo->prepare("SELECT users.id_users, users.pseudo,users.nom,users.prenom,users.email,roles.name,roles.slug,roles.level
         FROM users LEFT JOIN roles ON users.id_roles=roles.id WHERE pseudo=:username AND password=:password");
        $req->execute($d);
        $data = $req->fetchAll();
        if (count($data) > 0) {
            $_SESSION['auth'] = $data[0];
            return (true);
        }
        return (false);
    }

    /*
    * Autorise un utilisateur à accèder à une page. Redirection vers la page forbidden si l'utilisateur n'a pas les droits.
    */
    function allow($rang) {
        global $pdo; 
        $req = $pdo->prepare("SELECT slug,level FROM roles");
        $req->execute();
        $data = $req->fetchAll();
        $roles = array();
        foreach ($data as $d) {
            $roles[$d->slug] = $d->level;
        }
        if(!$this->user('slug')) {
            header('Location: index.php?p=error/forbidden');
        }
        if($roles[$rang] > $this->level('level')) {
            header('Location: index.php?p=error/forbidden');
        }
    }

    /**
     * Récupère une info utilisateur
     */
    function user($field) {
        if(isset($_SESSION['auth']->slug)) {
            return ($_SESSION['auth']->slug);
        }
        return (false);
    }

    /**
     * Renvoi du niveau de l'utilisateur
     */
    function level($field){
        if(isset($_SESSION['auth']->slug)) {
            return ($_SESSION['auth']->level);
        }
        return (false);
    }

    /**
     * Renvoi une information sur l'utilisateur
     */
    function info($field) {
        if(isset($_SESSION['auth']->$field)) {
            return ($_SESSION['auth']->$field);
        }
        return (false);
    }
}
    $auth = new Auth();
?>