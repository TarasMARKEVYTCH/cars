<?php
session_start();
// require_once('libraries/autolload.php');
require_once('libraries/controllers/Car.php');
require_once('libraries/Application.php');
// \Application::update();
?>
<!DOCTYPE html>
<?php require __DIR__ . '/includes/head.php'; ?>

<body>
    <?php require __DIR__ . '/includes/Header.php'; ?>
    <main class="d-flex align-items-center text-center login p-5">
        <form method="POST" class="form-create d-flex text-info flex-column mx-auto gap-2 p-5 w-50" enctype="multipart/form-data" action="">
            <?php
            if (isset($msg)) { ?>
                <h3 class="d-flex text-info mx-auto m-3"><?= $msg; ?></h3>
            <?php }
            $carController = new \Controllers\Car();
            $updateCar = $carController->getOneCar();
            ?>
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
                <input type="text" name="voitureMoteur" id="voitureMoteur" value="<?= $updateCar['engine']; ?>">
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
                <label for="seats">Nombre de sieges : </label>
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
                <button type="submit" id="voitureUpdate" name="voitureUpdate" value="<?= $_GET['id']; ?>" class="btn btn-success">Modifier l'information</button>
                <a href="./index.php" class="btn btn-danger">Annuler modification</a>
            </div>
            <?php
            if (isset($message)) { ?>
                <h3 class="d-flex text-danger mx-auto mt-2"><?= $e->getM; ?></h3>
            <?php } ?>
            <?php 
                    try{
                        if(isset($_POST['voitureUpdate'])){ 
                            $controller = new \Controllers\Car();
                            $controller->updateCar(); 
                        }
                    } catch (Exception $e){ ?>
                        <h2 class="mx-auto text-danger"><?= $e->getMessage(); ?></h2>
                        <?php }?>
        </form>
        
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/index.js">
    </script>
</body>

</html>