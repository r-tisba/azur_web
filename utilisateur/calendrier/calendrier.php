<?php
require_once "entete_calendrier.php";
?>
<script>
    $(document).ready(function() {
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
            },


            /* ----------------------------- CLICK EVENT ----------------------------- */
            eventClick: function(event, jsEvent, view) {
                endtime = $.fullCalendar.moment(event.end).format('H:mm');
                starttime = $.fullCalendar.moment(event.start).format('dddd, Do MMMM YYYY, H:mm');
                var mywhen = starttime + ' - ' + endtime;
                $('#modalTitle').html(event.title);
                $('#modalDescription').html(event.description);
                $('#modalWhen').text(mywhen);
                $('#eventID').val(event.id);
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
                        alert('Événement mis à jour');
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
                        alert("Événement mis à jour");
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

        /* ----------------------------- SUBMIT DU BOUTON SUPPRIMER ----------------------------- */
        function doDelete() {
            $("#calendarModal").modal('hide');
            var id = $('#eventID').val();
            $.ajax({
                url: "evenements/delete.php",
                type: "POST",
                data: {
                    id: id
                },
                success: function() {
                    $("#calendar").fullCalendar('removeEvents', eventID);
                    calendrier.fullCalendar('refetchEvents');
                    alert("Événement supprimé");
                }
            })
        }

        /* ----------------------------- SUBMIT DU BOUTON ENREGISTRER ----------------------------- */
        function doSubmit() {
            $("#createEventModal").modal('hide');
            var title = $('#title').val();
            var description = $('#description').val();
            var start = $('#startTime').val();
            var end = $('#endTime').val();

            $.ajax({
                url: "evenements/insert.php",
                type: "POST",
                data: {
                    title: title,
                    description: description,
                    start: start,
                    end: end
                },
                success: function() {
                    calendrier.fullCalendar('refetchEvents');
                    alert("Événement ajouté");
                }
            });

        }
    });
</script>
</head>

<body>
    <!-- ----------------------------- NAVBAR ----------------------------- -->
    <?php
    require_once "navbar.php";
    ?>
    <!-- ----------------------------- CALENDRIER ----------------------------- -->
    <div class="container px-5">
        <div id="calendrier"></div>
    </div>

    <!-- ----------------------------- MODAL CLICK GRID ----------------------------- -->
    <div id="createEventModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter événement</h4>
                </div>
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label" for="inputPatient">Titre événement :</label>
                        <div class="field desc mb-3">
                            <input class="form-control" id="title" name="title" placeholder="Saisissez le titre de l'événement" type="text" value="">
                        </div>

                        <label class="control-label" for="inputPatient">Description événement :</label>
                        <div class="field desc mb-4">
                            <textarea class="form-control" id="description" name="description" placeholder="Saisissez une courte description de l'événement" type="text" rows="4" value=""></textarea>
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Détails événement</h4>
                </div>
                <div id="modalBody" class="modal-body">
                    <div class="control-group">
                        <div class="div_modal_title">
                            <label class="control-label m-0" for="inputPatient">Titre :</label>
                            <h4 id="modalTitle" class="modal-title p_infos_evenements"></h4>
                        </div>
                        <div class="div_modal_description mb-4">
                            <label class="control-label" for="inputPatient">Description :</label>
                            <h4 id="modalDescription" class="modal-description p_infos_evenements m-0"></h4>
                        </div>

                        <div class="div_modal_date">
                            <label class="control-label" for="when">Le :</label>
                            <div id="modalWhen" class="modalWhen ml-2"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="eventID" />
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-dismiss="modal" aria-hidden="true">Annuler</button>
                    <button type="submit" class="btn btn-outline-danger" id="deleteButton">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>