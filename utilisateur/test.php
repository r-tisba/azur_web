<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <th>identifiant</th>
            <th>nom</th>
            <th>prénom</th>
        </thead>
        <tbody>
            <?php foreach($users as $user):?>
                <tr>
                    <td><?=$user["identifiant"]?></td>
                    <td><?=$user["nom"]?></td>
                    <td><?=$user["prenom"]?></td>
                </tr>
            <?php endforeach;?>

        </tbody>
    </table>
</body>
</html>