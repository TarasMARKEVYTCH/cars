<header class="header d-flex w-100 ">
    <nav class="navbar w-100 navbar-dark bg-transparent p-3">
        <div class="container-fluid d-flex">
            <a href="index.php" class="navbar-brand">Our garage</a>
            <div class="dropdown  col-6 col-md-2">
                <?php
                if (isset($_SESSION['id'])) {
                ?>
                    <button class="btn btn-outline-warning dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['name']; ?>
                    </button>
                <?php } else { ?>
                    <button class="btn btn-outline-warning dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                <?php }
                ?>
                <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuButton1">
                    <?php if (isset($_COOKIE['name'])) { ?>
                        <li><a href="allCars.php" class="dropdown-item" name="connect" type="submit">Notre garage</a></li>
                        <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                        <?php if ($_COOKIE['name'] === 'admin') { ?>
                            <li><a href="create.php" class="dropdown-item" name="connect" type="submit">Ajouter un vehicule</a></li>
                        <?php } ?>
                        <li>
                            <form method="POST" action=""><button class="dropdown-item" id="deconnect" type="submit" name="deconnect" >Se deconnecter</button></form>
                            <?php if(isset($_POST['deconnect'])){
                             $controller = new \Controllers\User();
                             $controller->deconnect();   
                            }?> 
                        </li>
                        <li><a href="user.php" class="dropdown-item">Mon compte</a></li>
                    <?php } else { ?>
                        <li><a href="allCars.php" class="dropdown-item text-warning" name="connect" type="submit">Notre garage</a></li>
                        <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                        <li><a href="login.php" class="dropdown-item" name="connect" type="submit">Se connecter</a></li>
                        <li><a href="signUp.php" class="dropdown-item" name="connect" type="submit">Créer un compte</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>