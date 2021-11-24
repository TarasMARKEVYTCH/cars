<?php
require __DIR__ . '/controllers/oneCar.php';
require __DIR__ . '/controllers/bookCar.php';
require __DIR__ . '/includes/head.php';
?>

<body>
    <?php require __DIR__ . '/includes/Header.php';
    ?>
    <main class="mt-5">
        <?php if (isset($msg)) { ?> <h2 class="text-info text-center"><?= $msg; ?></h2><?php } ?>
        <div class="card d-flex m-3 flex-wrap flex-row mx-auto bg-dark">
            <img src="media/pictures/<?= $car['img']; ?>" class="card-img-top d-flex img-card" alt="...">
            <h2 class="text-light mx-auto">Vous avez choisi: <i><?= $car['name'] . ' ' . $car['model']; ?></i></h2>
            <div class="card-body bg-warning d-flex flex-column justify-content-between one-car-body">
                <h2 class="card-title"><b><?= $car['name']; ?></b></h2>
                <h3 class="card-title"><?= $car['model']; ?></h3>
                <h6 class="card-title"><b>Engine</b>: <?= $car['engine']; ?></h6>
                <h6 class="card-title"><b>Year</b>: <?= $car['year']; ?></h6>
                <p class="card-text"><b>Catégorie: </b><?= $car['categorie_name']; ?></p>
                <?php if(isset($_SESSION['name']) && $_SESSION['name'] === 'admin'){ ?>
                      <p class="w-100">Commandée <b class="bg-light p-1"><?= $car['book_count']; ?></b> fois</p>
                      <p class="card-text"><b>Disponibilité:</b><br><?php if ($car['access'] == 1) { ?> <span class="text-success p-2"><?= 'Oui'; ?></span><?php } else { ?> <span class="text-danger fs-5 p-2">Reservé par utilisateur - <b class="bg-light p-1"><?= $car['user_name']; ?></span><?php }; ?></b></p>
                        <?php } ?>
                <div class="d-flex flex-wrap justify-content-start gap-5 p-5">
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-around gap-2"><img class="logo" src="./images/group.png" alt="group image">
                        <p class="m-auto"><?= $car['seats']; ?> places</p>
                    </div>

                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-around gap-2"><img class="logo" src="./images/Gasoline.png" alt="">
                        <p class="m-auto"><?= $car['engine']; ?></p>
                    </div>

                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-around gap-2"><img class="logo" src="./images/Gearbox.png" alt="">
                        <p class="m-auto"><?= $car['gearbox']; ?></p>
                    </div>

                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-around gap-2"><img class="logo" src="./images/snowflake.png" alt="">
                        <p class="m-auto"><?= $car['climatisation']; ?></p>
                    </div>

                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-around gap-2"><img class="logo" src="./images/car-door.png" alt="">
                        <p class="m-auto"><?= $car['doors']; ?> portières</p>
                    </div>

                </div>
                <p class="card-text"><b>Description:</b><br><?= $car['description']; ?></p>
                <form class="buttons d-flex gap-2" method="POST">
                    
                    <?php if (isset($_COOKIE['name']) && $_COOKIE['name'] === 'admin') {
                    ?>
                        <a href="edition.php?id=<?= $_GET['id']; ?>" class="btn btn-info w-50" name="reservedCar">Modifier</a>
                        <a href="./controllers/deleteCarController.php?id=<?= $_GET['id']; ?>" class="btn btn-danger w-50" name="deleteCar">Supprimer</a>
                        <?php } else if (isset($_SESSION['id'])) {
                        if ($car['access'] == 1) { ?>

                            <button class="btn btn-dark w-50 mx-auto" type="submit" name="bookCar" value="<?= $_GET['id']; ?>">Reserver</button>
                        <?php } else { ?>
                            <h2 class="btn-dark w-50 bg-danger text-center text-light mx-auto p-2 fs-6" name="bookCar">Voiture reservée</h2>

                        <?php }
                    } else { ?>
                        <a href="./login.php" class="mx-auto text-warning bg-dark p-2">Connectez-vous pour réserver cette voiture</a>
                    <?php } ?>
                </form>
            </div>
        </div>
    </main>
    <?php
    require './includes/Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>
</body>