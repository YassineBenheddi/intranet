<?php require 'inc/navbare.php'?>
<?php $_SESSION=array(); ?>
<?php $bad_idd = 0;?>
<?php 
    if (!empty($_POST)) {
        $errors = array();
        if (!preg_match('/[a-z0-9A-Z_.]/', $_POST['username'])) {
            $error['username'] = "Votre pseudo n'est pas valide";
        }
        if ($auth->login($_POST)) {
            header("location:?p=login/home");
        } else {
            $bad_idd = 1;
        }
    }
?>

<h1 class="hello">Bienvenue sur notre site</h1>
<form action="" method="POST">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" name="username" placeholder="Entrez votre nom d'utilisateur" required><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" name="password" placeholder="Entrez votre mots de passe" required><br><br>
<?php if ($bad_idd == 1): ?>
    <p>Mauvais identifiant !</p>
<?php endif;?>
    <input type="submit" value="Se connecter">
</form>
<?php require 'inc/footer.php'?>