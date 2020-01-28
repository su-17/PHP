<?php
session_start();

if (!empty($_POST)) {
    $marka = $_POST['Marka'];
    $rok_zalozenia = $_POST['Rok_zalozenia'];
    $pochodzenie = $_POST['Pochodzenie'];

    require_once 'database.php';
    $marka = $db->prepare('SELECT ID_marki FROM Marka WHERE Marka = ?');
    $marka->execute(array($marka));
    $ID_marki = $marka->fetch();

    $valid = true;
    if (empty($marka)) {
        $_SESSION['nazwaError'] = '1';
        $valid = false;
        header('Location: marka.php?pokaz=3');
    }

    if (empty($rok_zalozenia)) {
        $_SESSION['rok_zalozeniaError'] = '1';
        $valid = false;
        header('Location: marka.php?pokaz=3');
    }

    if (empty($pochodzenie)) {
        $_SESSION['pochodzenieError'] = '1';
        $valid = false;
        header('Location: marka.php?pokaz=3');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('UPDATE Marka SET Marka = ?, Rok_zalozenia = ?, Pochodzenie = ? WHERE ID_marki = ?');
        $query->execute(array($marka, $rok_zalozenia, $pochodzenie, $ID_marki['ID_marki']));
        $_SESSION['poprawnie_u']=$valid;
        header("Location: marka.php?pokaz=3");
    }
}
?>
