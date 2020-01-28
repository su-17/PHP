<?php
session_start();
require 'database.php';
$ID_marki = $_POST['ID_marki'];
if (empty($ID_marki)) {
    header('Location: marka.php?pokaz=2');
    exit();
} else {
    require_once 'database.php';
    $query = $db->prepare('SELECT ID_marki, Marka.Marka, Marka.Rok_założenia, Marka.Pochodzenie
    FROM Marka WHERE ID_marki = :id');
    $query->bindValue(':id', $ID_marki, PDO::PARAM_INT);
    $query->execute();
    $Marka = $query->fetch();

    $_SESSION['ID_marki'] = $Marka['ID_marki'];
    $_SESSION['Marka'] = $Marka['Marka'];
    $_SESSION['Rok_założenia'] = $Marka['Rok_założenia'];
    $_SESSION['Pochodzenie'] = $Marka['Pochodzenie'];
    if ($ID_marki > $Marka['ID_marki'])
        $_SESSION['blad'] = $ID_marki;
    header("Location: marka.php?pokaz=2");
}
