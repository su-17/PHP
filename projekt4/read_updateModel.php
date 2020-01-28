<?php
session_start();
$ID_modelu = $_POST['model'];
if (empty($ID_modelu)) {
    header('Location: model.php?pokaz=3');
    exit();
}else {
    require_once 'database.php';
    $query = $db->prepare('SELECT Model.ID_modelu, Model.Segment, Marka.Marka
    FROM Model, Marka WHERE ID_modelu = :id');
    $query->bindValue(':id', $ID_modelu, PDO::PARAM_INT);
    $query->execute();
    $model = $query->fetch();
    $_SESSION['ID_modelu'] = $model['ID_modelu'];
    $_SESSION['Model_u'] = $model['Model'];
    $_SESSION['Segment_u'] = $model['Segment'];
    $_SESSION['Marka_u'] = $model['Maarka'];
    header("Location: model.php?pokaz=3");
}
