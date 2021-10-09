<?php

class Service
{
    public function dateFr($date)
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
            return "Erreur dans traitement de l'heure";
        }
    }
    public function gererGuillemets($string)
    {
        /* return str_replace('"', '\"', $string); */
        return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
    }

    public function afficherMessage($idDiscussion)
    {
        $objetMessage = new Message();
        $service = new Service();
        $dernierMessage = $objetMessage->recupererDernierMessageFull($idDiscussion);
        $date = $dernierMessage["date"];
?>

        <div class="container-fluid mt-100">
        <a href="discussion.php?id=<?=$idDiscussion;?>"><span class="apercu_lien"></span></a>
            <div class="row align-items-center">
                <div class="col-3 col-md-2 col-lg-2 mb-2 apercu_avatar">
                    <img src="<?= $dernierMessage["avatar"]; ?>" class="img-fluid rounded-circle avatarGros">
                </div>
                <div class="col-9 col-md-10 col-lg-10 pl-1">
                    <div class="card card_apercu">
                        <div class="card-header pl-1">
                            <div class="media flex-wrap w-100 align-items-center">
                                <div class="media-body">
                                    <a class="apercu_nom"><?= $dernierMessage["prenom"]; ?> <?= $dernierMessage["nom"]; ?></a>

                                    <!-- <div class="text-muted small"><?= $service->dateFr($date); ?></div> -->
                                </div>
                                <div class="text-muted small"><?=$service->heureViaDate($date);?></div>
                            </div>
                        </div>
                        <div class="card-body pt-1 pl-1">
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
}
