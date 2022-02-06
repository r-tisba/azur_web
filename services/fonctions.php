<?php
class Service
{
    public function dateFr($date)
    {
        if ($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)) {
            return $date = $datetime->format("d/m/Y");
        } else if ($datetime = DateTime::createfromformat("Y-m-d", $date)) {
            return $date = $datetime->format("d/m/Y");
        }
    }

    public function dateFrAvecHeure($date)
    {
        if ($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)) {
            return $date = $datetime->format("d/m/Y à H:i");
        } else if ($datetime = DateTime::createfromformat("Y-m-d", $date)) {
            return $date = $datetime->format("d/m/Y");
        }
    }
    public function heureViaDate($date)
    {
        if ($datetime = DateTime::createfromformat("Y-m-d H:i:s", $date)) {
            return $date = $datetime->format("H:i");
        } else if ($datetime = DateTime::createfromformat("Y-m-d", $date)) {
            return "Erreur dans le traitement de l'heure";
        }
    }
    public function gererGuillemets($string)
    {
        /* return str_replace('"', '\"', $string); */
        return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
    }

    public function redirect($url)
    {
        if (!headers_sent())
        {
            header('refresh:3;Location: '.$url);
            exit;
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'window.setTimeout(function() { window.location.href="'.$url.'"; }, 4000);';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="3; url='.$url.'" />';
            echo '</noscript>';
            exit;
        }
    }
    public function redirectOneSec($url)
    {
        if (!headers_sent())
        {
            header('refresh:3;Location: '.$url);
            exit;
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'window.setTimeout(function() { window.location.href="'.$url.'"; }, 1000);';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="1; url='.$url.'" />';
            echo '</noscript>';
            exit;
        }
    }
    public function redirectNow($url)
    {
        if (!headers_sent())
        {
            header('Location: '.$url);
            exit;
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0; url='.$url.'" />';
            echo '</noscript>';
            exit;
        }
    }

    public function afficherMessage($idDiscussion)
    {
        $objetMessage = new Message();
        $service = new Service();
        $dernierMessage = $objetMessage->recupererDernierMessageFull($idDiscussion);
        $idMessage = $dernierMessage["idUtilisateur"];
        $date = $dernierMessage["date"];
?>
        <a href="discussion.php?id=<?= $idDiscussion; ?>"><span class="apercu_lien"></span></a>
        <div class="container-fluid mt-100">
            <div class="row align-items-center">
                <div class="col-0 col-sm-2 col-md-2 col-lg-2 my-1 apercu_avatar">
                    <img src="<?= $dernierMessage["avatar"]; ?>" class="img-fluid rounded-circle avatarGros">
                </div>
                <div class="col-12 col-sm-10 col-md-10 col-lg-10 pl-1">
                    <?php if ($idMessage == $_SESSION["idUtilisateur"]) {
                    ?>
                        <div class="card card_apercu_perso">
                        <?php
                    } else {
                    ?>
                        <div class="card card_apercu_interlocuteur">
                        <?php
                    }
                        ?>
                            <div class="card-header pl-3">
                                <div class="media flex-wrap w-100 align-items-center">
                                    <div class="media-body">
                                        <a class="apercu_nom"><?= $dernierMessage["prenom"]; ?> <?= $dernierMessage["nom"]; ?></a>

                                        <!-- <div class="text-muted small"><?= $service->dateFrAvecHeure($date); ?></div> -->
                                    </div>
                                    <div class="text-muted small"><?= $service->heureViaDate($date); ?></div>
                                </div>
                            </div>
                            <div class="card-body p-2 pl-3">
                                <p class="apercu_message">
                                    <?= $dernierMessage["contenu"]; ?>
                                </p>
                            </div>
                        </div>
                        </div>
                </div>
            </div>

            <?php
        }
        public function dispositionMessages($message)
        {
            if ($message["idUtilisateur"] == $_SESSION["idUtilisateur"]) {
            ?>
                <div class="container-fluid containerMessage_perso col-12">
                <div class="row">
                    <div class="col-3 col-md-4"></div>
                    <div class="col-9 col-md-8">
                        <div class="card mb-4 cardMessage_perso">
                        <?php
                        } else {
                            ?>
                            <div class="container-fluid containerMessage_interlocuteur">
                            <div class="row">
                            <div class="col-9 col-md-8">
                            <div class="card mb-4 cardMessage_interlocuteur">
                            <?php
                        }
        }
}
