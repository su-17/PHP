<?php
session_start();
if (!empty($_POST)) {
    require_once 'database.php';
    $marka = $_POST['marka'];
    $rok_zalozenia= $_POST['rok_założenia'];
    $pochodzenie = $_POST['pochodzenie'];
    $valid=true;

    if (empty($marka)) {
        $_SESSION['podana_marka'] = $_POST['marka'];
        $valid=false;
        header('Location: marka.php?pokaz=1');
    }
    if (empty($rokZalozenia)) {
        $_SESSION['podany_rok_założenia'] = $_POST['rok_założenia'];
        $valid=false;
        header('Location: marka.php?pokaz=1');
    }
    if (empty($pochodzenie)) {
        $_SESSION['podane_pochodzenie'] = $_POST['pochodzenie'];
        $valid=false;
        header('Location: marka.php?pokaz=1');
    }

    if ($valid) {
        require_once 'database.php';
        $query = $db->prepare('INSERT INTO Marka VALUES (:Marka,:Rok_zalozenia,:Pochodzenie,NULL)');
        $query->bindValue(':Marka', $marka, PDO::PARAM_STR);
        $query->bindValue(':Rok_zalozenia', $rok_zalozenia, PDO::PARAM_INT);
        $query->bindValue(':Pochodzenie', $pochodzenie, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['poprawnie']=$valid;
        header("Location: marka.php?pokaz=1");
    }
}
?>
