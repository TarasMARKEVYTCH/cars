<?php
require __DIR__ . '/controllers/connection.php';
require __DIR__ . '/includes/head.php'; ?>

<body>
    <main class="d-flex flex-column align-items-center text-center login h-100 mx-auto">
        <form class="d-flex flex-column gap-2 align-items-start text-center my-auto connect-form m-3 p-5" action="#" method="POST">
            <h2 class="mx-auto text-info">LogIn</h2>
            <label for="nickname" class="text-info">Identifiant:</label>
            <input type="text" name="nickname" id="nickname" placeholder="Name">
            <label for="password" class="text-info">Votre mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <input type="submit" class="mx-auto w-50 btn-outline-info" name="connect" value="Se connecter">
            <div class="link d-flex flex-wrap mx-auto justify-content-around">
                <a href="./index.php" class="text-warning w-100 m-2">Page d'accueil</a>
                <a href="./signUp.php" class="text-warning w-100">Pas de compte?</a>
                <a href="./recup.php" class="text-warning w-100 mt-2" style="font-size: 0.8rem; text-decoration:underline">Mot de passe oublié</a>
            </div>
            <?php if (isset($err)) { ?><h2 class="mx-auto text-danger"><?= $err; ?></h2>
            <?php }
            ?>
        </form>
    </main>
</body>

</html>