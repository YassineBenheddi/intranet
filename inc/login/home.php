<?php $auth->allow('member');?>
<?php if($auth->user('id_users')): ?>
<?php $page = 'Home';?>
<?php require 'inc/navbare.php'?>

  <!--<p>Bonjour <?php /*echo $auth->info('prenom');*/?></p>-->

  <div class="home">

<?php if($auth->user('slug') == 'admin'):?>
  
    <div class="home-items">
    <div class="home-centre">
    <a href="?p=admin/vue_user" alt="Administration utilisateurs">
      <img src="img/users-solid.svg" title="Administration utilisateurs" alt="Administration utilisateurs" width="100" height="106"></img>
      <p>Administration utilisateurs</p>
      </a>
</div>
    </div>
  
    <div class="home-items">
    <div class="home-centre">
    <a href="?p=admin/vue_equipement" alt="Parc informatique">
      <img src="img/computer-solid.svg" title="Gestion du parc informatique" alt="Parc informatique" width="100" height="106"></img>
      <p>Gestion du parc informatique</p>
      </a>
</div>
    </div>

<?php endif; ?>

    <div class="home-items">
    <div class="home-centre">
    <a href="?p=member/ticket" alt="Mon profil">
      <img src="img/comment-regular.svg" title="GLPI" alt="GLPI" width="100" height="106"></img>
      <p>GLPI</p>
    </a>
</div>
    </div>
    
    
    <div class="home-items">
      <div class="home-centre">
    <a href="?p=member/profil" alt="Mon profil" class=click>
      <img src="img/user-regular.svg" title="Mon Profil" alt="Mon Profil" width="100" height="106"></img>
      <p>Mon Profil</p>
      </a>
      </div>
    </div>

<?php endif; ?>

  </div>
  <?php require 'inc/footer.php'?>