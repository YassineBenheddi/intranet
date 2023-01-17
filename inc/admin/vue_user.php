<?php $auth->allow('admin');?>
<?php $users->show();?>
<?php $page = 'Admin Utilisateurs';?>
<?php require 'inc/navbare.php'?>

<?php 
    if (!empty($_POST)) {
        if ($_POST['nom'] && $users->exist($_POST['id_users'])) {
            $users->update($_POST, $_POST['prenom'].".".$_POST['nom']."@euratech.sio", $_POST['prenom'].".".$_POST['nom']);
            for($i = 0; $i < count($_SESSION['users']); $i++) {
                if ($_SESSION['users'][$i]->id_users == $_POST['id_users']) {
                    $users->delete_privilage($_SESSION['users'][$i]->pseudo);
                }
            }
        $users->create_privilage($_POST, $_POST['prenom'] . "." . $_POST['nom']);
            header("location:?p=login/home");
        } elseif ($_POST['nom'] && !$users->exist($_POST['id_users'])) {
            $users->add($_POST, $_POST['prenom'].".".$_POST['nom']."@euratech.sio", $_POST['prenom'].".".$_POST['nom']);
            $users->create_privilage($_POST, $_POST['prenom'].".".$_POST['nom']);
            header("location:?p=login/home");
        } elseif (!$_POST['nom'] && $_POST['id_users']) {
            $users->delete($_POST);
            for($i = 0; $i < count($_SESSION['users']); $i++) {
                if ($_SESSION['users'][$i]->id_users == $_POST['id_users']) {
                    $users->delete_privilage($_SESSION['users'][$i]->pseudo);
                }
            }
            header("location:?p=login/home");
        }
    }
?>
</br>
<div class="centre">
    <h1>Ajouter / Modifier</h1>
    <div class="norme-centre">
        <h2>⚠ Attention ⚠</h2>
        <p>Modifier : indiquez un identifiant d'utilisateur existant et modifier l'ensemble des champs.</p>
        <p>Ajouter : indiquez un identifiant d'utilisateur qui n'existe pas et remplir l'ensemble des champs.</p><br>
        <h3>Format :</h3>
        <p>Nom : NOM (en majuscule)</p>
        <p>Prénom : Prenom (Première lettre en majuscule)</p>
        <p>Mot de passe : Minimum 8 caractères, majuscule, minuscule, caractère spéciaux</p>
        <p>Role : 1 (entrez 1 ou 2 en fonction des droits de l'utilisateur)</p>
    </div>
</div>
<form action="" method="POST">
    <label for="id_users">Identifiant utilisateur :</label><br>
    <input type="text" name="id_users" placeholder="ID-USER" required>
    <label for="nom">Nom :</label><br>
    <input type="text" name="nom" placeholder="Nom" required>
    <label for="prenom">Prénom :</label><br>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <label for="password">Mot de passe :</label><br>
    <input type="password" name="password" placeholder="Password" required>
    <label for="id_roles">Identifiant role (1: Administrateur, 2: Membre) :</label><br>
    <input type="number" name="id_roles" placeholder="ID-ROLE (1 : MEMBRE - 2 : ADMIN)" min="1" max="2" required><br><br>
    <input type="submit" value="Ajouter">
</form>
</br>
<div class="centre">
    <h1>Suppression</h1>
    <p>Supprimer : indiquez un identifiant urilisateur existant afin de le supprimer définitivement</p><br>
</div>
<form action="" method="POST">
    <input type="text" name="id_users" placeholder="ID-USER" required>
    <input type="submit" value="Supprimer">
</form><br>
<div class="centre">
<h1>Liste des Utilisateurs</h1><br>
</div>
<table>
    <thead>
        <tr>
            <th colspan="5">Liste des utilisateurs</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID-USER</td>
            <td>Prénom</td>
            <td>Nom</td>
            <td>Email</td>
            <td>Pseudo</td>
        </tr>
<?php for($i = 0; $i < count($_SESSION['users']); $i++): ?>
<tr><?php echo $users->display_all($i);?></tr>
<?php endfor; ?>
</tbody>
</table>
<?php require 'inc/footer.php'?>