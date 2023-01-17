<?php class Equipement {
    function all_equipement() {
        global $pdo;
        $req = $pdo->prepare("SELECT equipements.id_equipement, equipements.type, equipements.marque, equipements.modele, equipements.salle, 
        equipements.date_achat, equipements.num_serie, equipements.id_users, users.nom, users.prenom FROM equipements, users WHERE 
        equipements.id_users = users.id_users");
        $req->execute();
        $_SESSION['equipement'] = $req->fetchAll();
    }

    function exist($comp) {
        for($i = 0; $i < count($_SESSION['equipement']); $i++) {
            if ($_SESSION['equipement'][$i]->id_equipement == $comp) {
                return (true);
            }
        }
        return (false);
    }

    function value($comp) {
        for($i = 0; $i < count($_SESSION['equipement']); $i++) {
            if ($_SESSION['equipement'][$i]->id_equipement == $comp) {
                return ($i);
            }
        }
        return (-10);
    }

    function add($data) {
        global $pdo;
        $req = $pdo->prepare("INSERT INTO equipements VALUES (:id_equipement, :type, :marque, :modele, :salle, :date_achat, :num_serie, :id_users)");
        $req->execute($data);
    }

    function update($info) {
        global $pdo;
        $req = $pdo->prepare("UPDATE equipements SET type = :type, marque = :marque, modele = :modele, salle = :salle,
         date_achat = :date_achat, num_serie = :num_serie, id_users = :id_users WHERE equipements.id_equipement = :id_equipement");
        $req->execute($info);
    }

    function delete($id) {
        global $pdo;
        $req = $pdo->prepare("DELETE FROM equipements WHERE id_equipement=:id_equipement");
        $req->execute($id);
    }

    function equipement($index, $field) {
        if ($_SESSION['equipement'][$index]->$field == $field) {
            return ('<tr><td>'.$_SESSION['equipement'][$index]->id_equipement.'</td><td>'.$_SESSION['equipement'][$index]->type.'</td>
            <td>'.$_SESSION['equipement'][$index]->marque.'</td><td>'.$_SESSION['equipement'][$index]->modele.'</td>
            <td>'.$_SESSION['equipement'][$index]->salle.'</td><td>'.$_SESSION['equipement'][$index]->date_achat.'</td>
            <td>'.$_SESSION['equipement'][$index]->num_serie.'</td><td>'.$_SESSION['equipement'][$index]->id_users.'</td></tr>');
        }
    }

    function this_equipement($index, $user_id) {
        if ($_SESSION['equipement'][$index]->id_users == $user_id) {
            return ('<tr><td>'.$_SESSION['equipement'][$index]->id_equipement.'</td><td>'.$_SESSION['equipement'][$index]->type.'</td>
            <td>'.$_SESSION['equipement'][$index]->marque.'</td><td>'.$_SESSION['equipement'][$index]->modele.'</td>
            <td>'.$_SESSION['equipement'][$index]->salle.'</td><td>'.$_SESSION['equipement'][$index]->date_achat.'</td>
            <td>'.$_SESSION['equipement'][$index]->num_serie.'</td><td>'.$_SESSION['equipement'][$index]->id_users.'</td></tr>');
        }
    }

    function display_all($index, $type) {
        if ($_SESSION['equipement'][$index]->type == $type) {
            return ('<tr><td>'.$_SESSION['equipement'][$index]->id_equipement.'</td><td>'.$_SESSION['equipement'][$index]->type.'</td>
            <td>'.$_SESSION['equipement'][$index]->marque.'</td><td>'.$_SESSION['equipement'][$index]->modele.'</td>
            <td>'.$_SESSION['equipement'][$index]->salle.'</td><td>'.$_SESSION['equipement'][$index]->date_achat.'</td>
            <td>'.$_SESSION['equipement'][$index]->num_serie.'</td><td>'.$_SESSION['equipement'][$index]->id_users.'</td></tr>');
        }
    }

    function display_supp($index) {
        return ('<td><form action="" methode="POST"><input type="submit" name="id_equipement" value="' . $_SESSION['equipement'][$index]->id_equipement . '"></form></td>');
    }
}
    $equipement = new Equipement();
?>