<?php
session_start();
if (!empty($_POST)) {
    require_once 'database.php';
    $Model = $_POST['Model'];
    $Segment = $_POST['Segment'];
    $Marka = $_POST['Marka'];
    $valid=true;
    $query = $db->prepare('SELECT ID_Marki FROM Marka WHERE ID_marki = ?');
    $query->execute(array($Marka));
    $ID_marki = $query->fetch();
    if (empty($Model)) {
        $_SESSION['podany_model'] = $_POST['Model'];
        $valid=false;
        header('Location: model.php?pokaz=1');
    }
    if (empty($Segment)) {
        $_SESSION['podany_segment'] = $_POST['Segment'];
        $valid=false;
        header('Location: model.php?pokaz=1');
    }
    if (empty($Marka)) {
        $_SESSION['podana_marka'] = $_POST['Marka'];
        $valid=false;
        header('Location: model.php?pokaz=1');
    }else if($ID_marki['ID_marki'] == 0){
        $_SESSION['podana_marka'] = $_POST['Marka'];
        $valid=false;
        header('Location: model.php?pokaz=1');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('INSERT INTO Model VALUES (:Model,:Segment,NULL,:ID_marki)');
        $query->bindValue(':Model', $Model, PDO::PARAM_STR);
        $query->bindValue(':Segment', $Segment, PDO::PARAM_STR);
        $query->bindValue(':ID_marki', $ID_marki['ID_marki'], PDO::PARAM_INT);
        $query->execute();
        $_SESSION['poprawnie']=$valid;
        header("Location: model.php?pokaz=1");
    }
}
?>
