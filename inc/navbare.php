<nav>
  <div class="nav-container">
<?php if (!$_SESSION): ?>
  <a href="?p=index"><h1 class="nav-title">Euratech</h1></a>
    <a href="?p=login/login"><button class="nav-menu-button">Connexion</button></a>
<?php elseif ($_SESSION['auth']): ?>
  <a href="?p=login/home"><h1 class="nav-title">Euratech</h1></a>
    <h1 class="nav-subtitle"><?php echo $page ?></h1>
    <div class="nav-menu">
      <button class="nav-menu-button">Menu</button>
      <div class="nav-menu-items">
<?php if ($auth->user('slug') == 'admin'): ?>
        <a href="?p=admin/vue_user">Administration utilisateurs</a>
        <a href="?p=admin/vue_equipement">Parc Informatique</a>
<?php endif ?>
        <a href="?p=member/ticket">GLPI</a>
        <a href="?p=member/application1">Exemple Appli membre</a>
        <a href="?p=member/profil">Mon profil</a>
        <a href="?p=login/logout">Déconnexion</a>
      </div>
    </div>
<?php endif; ?>
  </div>
</nav>
<br><br><br>