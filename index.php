<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL selection simple de données</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

</body>
</html>
<?php

/**
 * 1. Importez le fichier SQL se trouvant dans le dossier SQL.
 * 2. Connectez vous à votre base de données avec PHP
 * 3. Sélectionnez tous les utilisateurs et affichez toutes les infos proprement dans un div avec du css
 *    ex:  <div class="classe-css-utilisateur">
 *              utilisateur 1, données ( nom, prenom, etc ... )
 *         </div>
 *         <div class="classe-css-utilisateur">
 *              utilisateur 2, données ( nom, prenom, etc ... )
 *         </div>
 * 4. Faites la même chose, mais cette fois ci, triez le résultat selon la colonne ID, du plus grand au plus petit.
 * 5. Faites la même chose, mais cette fois ci en ne sélectionnant que les noms et les prénoms.
 */


try {
    $server = "localhost";
    $db = "live2";
    $user = "root";
    $psw = "";

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $psw);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION).
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $bdd->prepare("SELECT * from user");

    $state = $stmt->execute();

    $number = 0;

    if ($state) {
        foreach ($stmt -> fetchAll() as $user) {
            $number++;
            echo "<div class='classe-css-utilisateur'>
                        Utilisateur $number, données ( " . $user['nom'] . ", " . $user['prenom'] . ", " . $user['rue'] . ", " . $user['numero'] . ", " . $user['code_postal'] . ", " . $user['ville'] . ", " . $user['pays'] . ", " . $user['mail'] . ")"
                    . "</div>";
        }
    }

    echo "<br><br>";

    $stmt = $bdd->prepare("SELECT * from user ORDER BY id DESC");

    $state = $stmt->execute();

    $number = 0;

    if ($state) {
        foreach ($stmt -> fetchAll() as $user) {
            $number++;
            echo "<div class='classe-css-utilisateur'>
                        Utilisateur $number, données ( " . $user['nom'] . ", " . $user['prenom'] . ", " . $user['rue'] . ", " . $user['numero'] . ", " . $user['code_postal'] . ", " . $user['ville'] . ", " . $user['pays'] . ", " . $user['mail'] . ")"
                . "</div>";
        }
    }

    echo "<br><br>";

    $stmt = $bdd->prepare("SELECT nom, prenom from user ORDER BY id DESC");

    $state = $stmt->execute();

    $number = 0;

    if ($state) {
        foreach ($stmt -> fetchAll() as $user) {
            $number++;
            echo "<div class='classe-css-utilisateur'>
                        Utilisateur $number, données ( " . $user['nom'] . ", " . $user['prenom'] . ")"
                . "</div>";
        }
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
}