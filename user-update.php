<?php
session_start();
// require_once('libraries/autolload.php');
require __DIR__ . '/libraries/controllers/User.php';
require __DIR__ . '/includes/head.php';
// require_once('./libraries/utils.php');
$user = new \Controllers\User();
$user = $user->getStatistics();
?>

<body>
    <?php require_once('includes/Header.php');
    $u = new \Controllers\User();
    $u = $u->getOneUser();
    ?>
    <main class="d-flex flex-wrap flex-column align-items-center m-2">
        <form method="POST" enctype="multipart/form-data" class="m-auto d-flex flex-column w-50">
            <div class="avatar d-flex justify-content-center align-items-center mx-auto">
                <img src="assets/media/users/<?= $u['img']; ?>" id="output" class="avatar-img">
                <input type="file" accept="image/*" id="userImg" onchange="loadFile(event)" name="userImg">
                <svg version="1.1" id="camera" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 15" enable-background="new 0 0 25 15" xml:space="preserve">
                    <path id="cameraFrame" fill="none" stroke="white" stroke-miterlimit="10" d="M23.1,14.1H1.9c-0.6,0-1-0.4-1-1V1.9c0-0.6,0.4-1,1-1h21.2
                        c0.6,0,1,0.4,1,1v11.3C24.1,13.7,23.7,14.1,23.1,14.1z" />
                    <path id="circle" fill="none" stroke="#ffffff" stroke-width="1.4" stroke-miterlimit="12" d="M17.7,7.5c0-2.8-2.3-5.2-5.2-5.2S7.3,4.7,7.3,7.5s2.3,5.2,5.2,5.2
                        S17.7,10.3,17.7,7.5z" />
                    <g id="plus">
                        <path fill="none" id="plusLine" class="line" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" d="M20.9,2.3v4.4" />
                        <path fill="none" class="line" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" d="M18.7,4.6h4.4" />
                    </g>
                </svg>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label text-warning">Changer l'adresse mail</label>
                <input type="email" name="mail" id="mail" class="form-control " placeholder="Adresse mail">
            </div>
            <div class="mb-3">
                <label for="mail2" class="form-label text-warning">Confirmer l'adresse mail</label>
                <input type="email" name="mail2" id="mail2" class="form-control " placeholder="Adresse mail">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label text-warning">Changer le mot de passe</label>
                <input type="password" name="pass" id="pass" class="form-control " placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="pass2" class="form-label text-warning">Confirmer le mot de passe</label>
                <input type="password" name="pass2" id="pass2" class="form-control " placeholder="Confirm pasword">
            </div>
            <input type="submit" class="btn btn-outline-warning w-25 mx-auto" name="updateUser" value="Valider">
            <i class="text-warning text-center mt-3">ou</i>
            <a href="user.php" class="fs-6 text-warning text-decoration-underline text-center mt-3">Mon compte</a>
        </form>

        <?php
        try {
            if (isset($_POST['updateUser'])) {
                $controller = new \Controllers\User();
                $controller->updateUser(); ?>
                <h2 class="mx-auto text-success"><?= $controller->getMsg(); ?></h2>
            <?php }
        } catch (Exception $e) { ?>
            <h2 class="mx-auto text-danger"><?= $e->getMessage(); ?></h2>
        <?php } ?>
    </main>
    <?php
    require __DIR__ . '/includes/Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./assets/js/index.js"></script>
</body>