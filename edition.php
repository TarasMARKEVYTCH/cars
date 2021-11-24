<?php
require __DIR__ . '/controllers/update.php';
?>
<!DOCTYPE html>
<?php require __DIR__ . '/includes/head.php'; ?>

<body>
    <?php require __DIR__ . '/includes/Header.php';
    ?>
    <main class="d-flex align-items-center text-center login p-5">
        <form method="POST" class="formCreate d-flex text-info flex-column mx-auto gap-2 p-5 w-50" enctype="multipart/form-data">
        <?php
        if (isset($msg)) { ?>
            <h3 class="d-flex text-info mx-auto m-3"><?= $msg; ?></h3>
        <?php } ?>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureName">Nom : </label>
                <input type="text" name="voitureName" id="voitureName" value="<?= $updateCar['name']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureModel">Modele : </label>
                <input type="text" name="voitureModel" id="voitureModel" value="<?= $updateCar['model']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureMoteur">Moteur : </label>
                <input type="text" name="voitureMoteur" id="voitureMoteur" value="<?= $updateCar['engine']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureYear">Année : </label>
                <input type="number" name="voitureYear" id="voitureYear" value="<?= $updateCar['year']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="gearBox">Boite de vitesse : </label>
                <input type="text" name="gearBox" id="gearBox" value="<?= $updateCar['gearbox']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="doors">Nombre de portiéres : </label>
                <input type="number" name="doors" id="doors" value="<?= $updateCar['doors']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="seats">Nombre de sie2ges : </label>
                <input type="number" name="seats" id="seats" value="<?= $updateCar['seats']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="luggage">Capacité de coffre (en sacs) : </label>
                <input type="number" name="luggage" id="luggage" value="<?= $updateCar['luggage']; ?>" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureDesc">Description : </label>
                <textarea name="voitureDesc" id="voitureDesc" rows="2"><?= $updateCar['description']; ?></textarea>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureDisp">Disponibilité : </label>
                <select name="voitureDisp" id="voitureDisp">
                    <option><?= $updateCar['access']; ?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
            <img src="media/pictures/<?= $updateCar['img']; ?>" alt="">
            <div class="form-example d-flex justify-content-between">
                <label for="voitureImg">Changer l'image : </label>
                <input type="file" class="ms-auto" accept="image/*" onchange="loadFile(event)" name="voitureImg" value="<?= $updateCar['img']; ?>">
                <div class="new-img">
                    <img id="output" class="p-1 mx-auto">
                </div>
            </div>
            <div class="form-example d-flex justify-content-center mt-4 gap-2">
                <input type="submit" name="voitureUpdate" value="Modifier l'information" class="btn btn-success">
                <a href="./index.php" class="btn btn-danger">Annuler modification</a>
            </div>
            <?php
        if (isset($err)) { ?>
            <h3 class="d-flex text-danger mx-auto mt-2"><?= $err; ?></h3>
        <?php } ?>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/index.js">
    </script>
</body>

</html>