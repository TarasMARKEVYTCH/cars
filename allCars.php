<?php
session_start();
// require_once('libraries/autolload.php');
require __DIR__ . '/libraries/controllers/Car.php';
require __DIR__ . '/includes/head.php';
require_once('libraries/Application.php');
\Application::delete();
\Application::insert();
?>

<body class="d-flex flex-column justify-content-between h-100">
    <?php
    require __DIR__ . '/includes/Header.php';
    require __DIR__ . '/includes/carousel.php';
    ?>
    <main class="m-5">
        <div class="container-fluid d-flex ">
            <div class="car-list d-flex flex-wrap col-12 mx-auto justify-content-around gap-3">
                <?php
                $cars = new \Controllers\Car(); 
                $cars = $cars->getAllCars();
                foreach ($cars[0] as $car) {
                    if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') { ?>
                        <div class="card bg-warning col-12 col-md-4" style="width: 25rem;">
                            <div class="card-body">
                                <h3 class="card-title"><?= $car['name']; ?></h3>
                                <h5 class="card-title"><?= $car['model']; ?></h5>
                            </div>
                            <a href="carArticle.php?id=<?= $car['id']; ?>"><img src="./media/pictures/<?= $car['img']; ?>" class="card-img-top" alt="..."></a>
                        </div>
                        <?php } else {

                        if ($car['access'] == 0) { ?>
                            <div class="booked">
                                <h2 class="text-danger text-center booked-text mx-auto">Réservé</h2>
                                <div class="card bg-warning booked-car" style="width: 22rem; opacity: 0.7">
                                    <div class="card-body">
                                        <h3 class="card-title"><?= $car['name']; ?></h3>
                                        <h5 class="card-title"><?= $car['model']; ?></h5>
                                    </div>
                                    <a href="carArticle.php?id=<?= $car['id']; ?>"><img src="./media/pictures/<?= $car['img']; ?>" class="card-img-top" style="opacity: 0.6" alt="..."></a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="card bg-warning col-12 col-md-5" style="width: 22rem;">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $car['name']; ?></h3>
                                    <h5 class="card-title"><?= $car['model']; ?></h5>
                                </div>
                                <a href="carArticle.php?id=<?= $car['id']; ?>"><img src="./media/pictures/<?= $car['img']; ?>" class="card-img-top" alt="..."></a>
                            </div>
                        <?php }
                        ?>
                <?php }
                }
                ?>
                <div class="pagination w-100 gap-2 justify-content-center mt-3">
                    <?php
                    // pagionation script
                    for ($i = 1; $i <= $cars[1]; $i++) {
                        if ($cars[2] != $i) {
                    ?>
                            <a class="border border-warning text-info text-center rounded" style="width:2rem" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        <?php } else { ?>
                            <a class="border border-dark text-dark text-center rounded bg-warning" style="width:2rem"><?= $i; ?></a>

                    <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    require __DIR__ . '/includes/Footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
</body>