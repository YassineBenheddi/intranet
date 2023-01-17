<?php $auth->allow('admin');?>
<?php $page = 'Admin Base de données';?>
<?php require 'inc/navbare.php'?>
<?php
if(isset($_POST['token']) && $_POST['token']=='baseDD') {
    $database ='Euratech';
    $user = 'root';
    $pass ='root';
    $server ='localhost';

    $export_path = $database[0].'_'.date("Y-m-d-H-i-s").'.gz';
    $command = 'mysqldump --opt -h '.$server.' -u '.$user.' -p'.$pass.' '.$database.' > '.$export_path;
    $output = array();
    exec($command,$output,$worked);
}
?>

<form action="" method="POST">
    <input type="text" name="token" placeholder="token" required>
    <button class="submit">Lancer la sauvegarde !</button>
</form><br>
<?php require 'inc/footer.php'?>