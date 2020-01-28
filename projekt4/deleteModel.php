<?php
session_start();
$ID_modelu_Delete = $_POST['ID_modelu_Delete'];
$haslo = $_POST['haslo'];

require_once 'database.php';
$query = $db->prepare('SELECT ID_modelu FROM Model WHERE ID_modelu = :id');
$query->bindValue(':id',$ID_modelu_Delete, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if (empty($ID_modelu_Delete)) {
    header('Location: model.php?pokaz=4');
    exit();
}elseif($ID_modelu_Delete != $data['KotyID']){
    $_SESSION['blad_id']="1";
    header('Location: model.php?pokaz=4');
    exit();
}
if(empty($haslo)){
    $_SESSION['b_haslo']="1";
    header('Location: model.php?pokaz=4');
    exit();
}elseif($haslo != $_SESSION['haslo']){
    $_SESSION['b_haslo']="1";
    header('Location: model.php?pokaz=4');
    exit();
}else{
    require_once 'database.php';
    $query = $db->prepare('DELETE FROM Model WHERE ID_model = :id');
    $query->bindValue(':id', $ID_modelu_Delete, PDO::PARAM_INT);
    $query->execute();
    $_SESSION['usuniety']="1";
    header('Location: model.php?pokaz=4');
}
