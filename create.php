<?php
require __DIR__ . '/libraries/controllers/Car.php';
// require_once('libraries/autolload.php');
?>
<!DOCTYPE html>
<?php require __DIR__ . '/includes/head.php'; ?>

<body class="d-flex flex-column justify-content-between h-100">
    <?php require __DIR__ . '/includes/Header.php'; ?>
    <main class="d-flex align-items-center text-center m-auto col-12 login p-3" style="height: 100vh">
        <form method="POST" action="allCars.php?controller=car&&task=insertCar" class="formCreate d-flex text-info mt-5 mx-auto flex-column gap-2 justify-content-between col-md-6" enctype="multipart/form-data">
            <div class="form-example d-flex justify-content-between">
                <label for="voitureName">Nom : </label>
                <input type="text" name="voitureName" id="voitureName" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureModel">Modele : </label>
                <input type="text" name="voitureModel" id="voitureModel" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureMoteur">Moteur : </label>
                <select name="voitureMoteur" id="voitureMoteur">
                    <option value="">-- Carburant --</option>
                    <option value="Essence">Essence</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electrique">Electrique</option>
                </select>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureYear">Année : </label>
                <input type="number" name="voitureYear" id="voitureYear" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureCategorie">Categorie : </label>
                <select name="voitureCategorie" id="voitureCategorie">
                    <option value="berline">Berline</option>
                    <option value="suv">SUV</option>
                    <option value="coupe">Coupé</option>
                    <option value="4x4">4x4</option>
                    <option value="citadine">Citadine</option>
                    <option value="electrique">Electrique</option>
                </select>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="gearBox">Boite de vitesse : </label>
                <select name="gearBox" id="gearBox">
                    <option value="">-- Type de boîte --</option>
                    <option value="Automatique">Automatique</option>
                    <option value="Manuelle">Manuelle</option>
                </select>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="doors">Portes : </label>
                <select name="doors" id="doors">
                    <option value="">-- Nombre de portes --</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="seats">Places : </label>
                <select name="seats" id="seats">
                    <option value="">-- Nombre de places --</option>
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="7">7</option>
                </select>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="luggage">Volume de coffre: </label>
                <input type="number" name="luggage" id="luggage" required>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureDesc">Description : </label>
                <textarea name="voitureDesc" id="voitureDesc" rows="2"></textarea>
            </div>
            <div class="form-example d-flex justify-content-between">
                <label for="voitureImg">IMG : </label>
                <input type="file" class="ms-auto" accept="image/*" onchange="loadFile(event)" name="voitureImg">
                <div class="new-img">
                    <img id="output" class="p-1 mx-auto">
                </div>
            </div>
            <div class="form-example d-flex justify-content-center mt-4">
                <input type="submit" name="voitureSubmit" value="Ajouter un véhicule" class="btn btn-info">
            </div>
            <?php
            if (isset($err)) { ?>
                <h3 class="d-flex text-danger mx-auto mt-2"><?= $err; ?></h3>
            <?php } ?>
            <a href="./" class="text-center text-warning">Retour</a>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/index.js"></script>
</body>

</html>