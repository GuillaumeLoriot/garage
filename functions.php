<?php

// fonction qui vérifie si les champs du formulaire method POST sont vide.Dans ce cas, renvoi un array qui stock ces erreurs
function verifyErrors($arr)
{
    $errors = [];
    if (empty($arr['model'])) {
        $errors['model'] = 'le champ modèle ne peut pas être vide';
    }
    if (empty($arr['brand'])) {
        $errors['brand'] = 'le champ marque ne peut pas être vide';
    }
    if (empty($arr['horsePower'])) {
        $errors['horsePower'] = 'le champ nombre de chevaux ne peut pas être vide';
    }
    if (empty($arr['image'])) {
        $errors['image'] = 'le champ nom du fichier image de la voiture ne peut pas être vide';
    }
    return $errors;
}

// fonction qui permet de faire une requette insert into en BDD dans la table car
function addNewCar($array)
{
    require_once("connectDB.php");
    $pdo = connectDB();
    $insert_request = $pdo->prepare("INSERT INTO `car` (`id`, `model`, `brand`, `horsePower`, `image`) VALUES (:id, :model, :brand, :horsePower, :image);");
    $insert_request->execute([
        ':id' => 'NULL',
        ':model' => $array['model'],
        ':brand' => $array['brand'],
        ':horsePower' => $array['horsePower'],
        ':image' => $array['image']
    ]);
    return true;
}
// fonction qui permet de faire une requette pour modifier en BDD dans la table car
function updateCar($arrayGet, $arrayPost)
{
    $pdo = connectDB();
    $update_request = $pdo->prepare("UPDATE car SET `id` = :id,  `model` = :model, `brand` = :brand, `horsePower` = :horsePower, `image` = :image WHERE `id` = :id;");
    $update_request->execute([
        ':id' => $arrayGet['id'],
        ':model' => $arrayPost['model'],
        ':brand' => $arrayPost['brand'],
        ':horsePower' => $arrayPost['horsePower'],
        ':image' => $arrayPost['image']
    ]);
    return true;
}
