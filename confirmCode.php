<?php
session_start();
require  __DIR__ . '/libraries/controllers/User.php';
require __DIR__ . '/includes/head.php';
require_once('libraries/Application.php');
?>
<body>
    <main class="d-flex flex-column align-items-center text-center login h-100 p-5 mx-auto">
    <?php 
    $controller = new \Controllers\User();
        try { ?>
                <h1 class="mx-auto text-info">Recuperation de mot de passe</h1>
                <form class="d-flex flex-column gap-2 align-items-start text-center my-auto connect-form m-3 p-5" action="" method="POST">
                    <input type="text" class="text-info" name="controlCode" required placeholder="Code de confirmation">
                    <input type="submit" class="mx-auto w-50 btn-outline-info" name="validCode" value="Valider">
                </form>
            <?php 
                if(isset($_POST['validCode'])){ 
                    $controller = new \Controllers\User();
                    $controller->confirmCode(); 
                }
        } catch (Exception $e){ ?>
                <h2 class="mx-auto text-danger"><?= $e->getMessage(); ?></h2>
            <?php } ?>
    </main>
</body>