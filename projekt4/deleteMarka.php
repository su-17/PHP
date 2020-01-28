<?php
session_start();
$ID_marki_Delete = $_POST['ID_marki_Delete'];
$haslo = $_POST['haslo'];

require_once 'database.php';
$query = $db->prepare('SELECT ID_marki FROM Marka WHERE ID_marki = :id');
$query->bindValue(':id',$ID_marki_Delete, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if (empty($ID_marki_Delete)) {
    header('Location: marka.php?pokaz=4');
    exit();
}elseif($ID_marki_Delete != $data['ID_marki']){
    $_SESSION['blad_id']="1";
    header('Location: marka.php?pokaz=4');
    exit();
}
if(empty($haslo)){
    $_SESSION['b_haslo']="1";
    header('Location: marka.php?pokaz=4');
    exit();
}elseif($haslo != $_SESSION['haslo']){
    $_SESSION['b_haslo']="1";
    header('Location: marka.php?pokaz=4');
    exit();
}else{
    require_once 'database.php';
    $query = $db->prepare('DELETE FROM Marka WHERE ID_marki = :id');
    $query->bindValue(':id', $ID_marki_Delete, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['usuniety']="1";
    header('Location: marka.php?pokaz=4');
}
