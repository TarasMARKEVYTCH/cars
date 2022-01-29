<?php
session_start();
// require_once('libraries/autolload.php');
require __DIR__ . '/libraries/controllers/User.php';
require __DIR__ . '/libraries/controllers/Car.php';
require __DIR__ . '/includes/head.php';
$user = new \Controllers\User();
$user = $user->getStatistics();
$carModel = new \Controllers\Car();
$cars = $carModel->getStatistic();
?>

<body>
    <?php require_once('includes/Header.php');
    if ($_SESSION['name'] === 'admin') { ?>
        <main class="d-flex flex-wrap align-items-center m-2">
            <?php
            $u = new \Controllers\User();
            $u = $u->getOneUser();
            ?>
            <div class="avatar d-flex justify-content-center align-items-center mx-auto">
                <img src="./assets/media/users/<?= $u['img']; ?>" class="avatar-img" alt="">
            </div>

            <h2 class="text-warning user-name w-100 text-center m-4"><?= strtoupper($u['user_name']); ?></h2>
            <form action="" method="POST" class="mx-auto">
                <a href="user-update.php" name="modified-profile" id="modified-profile" class="btn btn-outline-warning text-center">Modifier mon profil</a>
            </form>
            <table class="table table-dark table-hover table-bordered border-warning">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modéle</th>
                        <th scope="col">Disponible</th>
                        <th scope="col">Réservé par</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $count = 0;
                foreach ($cars as $car) {
                    $count = $count + 1;
                ?>
                    <tr>
                        <th scope="row"><?= $count; ?></th>
                        <td><?= $car['name']; ?></td>
                        <td><?= $car['model']; ?></td>
                        <td><?php if($car['access'] === '1'){ echo 'Oui'; } else {echo 'Non';}; ?></td>
                        <td><?= $car['user_name']; ?></td>
                        <td class="text-center"><a href="carArticle.php?id=<?= $car['car_id']; ?>" class="text-warning" name="reservedCar">Voir les details</a></td>
                    </tr>
                    
                <?php }
                ?>
                </tbody>
            </table>
        </main>
    <?php } else { ?>
        <main class="d-flex flex-wrap align-items-center m-2">
            <?php
            $u = new \Controllers\User();
            $u = $u->getOneUser();
            ?>
            <div class="avatar d-flex justify-content-center align-items-center mx-auto">
                <img src="./assets/media/users/<?= $u['img']; ?>" class="avatar-img" alt="">
            </div>

            <h2 class="text-warning user-name w-100 text-center m-4"><?= strtoupper($u['user_name']); ?></h2>
            <form action="" method="POST" class="mx-auto">
                <a href="user-update.php" name="modified-profile" id="modified-profile" class="btn btn-outline-warning text-center">Modifier mon profil</a>
            </form>
            <div class="info d-flex justify-content-between w-100 m-5">
                <div class="info-item text-info text-center"><span>12</span>
                    <h3>lorem</h3>
                </div>
                <div class="info-item text-info text-center"><span>2</span>
                    <h3>lorem</h3>
                </div>
                <div class="info-item text-info text-center"><span>11</span>
                    <h3>lorem</h3>
                </div>
                <div class="info-item text-info text-center"><span>4</span>
                    <h3>lorem</h3>
                </div>
            </div>
            <section class="reservations w-100 d-flex flex-column justify-content-around">
                <h2 class="text-warning text-center">Mes réservations</h2>
                <?php
                $count = 0;
                foreach ($user as $u) {
                    $count = $count + 1;
                    $u['book_date'] = date("d.m.Y");
                ?>
                    <div class="reservation-item d-flex justify-content-between align-items-center m-2 w-100">
                        <sapn class="text-warning"><?= $count; ?></sapn>
                        <h2 class="text-warning"><?= $u['name'] . ' ' . $u['model']; ?></h2>
                        <p class="text-warning"><?= $u['book_date']; ?></p>
                    </div>
                <?php }
                ?>
            </section>
        </main>
    <?php
        require __DIR__ . '/includes/Footer.php';
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./assets/js/index.js"></script>
</body>