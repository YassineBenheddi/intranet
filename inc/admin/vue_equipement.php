<?php $auth->allow('admin');?>
<?php $equipement->all_equipement();?>
<?php $page = 'Parc informatique';?>
<?php require 'inc/navbare.php'?>
<?php $test = 0?>

<?php 
    if (!empty($_POST)) {
        if ($_POST['marque'] && $equipement->exist($_POST['id_equipement'])) {
            $equipement->update($_POST);
            header("location:?p=login/home");
        } elseif ($_POST['marque'] && !$equipement->exist($_POST['id_equipement'])) {
            $equipement->add($_POST);
            header("location:?p=login/home");
        } elseif (!$_POST['marque'] && $_POST['id_equipement']) {
            $equipement->delete($_POST);
            header("location:?p=login/home");
        }
    }
?>
<div class="centre">
    
    <h1>Ajouter / Modifier un équipement</h1><br>
        <div class="norme-centre">
        <h2>⚠ Attention ⚠</h2>
        <p>Modifier : indiquez un identifiant d'équipement existant et modifier l'ensemble des informations</p>
        <p>Ajouter : indiquez un identifiant d'équipement qui n'existe pas et remplir l'ensemble des champs.</p>
        <h3>Plage d'identifiants équipements</h3>
        <p>Routeur : 0 à 100</p>
        <p>Serveur : 200 à 500</p>
        <p>Switch : 10 000 à 19 999 </p>
        <p>Ordinateur Fix : 30 000 à 49 999</p>
        <p>Ordinateur Portable : 50 000 à 69 999</p>
        <p>Téléphone Portable : 70 000 à 89 999</p>
    </div>
</div>
<form action="" method="POST">
<label for="id_equipement">Identifiant de l'équipement :</label><br>
    <input type="text" name="id_equipement" placeholder="ID-equipement" required>
    <label for="type">Type d'équipement :</label><br>
    <select name="type" required>
        <option value="LAPTOP">LAPTOP</option>
        <option value="COMPUTER">COMPUTER</option>
        <option value="SMARTPHONE">SMARTPHONE</option>
        <option value="SERVER">SERVER</option>
        <option value="SWITCH">SWITCH</option>
        <option value="ROUTER">ROUTER</option>
    </select>
    <label for="marque">Marque :</label><br>
    <input type="text" name="marque" placeholder="Marque" required>
    <label for="modele">Modèle :</label><br>
    <input type="text" name="modele" placeholder="Modèle" required>
    <label for="salle">Salle :</label><br>
    <input type="text" name="salle" placeholder="Salle" required>
    <label for="date_achat">Date d'achat :</label><br>
    <input type="date" name="date_achat" placeholder="jj-mm-aaaa" required>
    <label for="num_serie">Numéro de série unique :</label><br>
    <input type="text" name="num_serie" placeholder="Numéro de série" required>
    <label for="id_users">Identifiant utilisateur :</label><br>
    <input type="text" name="id_users" placeholder="ID-USERS" requieres>
    <input type="submit" value="Ajouter">
</form></br>
<div class="centre">
<h1>Supprimer un équipement</h1><br>
</div>
<form action="" method="POST">
    <label for="id_equipement">Identifiant de l'équipement :</label><br>
    <input type="text" name="id_equipement" placeholder="ID-equipement" required>
    <input type="submit" value="Supprimer">
</form><br>
<div class="centre">
<h1>Liste des Equipements</h1><br>
</div>
<table>
    <thead>
        <tr>
            <th colspan="8">Liste des équipements</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID-equipement</td>
            <td>Type</td>
            <td>Marque</td>
            <td>Modèle</td>
            <td>Salle</td>
            <td>Date d'achat</td>
            <td>numéro de série</td>
            <td>ID-USER</td>
        </tr>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php print($equipement->display_all($i, 'LAPTOP'));?>
<?php endfor; ?>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php echo $equipement->display_all($i, 'COMPUTER');?>
<?php endfor; ?>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php echo $equipement->display_all($i, 'SMARTPHONE');?>
<?php endfor; ?>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php echo $equipement->display_all($i, 'SERVER');?>
<?php endfor; ?>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php echo $equipement->display_all($i, 'SWITCH');?>
<?php endfor; ?>
<?php for($i = 0; $i < count($_SESSION['equipement']); $i++): ?>
<?php echo $equipement->display_all($i, 'ROUTER');?>
<?php endfor; ?>
</tbody>
</table>
<?php require 'inc/footer.php'?>