<?php
require_once "entete_calendrier.php";
$idCreateur = $_SESSION["idUtilisateur"];
$objetUtilisateur = new Utilisateur($idCreateur);
$allUtilisateurs = $objetUtilisateur->recupererIdentifiantsUtilisateurs();
$identifiantCreateur = $objetUtilisateur->getIdentifiant();
?>
<script>
    $(document).ready(function() {
        let participants = []
        let participantsSave = []
        var calendrier = $('#calendrier').fullCalendar({

            defaultView: 'agendaWeek',
            locale: 'fr',
            // code: "fr",
            selectable: true,
            selectHelper: true,
            editable: true,
            nowIndicator: true,
            slotLabelFormat: ['H:mm'],
            weekNumberCalculation: 'ISO',

            plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,list'
            },
            /* Changement de l'interface du calendrier (fr & format heure) */
            buttonText: {
                today: "Aujourd'hui",
                year: "Année",
                month: "Mois",
                week: "Semaine",
                day: "Jour",
                list: "Mon planning"
            },
            week: {
                dow: 1,
                doy: 4
            },

            weekLabel: "Sem.",
            allDayHtml: "Toute la<br/>journée",
            eventLimitText: "en plus",
            noEventsMessage: "Aucun événement à afficher",

            /* Affichage du contenu */
            events: 'evenements/load.php',

            timeFormat: 'H:mm',
            dayOfMonthFormat: 'ddd DD/MM',

            /* ----------------------------- CLICK GRID ----------------------------- */
            select: function(start, end, jsEvent) {
                endtime = $.fullCalendar.moment(end).format('H:mm');
                starttime = $.fullCalendar.moment(start).format('dddd, Do MMMM YYYY, H:mm');
                var mywhen = starttime + ' - ' + endtime;
                start = moment(start).format();
                end = moment(end).format();
                $('#createEventModal #startTime').val(start);
                $('#createEventModal #endTime').val(end);
                $('#createEventModal #when').text(mywhen);
                $('#createEventModal').modal('toggle');

                var id = event.id;
                $.ajax({
                    type: 'POST',
                    url: 'calendrier.php',
                    data: {
                        id: id
                    },
                    success: function(data) {}
                })
            },

            /* ----------------------------- CLICK EVENT ----------------------------- */
            eventClick: function(event, jsEvent, view) {
                endtime = $.fullCalendar.moment(event.end).format('H:mm');
                starttime = $.fullCalendar.moment(event.start).format('dddd, Do MMMM YYYY, H:mm');
                var mywhen = starttime + ' - ' + endtime;
                $('#modalTitle').html(event.title);
                $('#modalDescription').html(event.description);
                $('#select_couleur').val(event.backgroundColor);
                $('#modalWhen').text(mywhen);
                $('#modalWho').text(event.createur);

                $('#modalParticipants').html("<ul>");

                var stringParticipants = "<ul class = 'liste'>"
                Object.values(event.participants).forEach(participant => {
                    stringParticipants = stringParticipants.concat("<li>" + participant + "</li>")
                });
                stringParticipants = stringParticipants.concat("</ul>")
                $('#modalParticipants').html(stringParticipants);

                $('#eventID').text(event.id);
                $('#calendarModal').modal();
            },

            editable: true,
            eventResize: function(event) {
                var start = $.fullCalendar.moment(event.start).format("Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.moment(event.end).format("Y-MM-DD HH:mm:ss");
                var title = event.title;
                var description = event.description;
                var id = event.id;
                $.ajax({
                    url: "evenements/update.php",
                    type: "POST",
                    data: {
                        title: title,
                        description: description,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function() {
                        calendrier.fullCalendar('refetchEvents');
                    }
                })
            },

            eventDrop: function(event) {
                var start = $.fullCalendar.moment(event.start).format("Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.moment(event.end).format("Y-MM-DD HH:mm:ss");
                var title = event.title;
                var description = event.description;
                var id = event.id;
                $.ajax({
                    url: "evenements/update.php",
                    type: "POST",
                    data: {
                        title: title,
                        description: description,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function() {
                        calendrier.fullCalendar('refetchEvents');
                    }
                });
            },

        });

        $('#submitButton').on('click', function(e) {
            // We don't want this to act as a link so cancel the link action
            e.preventDefault();
            doSubmit();
        });
        $('#deleteButton').on('click', function(e) {
            // We don't want this to act as a link so cancel the link action
            e.preventDefault();
            doDelete();
        });
        $('#updateButton').on('click', function(e) {
            // We don't want this to act as a link so cancel the link action
            e.preventDefault();
            doUpdate();
        });

        /* ----------------------------- SUBMIT DU BOUTON ENREGISTRER ----------------------------- */
        function doSubmit() {
            $("#createEventModal").modal('hide');
            var title = $('#title').val();
            var description = $('#description').val();
            var start = $('#startTime').val();
            var end = $('#endTime').val();

            if (title == null || title == '' || description == null || description == '') {
                alert("Veuiller remplir tous les champs obligatoires");
                return false;
            } else {
                if (participants.length === 0) {

                    participantsObject = <?php echo json_encode($allUtilisateurs); ?>;
                    participants = [];

                    for (var i = 0; i < participantsObject.length; i++) {
                        utilisateur = participantsObject[i].identifiant
                        participants.push(utilisateur)
                    };
                } else {
                    identifiantCreateur = '<?php echo $identifiantCreateur; ?>';
                    participants.push(identifiantCreateur)
                }
                $.ajax({
                    url: "evenements/insert.php",
                    type: "POST",
                    data: {
                        title: title,
                        description: description,
                        start: start,
                        end: end,
                        participants: participants
                    },
                    success: function() {
                        calendrier.fullCalendar('refetchEvents');
                    }
                });
                participantsSave = participants
                participants = []
                clearInnerHTML()
                afficherParticipants()
                clearInputs()
                document.getElementById("div_participants_selectionnes").innerHTML = "Par défaut, TOUS les utilisateurs participent à l'événement"
            }
        }
        /* ----------------------------- SUBMIT DU BOUTON SUPPRIMER ----------------------------- */
        function doDelete() {
            $("#calendarModal").modal('hide');
            var id = $('#eventID').text();
            $.ajax({
                url: "evenements/delete.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function() {
                    $("#calendar").fullCalendar('removeEvents', eventID);
                    calendrier.fullCalendar('refetchEvents');
                }
            })
        }
        /* ----------------------------- SUBMIT DU BOUTON MODIFIER ----------------------------- */
        function doUpdate() {
            $("#calendarModal").modal('hide');
            var id = $('#eventID').text();
            var select = document.getElementById("select_couleur");
            var backgroundColor = select.options[select.selectedIndex].value;

            $.ajax({
                url: "evenements/updateColor.php",
                type: "POST",
                data: {
                    id: id,
                    backgroundColor: backgroundColor
                },
                success: function() {
                    calendrier.fullCalendar('refetchEvents');
                }
            });
        }

        /* ----------------------------- GESTION PARTICIPANTS ----------------------------- */
        function arrayContains(string, array) {
            return (array.indexOf(string) > -1);
        }

        function clearInnerHTML() {
            $("#div_participants_selectionnes").empty();
        }

        function clearInputs() {
            document.getElementById('title').value = ''
            document.getElementById('description').value = ''
            document.getElementById('select_participant').value = 'Par défaut, tout les utilisateurs participent'
        }

        function addParticipant() {
            utilisateur = select_participant[select_participant.selectedIndex].text

            // Verifi si l'utilisateur n'a pas déjà été sélectionné
            if (arrayContains(utilisateur, participants) == false) {
                participants.push(utilisateur)
            }
            participants.join(',')
            $.post('calendrier.php', {
                participants: participants
            })
        }

        function deleteParticipant(indexParticipant) {
            participants.splice(indexParticipant, 1);
        }

        function afficherParticipants() {
            for (var i = 0; i < participants.length; i++) {
                document.getElementById("div_participants_selectionnes").innerHTML +=
                    "<div class='col-6 div_participant'>" +
                    "<div class='label_participant'>" +
                    "<label class='m-0'>" + participants[i] + "</label>" +
                    "<button id='delete_participant' name='delete_participant' class='bouton_delete_participant icon_close'" +
                    "value='" + i + "'>" +
                    "<i class='far fa-times-circle'></i>" +
                    "</button>" +
                    "</div>" +
                    "</div>"
            };
        }

        $(document).on('change', '#select_participant', function() {
            addParticipant();
            document.getElementById("div_participants_selectionnes").innerHTML = ""
            afficherParticipants();
        });
        $(document).on('click', '#delete_participant', function() {
            var indexParticipant = $(this).val()
            deleteParticipant(indexParticipant)
            clearInnerHTML()
            afficherParticipants()
        });
    });
</script>
</head>

<body>
    <!-- ----------------------------- NAVBAR ----------------------------- -->
    <?php
    require_once "navbar.php";
    ?>
    <!-- ----------------------------- CALENDRIER ----------------------------- -->
    <div class="container_calendrier">
        <div id="calendrier"></div>
    </div>

    <!-- ----------------------------- MODAL CLICK GRID ----------------------------- -->
    <div id="createEventModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content dark">
                <div class="modal-header">
                    <button type="button" class="close blanc" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter un événement</h4>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label requis" for="inputPatient">Titre de l'événement :</label>
                        <div class="field desc mb-3">
                            <input class="form-control darker" id="title" name="title" placeholder="Saisissez le titre de l'événement" type="text" value="">
                        </div>

                        <label class="control-label requis" for="inputPatient">Description de l'événement :</label>
                        <div class="field desc mb-4">
                            <textarea class="form-control darker" id="description" name="description" placeholder="Saisissez une courte description de l'événement" type="text" rows="4" value=""></textarea>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 id="participants" class="modal-couleur p_infos_evenements m-0"></h5>
                        <label class="control-label mr-3" for="inputPatient">Participants :</label>
                        <select class="form-control darker" name="select_participant" id="select_participant">
                            <option selected disabled hidden> Par défaut, tout les utilisateurs participent</option>
                            <?php
                            $utilisateurs = $objetUtilisateur->recupererUtilisateurs();
                            foreach ($utilisateurs as $utilisateur) {
                                if ($utilisateur['identifiant'] !== $_SESSION['identifiant']) {
                            ?>
                                    <option class="blanc" value="<?= $utilisateur["idUtilisateur"]; ?>">
                                        <?= $utilisateur["identifiant"]; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="text-center mt-3">Selectionné(s) :</div>
                        <div id="div_participants_selectionnes" name="div_participants_selectionnes" class="row justify-content-center mt-3 test">
                            <span>Par défaut, TOUS les utilisateurs participent à l'événement</span>
                        </div>
                    </div>

                    <input type="hidden" id="startTime" />
                    <input type="hidden" id="endTime" />

                    <div class="control-group">
                        <div class="div_modal_date">
                            <label class="control-label" for="when">Le :</label>
                            <div class="controls controls-row ml-2" id="when">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-dismiss="modal" aria-hidden="true">Annuler</button>
                    <button type="submit" class="btn btn-outline-success" id="submitButton">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ----------------------------- MODAL CLICK EVENEMENTS ----------------------------- -->
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content dark">
                <div class="modal-header">
                    <button type="button" class="close blanc" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Détails de l'événement</h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <div class="control-group">
                        <div class="div_modal_title">
                            <label class="control-label m-0" for="inputPatient">Titre :</label>
                            <h5 id="modalTitle" class="modal-title p_infos_evenements"></h5>
                        </div>
                        <div class="div_modal_description mb-3">
                            <label class="control-label mb-1" for="inputPatient">Description :</label>
                            <h5 id="modalDescription" class="modal-description p_infos_evenements m-0"></h5>
                        </div>

                        <div class="div_modal_couleur mb-3">
                            <label class="control-label mr-3" for="inputPatient">Couleur :</label>
                            <h5 id="modalCouleur" class="modal-couleur p_infos_evenements m-0"></h5>
                            <select class="form-control select_couleur list darker" id="select_couleur">
                                <option value="" selected disabled hidden></option>
                                <option class="input_couleur_bleu" value="#007bff">Bleu</option>
                                <option class="input_couleur_rouge" value="#d9534f">Rouge</option>
                                <option class="input_couleur_vert" value="#28a745">Vert</option>
                                <option class="input_couleur_jaune" value="#d29e00">Jaune</option>
                            </select>
                        </div>

                        <div class="div_modal_date">
                            <label class="control-label" for="when">Le :</label>
                            <div id="modalWhen" class="modalWhen ml-2"></div>
                        </div>

                        <div class="div_modal_date">
                            <label class="control-label" for="when">Par :</label>
                            <div id="modalWho" class="modalWho ml-2"></div>
                        </div>

                        <div class="div_modal_description mb-0">
                            <label class="control-label" for="inputPatient">Participants :</label>
                            <h5 id="modalParticipants" class="modal-participants p_infos_evenements m-0">
                                <?php
                                // var_dump($_POST['id']);
                                // if (isset($_POST['id'])) {
                                //     $idEvenement = $_POST['id'];

                                //     $participants = $objetUtilisateur->recupererParticipantsViaIdEvenement($idEvenement);
                                //     var_dump($participants);
                                // }
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="eventID" />
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-dismiss="modal" aria-hidden="true">Annuler</button>
                    <button type="submit" class="btn btn-outline-success" id="updateButton">Modifier</button>
                    <button type="submit" class="btn btn-outline-danger" id="deleteButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>