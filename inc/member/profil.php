<?php $auth->allow('member');?>
<?php $equipement->all_equipement();?>
<?php $page = 'Mon Profil';?>
<?php require 'inc/navbare.php'?>
<div class="centre">
<h1>Mes informations</h1>

<p>Nom : <?php print($_SESSION['auth']->nom);?></p>
<p>Prénom : <?php print($_SESSION['auth']->prenom);?></p>
<p>Pseudo : <?php print($_SESSION['auth']->pseudo);?></p>
<p>Mail : <?php print($_SESSION['auth']->email);?></p>
<p>Titre : <?php print($_SESSION['auth']->name);?></p>

<h1>Mes équipements</h1>
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
<?php print($equipement->this_equipement($i, $_SESSION['auth']->id_users));?>
<?php endfor; ?>
</tbody>
</table><br>
<div class="centre">
    <p>Attention : Si vous trouvez une erreur dans une des informations de votre profile, rédigez un ticket sur l'interface GLPI en indiquant le problème ! </p>
</div>
<?php require 'inc/footer.php'?>