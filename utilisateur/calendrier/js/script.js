// // Variable globale, tableau JSON
// let evenements = [{
//     "title": "Fullcalendar",
//     "start": "2021-10-18 14:00:00",
//     "end": "2021-10-16 16:00:00",
//     "backgroundColor": "#7851a9",
//     "borderColor": "#7851a9"
// }, {
//     "title": "Fullcalendar 2",
//     "start": "2021-10-18 16:30:00",
//     "end": "2021-10-16 18:30:00",
//     "backgroundColor": "#839c49",
//     "borderColor": "#839c49"
// }]

window.onload = () =>
{
    let elementCalendrier = document.getElementById("calendrier")

    let xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function()
    {
        // Si la transaction s'est terminé
        if (xmlhttp.readyState == 4)
        {
            if (xmlhttp.status == 200 || xmlhttp.status == 0)
            {
                let evenements = JSON.parse(xmlhttp.responseText)

                // On instancie le calendrier
                let calendrier = new FullCalendar.Calendar(elementCalendrier, {
                    // On appelle les composants
                    plugins: ['dayGrid', 'timeGrid', 'list', 'interaction'],
                    defaultView: 'timeGridWeek',
                    locale: 'fr',
                    // Position des composants
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,list'
                    },
                    buttonText: {
                        today: 'Aujourd\'hui',
                        month: 'Mois',
                        week: 'Semaine',
                        list: 'Liste'
                    },
                    events: evenements,
                    nowIndicator: true,
                    editable: true,
                    eventDrop: (infos) => {
                        if(!confirm("Êtes vous sûr de vouloir déplacer cet événement ?"))
                        {
                            infos.revert();
                        } else {
                            /*
                            start = infos.event.start
                            end = infos.event.end
                            evenement = [{
                                "start": start,
                                "end": end
                            }]
                            modifierEvenement(evenement)
                            */
                        }
                    },
                    eventResize: (infos) => {
                        if(!confirm("Êtes vous sûr de vouloir déplacer cet événement ?"))
                        {
                            infos.revert();
                        }
                    }
                })

                calendrier.render()
            }
        }
    }


    xmlhttp.open('GET', 'http://api-rest.calendrier/evenements/lire.php', true)
    xmlhttp.send(null)
}

/*
let evenement = {
    title: "Evenement Test Ajout",
    description: "Test de ajout evenement",
    start: "2021-10-20 10:30:00",
    end: "2021-10-20 14:00:00",
    idCreateur: 2
}
*/

/*
// ---------------------------------- CREER ----------------------------------
let xmlhttp = new XMLHttpRequest();

xmlhttp.open("POST", "http://api-rest.calendrier/evenements/creer.php", true)
xmlhttp.send(JSON.stringify(evenement));
*/

// ---------------------------------- MODIFIER ----------------------------------
/*
function modifierEvenement()
{
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.open("PUT", "http://api-rest.calendrier/evenements/modifier.php", true)
    xmlhttp.send(JSON.stringify(evenement));
}
*/
// ---------------------------------- SUPPRIMER ----------------------------------
/*
let xmlhttp = new XMLHttpRequest();

xmlhttp.open("DELETE", "http://api-rest.calendrier/evenements/supprimer.php", true)
xmlhttp.send(JSON.stringify(evenement));
*/
