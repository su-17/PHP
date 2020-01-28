<?php
session_start();
$start = null;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt 4 - CRUD PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="grid-container bg-secondary">
    <div class="item logo bg-dark"><p class="text-white h1 text-center font-weight-bold mt-3">
            PROJEKT 4 WWW - PHP I RAPORTOWANIE</p></div>
    <main class="meni">
        <div class='h1 text-center text-white mb-5'>Wybierz tabelę aby<br/>aby przejść do jej panelu</div>
        <div class='text-center'><a class='btn btn-primary btn-lg btn-block mb-4' href='model.php'>Tabela Modeli</a></div>
        <div class='text-center'><a class='btn btn-primary btn-lg btn-block' href='marka.php'>Tabela Marek</a>
        </div>
    </main>
    <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Jakub Pluciński</p></footer>
</div>
</body>
</html>