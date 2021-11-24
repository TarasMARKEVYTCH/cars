<?php
require './controllers/signUpController.php';
require __DIR__ . '/includes/head.php'; ?>

<body>
    <main class="d-flex flex-column align-items-center text-center login h-100 m-0">
        <form class="d-flex flex-column gap-2 align-items-start text-center my-auto connect-form m-3 p-5" method="POST">
            <h2 class="mx-auto text-info">Sign Up</h2>
            <label for="name" class="text-info">Nom :</label>
            <input type="text" name="name" id="name" placeholder="Nom">
            <label for="mail1" class="text-info">Email :</label>
            <input type="email" name="mail1" id="mail1" placeholder="Email">
            <label for="mail2" class="text-info">Confirmer email :</label>
            <input type="email" name="mail2" id="mail2" placeholder="Email">
            <label for="pass1" class="text-info">Mot de passe :</label>
            <input type="password" name="pass1" id="pass1" placeholder="Mot de passe">
            <label for="pass2" class="text-info">Confirmer mot de passe:</label>
            <input type="password" name="pass2" id="pass2" placeholder="Mot de passe">
            <button type="submit" class=" btn mx-auto btn-outline-info mt-2 p-2" name="signup">Créer mon compte</button>
            <a href="./index.php" class="mx-auto text-warning">Page d'accueil</a>
            <?php if (isset($err)) { ?><h2 class="mx-auto text-danger"><?= $err; ?></h2>
            <?php }
            ?>
        </form>
    </main>
</body>

</html>