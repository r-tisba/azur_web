<nav class="navbar navbar-dark navbar-expand-md bg-dark flex-row">
    <a class="navbar-brand titre" href="/utilisateur/index.php">
        <img src="../../images/design/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Azur
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarNavDropdown">
        <div class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-item nav-link" href="/azur_web/utilisateur/profil.php">Profil</a>
            </li>
        </div>

        <div class="navbar-nav ml-auto">
            <?php
            if (isset($_SESSION["identifiant"]) && !empty($_SESSION)) {
            ?>

                <div class="div-inline my-2 my-sm-0">
                    <a class="nav-item active nav-link apercu_connexion">
                        <?= "Vous êtes connecté " . $_SESSION["identifiant"] ?>
                    </a>
                </div>
                <a class="btn btn-outline-danger ml-1" href="/utilisateur/deconnexion.php">Se déconnecter</a>
            <?php
            }
            ?>
        </div>
    </div>
</nav>