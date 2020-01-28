<?php
session_start();
require 'database.php';
$ID_modelu = $_POST['ID_modelu'];
if (empty($ID_modelu)) {
    header('Location: model.php?pokaz=2');
    exit();
} else {
    require_once 'database.php';
    $query = $db->prepare('SELECT Model.ID_modelu, Model.Model, Model.Segment, 
    Marka.Marka, Marka.Pochodzenie
    FROM Model, Marka WHERE ID_marki = :id');
    $query->bindValue(':id', $ID_modelu, PDO::PARAM_INT);
    $query->execute();
    $Model = $query->fetch();

    $_SESSION['ID_modelu'] = $Model['ID_modelu'];
    $_SESSION['Model'] = $Model['Model'];
    $_SESSION['Segment'] = $Model['Segment'];
    $_SESSION['Rasa'] = $Model['Rasa'];
    $_SESSION['Marka'] = $Model['Marka'];
    $_SESSION['Pochodzenie'] = $Model['Pochodzenie'];
    if ($ID_modelu > $Model['ID_modelu'])
        $_SESSION['blad'] = $ID_modelu;
    header("Location: model.php?pokaz=2");
}
?>
