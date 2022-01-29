<?php
session_start();
// require_once('libraries/autolload.php');
require __DIR__ . '/includes/head.php';
require_once('libraries/controllers/Car.php');
?>

<body class="d-flex flex-column justify-content-between h-100">
    <?php require './includes/Header.php'; ?>
    <main class="d-flex flex-column mt-5">
        <?php
        require __DIR__ . '/includes/carousel.php';
        ?>
        <div class="container-fluid mt-5 ">
            <div class="car-list d-flex flex-wrap gap-3 justify-content-center p-3">
                <?php
                $carCat = new \Controllers\Car();
                $carCat = $carCat->carByCategorie();
                if ($carCat == false) {
                ?>
                    <h2 class="text-info fs-4 p-5 m-5">OUPS...<br><br>Pas de voiture disponibles</h2>
                    <?php } else {
                    foreach ($carCat as $car) {
                        if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') { ?>
                            <div class="card p-2 col-3" style="width: 22rem;">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $car['name']; ?></h3>
                                    <h5 class="card-title"><?= $car['model']; ?></h5>
                                </div>
                                <a href="carArticle.php?id=<?= $car['car_id']; ?>"><img src="./assets/media/pictures/<?= $car['car_img']; ?>" class="card-img-top" alt="..."></a>
                            </div>
                            <?php } else {
                            if ($car['access'] == 0) {
                            ?>
                                <div class="booked">
                                    <h2 class="text-danger text-center booked-text mx-auto">Réservé</h2>
                                    <div class="card  booked-car" style="width: 22rem; opacity: 0.8">
                                        <div class="card-body">
                                            <h3 class="card-title"><?= $car['name']; ?></h3>
                                            <h5 class="card-title"><?= $car['model']; ?></h5>
                                        </div>
                                        <a href="carArticle.php?id=<?= $car['car_id']; ?>"><img src="./assets/media/pictures/<?= $car['car_img']; ?>" class="card-img-top" style="opacity: 0.6" alt="..."></a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="card p-2 col-3" style="width: 22rem;">
                                    <div class="card-body">
                                        <h3 class="card-title"><?= $car['name']; ?></h3>
                                        <h5 class="card-title"><?= $car['model']; ?></h5>
                                    </div>
                                    <a href="carArticle.php?id=<?= $car['car_id']; ?>"><img src="./assets/media/pictures/<?= $car['car_img']; ?>" class="card-img-top" alt="..."></a>
                                </div>
                <?php }
                        }
                    }
                } ?>


            </div>
        </div>
    </main>
    <?php
    require './includes/Footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./assets/js/index.js"></script>
</body>