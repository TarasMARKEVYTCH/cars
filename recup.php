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
                    <form class="d-flex flex-column gap-2 align-items-start text-center my-auto connect-form m-3 p-5" action="" method="POST">
                        <h2 class="mx-auto text-info">Récuperation de mot de passe</h2>
                        <label for="nickname" class="text-info">Identifiant:</label>
                        <input type="text" name="nickname" id="nickname" placeholder="Name">
                        <label for="email" class="text-info">Votre adresse mail:</label>
                        <input type="email" name="email" id="email" placeholder="Adresse mail">
                        <input type="submit" class="mx-auto w-50 btn-outline-info" id="reinitPass" name="reinitPass" value="Envoyer">
                        <div class="link d-flex flex-wrap mx-auto justify-content-around">
                            <a href="./index.php" class="text-warning w-100 m-2">Page d'accueil</a>
                        </div>
                    <?php
                        if(isset($_POST['reinitPass'])){ 
                            $controller = new \Controllers\User();
                            $controller->reInitPassword(); 
                        }
                } catch (Exception $e){ ?>
                <h2 class="mx-auto text-danger"><?= $e->getMessage(); ?></h2>
                <?php 
                }?>
                    </form>

    </main>
</body>
</html>