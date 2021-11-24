<!DOCTYPE html>
<?php require './includes/head.php'; ?>

<body class="d-flex flex-column justify-content-between h-100">
    <?php require './includes/Header.php'; ?>
    <main class="p-5">
        <h2 class="text-warning text-center mt-4">Nous contacter</h2>
        <form class="d-flex flex-column p-5 gap-3">
            <label for="name" class="text-warning">Votre nom:</label>
            <input type="text" name="name" id="name" placeholder="Votre nom">
            <label for="mail" class="text-warning">Votre email</label>
            <input type="email" name="mail" id="mail" placeholder="Votre adresse mail">
            <label for="reason" class="text-warning">Nous contacter pour:</label>
            <select name="reason" id="reason">
                <option>-- Objet --</option>
                <option value="">Service</option>
                <option value="">Maintenance</option>
                <option value="">Autres</option>
            </select>
            <textarea class="p-3" name="message" id="message" cols="30" rows="10"></textarea>
            <input class="btn btn-outline-warning w-50 mx-auto" type="submit" name="contactBtn" id="contactBtn" value="Envoyer">
        </form>

    </main>


    <?php require './includes/Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/index.js"></script>

</body>

</html>