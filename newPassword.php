<?php
session_start();
require  __DIR__ . '/libraries/controllers/User.php';
require __DIR__ . '/includes/head.php';
require_once('libraries/Application.php');
?>
<body>
    <main class="d-flex flex-column align-items-center text-center login h-100 p-5 mx-auto">
    <?php
        try { ?>
            <h1>Noveau mot de passe</h1>
            <form class="d-flex flex-column gap-2 align-items-start text-center my-auto connect-form m-3 p-5" action="" method="POST">
                <h2 class="mx-auto text-info">Confirmation mot de passe</h2>    
                <input type="password" name="new_pass1" required placeholder="Nouveau password"><span></span>
                <input type="password" name="new_pass2" required placeholder="Confirmez nouveau password"><span></span>
                <input type="submit" class="mx-auto w-50 btn-outline-info" id="validPass" name="validPass" value="Reinitializer">
            </form>
        <?php
        if(isset($_POST['validPass'])){ 
            $controller = new \Controllers\User();
            $controller->updatePassword(); 
        }
     } catch (Exception $e){?>
            <h2 class="mx-auto text-danger"><?= $e->getMessage(); ?></h2>
            <?php }
        ?>
    </main>
</body>