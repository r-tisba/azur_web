<?php
// time() définit la date d'expiration du cookie (6 mois = 4383 heures = 262980 minutes = 3600 secondes * 262980)
// Le '/' signifie que le cookie sera accesible de partout

setcookie('accept-cookie', 1, time() + 3600 * 262980, '/', '', true);
