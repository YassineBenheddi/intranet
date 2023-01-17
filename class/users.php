<?php class Users {

    /**
     * Voir les informations de la personne co
     */
    function show() {
        global $pdo;
        $req = $pdo->prepare("SELECT users.id_users, users.pseudo,users.nom,users.prenom,users.email,roles.name,roles.slug,roles.level
         FROM users LEFT JOIN roles ON users.id_roles=roles.id");
        $req->execute();
        $_SESSION['users'] = $req->fetchAll();
    }
    
    /**
     * Ajout d'utilisateur dans la table users
     */
    function add($data, $mail, $username) {
        global $pdo;
        $req = $pdo->prepare("INSERT INTO users VALUES (:id_users, :nom, :prenom, '".strtolower($mail)."', '".strtolower($username)."', :password, :id_roles)");
        $req->execute($data);
    }

    /**
     * MAJ informations d'un utilisateur
     */
    function update($info, $mail, $username) {
        global $pdo;
        $req = $pdo->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = '".strtolower($mail)."', pseudo = '".strtolower($username)."', password = :password,
         id_roles = :id_roles WHERE users.id_users = :id_users");
        $req->execute($info);
    }

    /**
     * Vérifie si un ID correspond à un utilisateur
     */
    function exist($comp) {
        for($i = 0; $i < count($_SESSION['users']); $i++) {
            if ($_SESSION['users'][$i]->id_users == $comp) {
                return (true);
            }
        }
        return (false);
    }

    /**
     * Suppression d'utilisateur dans la table users
     */
    function delete($id) {
        global $pdo;
        $req = $pdo->prepare("DELETE FROM users WHERE id_users=:id_users");
        $req->execute($id);
    }

    /**
     * Ajoute des privilège à l'utilisateur pour qu'il puisse accéder à phpmyadmin
     */
    function create_privilage($data, $username) {
        global $pdo;
        if ($data['id_roles'] > 1) {
            $req = $pdo->prepare("CREATE USER '".strtolower($username)."' @localhost IDENTIFIED BY :password ;
            GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO '".strtolower($username)."' @localhost;FLUSH PRIVILEGES;");
        } elseif ($data['id_roles'] > 0) {
            $req = $pdo->prepare("CREATE USER '".strtolower($username)."' @localhost IDENTIFIED BY :password ;
            GRANT SELECT ON *.* TO '".strtolower($username)."' @localhost;FLUSH PRIVILEGES;");
        }
        $req->bindValue(':password', $data['password']);
        $req->execute();
    }

    /**
     * Suppression d'un compte utilisateur phpmyadmin
     */
    function delete_privilage($data) {
        global $pdo;
        $req = $pdo->prepare("DROP USER '".$data."' @localhost");
        $req->execute();
    }

    /**
     * Demande d'une info précise sur un utilisateur
     */
    function info($field) {
        if(isset($_SESSION['users']->$field)) {
            return ($_SESSION['users']->$field);
        }
        return (false);
    }

    /**
     * Retourne l'ensemble des données dans une chaine de caractères au format HTML dans un tableau
     */
    function display_all($index) {
        return ("<td>".$_SESSION['users'][$index]->id_users.'</td><td>'.$_SESSION['users'][$index]->prenom.'</td><td>'.
        $_SESSION['users'][$index]->nom.'</td><td>'.$_SESSION['users'][$index]->email.'</td><td>'.$_SESSION['users'][$index]->pseudo.'</td>');
    }
}
    $users = new Users();
?>