<?php
session_start();

if (!empty($_POST)) {
    $Model = $_POST['Model'];
    $Segment = $_POST['Segment'];
    $Marka = $_POST['Marka'];

    require_once 'database.php';
    $Markaa = $db->prepare('SELECT ID_marki FROM Marka WHERE Marka = ?');
    $Markaa->execute(array($Marka));
    $ID_marki = $Markaa->fetch();

    $valid = true;
    if (empty($Model)) {
        $_SESSION['ModelError'] = 'wprowadź nazwę modelu';
        $valid = false;
        header('Location: model.php?pokaz=3');
    }

    if (empty($Segment)) {
        $_SESSION['SegmentError'] = 'wprowadź segment';
        $valid = false;
        header('Location: model.php?pokaz=3');
    }

    if (empty($Marka)) {
        $_SESSION['MarkaError'] = $_POST['Marka'];
        $valid = false;
        header('Location: model.php?pokaz=3');
    } else if ($ID_marki['ID_marki'] == 0) {
        $_SESSION['MarkaError'] = $_POST['Marka'];
        $valid = false;
        header('Location: model.php?pokaz=3');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('UPDATE Model SET Model = ?, Segment = ?,  ID_marki = ? WHERE ID_marki = ?');
        $query->execute(array($Model, $Model, $Segment, $ID_marki['ID_marki'], $_SESSION['ID']));
        $_SESSION['poprawnie_u']=$valid;
        header("Location: model.php?pokaz=3");
    }
}
?>
