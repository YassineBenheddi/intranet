
<?php
    if(!isset($_GET['p'])){
        $_GET['p'].'.php';
    }
    if (!file_exists('inc/'.$_GET['p'].'.php')) {
        $_GET['p']='error/404';
    }
    session_start();
    include_once 'inc/db.php';
    include 'class/auth.php';
    include 'class/users.php';
    include 'class/equipement.php';
    ob_start();
    include 'inc/'.$_GET['p'].'.php';
    $content = ob_get_contents();
    ob_end_clean();
    include 'template.php';
?>