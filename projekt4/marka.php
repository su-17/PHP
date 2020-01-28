<?php
session_start();
$_SESSION['haslo'] = 'root';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekt 4 - CRUD PHP</title>
    <link rel="stylesheet" href="css/styl.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="grid-container bg-secondary">
    <div class="item logo bg-dark text-white"><p class="text-white h1 text-center font-weight-bold mt-3">PROJEKT 4 WWW - PHP I RAPORTOWANIE</p></div>

    <nav class='item nawigacja bg-primary'>
        <ul class='menu'>
            <li><a class='btn btn-primary btn-lg' href='marka.php?pokaz=1'> Create</a></li>
            <li><a class='btn btn-primary btn-lg' href='marka.php?pokaz=2'> Read</a></li>
            <li><a class="btn btn-primary btn-lg" href="marka.php?pokaz=3"> Update</a></li>
            <li><a class="btn btn-primary btn-lg" href="marka.php?pokaz=4">Delete</a></li>
        </ul>
    </nav>
    <nav class='item nawigacja2 bg-primary'>
        <ul class='menu2'>
            <li><a class='btn btn-primary btn-lg' href='marka.php?pokaz=5'>Tabela</a></li>
        </ul>
    </nav>
     <main class="meni bg-secondary text-dark mt-2 mb-2">
        <?php
        //start
        if(!isset($_GET['pokaz'])){
            echo "<div class='form-group text-center h2'>
                  Aktualna lokalizajca: <br />Panel Marek
                  <a href='index.php' class='btn btn-primary btn-lg btn-block mt-5'>Powrót do wyboru tabel</a>
                  </div>";
        }

        //create.php
        if ($_GET['pokaz'] == "1") {
            echo "<form method='post' action='createMarka.php'>";
            echo "<div class='text-center text-white h2'>Dodaj marke do bazy</div>";
            echo "<div class='form-group text-center h4'><label for='s_marka'>Podaj nazwę marki</label><br />";
            echo "<input type='text' name='marka' id='s_marka'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_rokZalozenia'>Podaj rok zalozenia</label><br />";
            echo "<input type='date' name='rokZalozenia' id='s_rokZalozenia'>";
            echo "</div>";
            echo "<div class='form-group text-center h4'><label for='s_pochodzenie'>Podaj pochodzenie marki</label><br />";
            echo "<input type='text' name='pochodzenie' id='s_pochodzenie'>";
            echo "</div>";
            echo "<div class='form-action text-center'><input class='btn btn-primary btn-lg ' type='submit' value='Dodaj marke'>
                  <a class='btn btn-secondary text-center btn-lg' href='marka.php'>Cofnij</a></div></form>";
            if (isset($_SESSION['podana_marka'])) {
                echo '<p class="text-center h4 text-warning">Niepoprawna nazwa marki </p>';
                unset($_SESSION['podana_marka']);
            }
            if (isset($_SESSION['podany_rok_zalozenia'])) {
                echo '<p class="text-center h4 text-warning">Niepoprawny rok założenia</p>';
                unset($_SESSION['podany_rok_zalozenia']);
            }
            if (isset($_SESSION['podane_pochodzenie'])) {
                echo '<p class="text-center h4 text-warning">Niepoprawne pochodzenie</p>';
                unset($_SESSION['podane_pochodzenie']);
            }
            if (isset($_SESSION['poprawnie'])) {
                echo '<p class="text-center h4 text-warning">Dodano nową markę</p>';
                unset($_SESSION['poprawnie']);
            }
        }
        //Read.php
        if ($_GET['pokaz'] == "2") {
            echo "<form method='post' action='readMarka.php'>";
            echo "<div class='container'><div class='row h2 text-center text-white'>Dane marki</div>              
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4'>Podaj numer ID</label>
                  <div class='col-lg-4'>
                  <input type='number' name='ID_marki' id='s_read' class='mb-1'>";
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa marki</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Marka'];
            unset($_SESSION['Marka']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Rok założenia</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Rok_zalozenia'];
            unset($_SESSION['Rok_zalozenia']);
            echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Pochodzenie</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
            echo $_SESSION['Pochodzenie'];
            unset($_SESSION['Pochodzenie']);
            echo "</label></div></div>
                  <div class='form-actions'>
                  <input type='submit' class='btn btn-primary btn-lg' value='Szukaj'>
                  <a class='btn btn-secondary btn-lg' href='marka.php'>Cofnij</a>
                  </div>";
            if (isset($_SESSION['blad'])) {
                echo "<p class='text-center h4 text-warning'>Nie ma takiego numeru ID Marki w bazie danych</p>";
                unset($_SESSION['blad']);
            }
            echo "</div></form>";
        }
        //Update.php
        if ($_GET['pokaz'] == "3") {
            echo "<form method='post' action='read_updateMarka.php'> ";
            echo "<div class='container'><div class='row h2 text-white'>Aktualizuj dane marki</div>     
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4' for='s_read'>Podaj numer ID</label>
                  <div class='col-lg-6'>
                  <input type='number' name='ID_marki' id='s_read' class='mb-1' />
                  <input type='submit' class='btn btn-primary btn-lg ml-2' value='Szukaj' />";
            echo "</div></div></div></form>
                  <form method='post' action='updateMarka.php'>
                  <div class='container'>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa marki</label>
                  <div class='col-lg-4'>
                  <input name='Marka' type='text'  class=\"form-control\" placeholder=\"Nazwa marki\" value='";
            echo $_SESSION['Marka'];
            unset($_SESSION['Marka']);
            echo "'>";
            if (isset($_SESSION['marka_Error'])) {
                echo "<p class='text-warning h5'>Niepoprawna nazwa marki!</p>";
                unset($_SESSION['marka_Error']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Rok zalozenia</label>
                  <div class='col-lg-4'>
                  <input name='Rok_zalozenia' type='date'  class='form-control' placeholder='Rok_zalozenia' value='";
            echo $_SESSION['Rok_zalozenia'];
            unset($_SESSION['Rok_zalozenia']);
            echo "'>";
            if (isset($_SESSION['rok_zalozeniaError'])) {
                echo '<p class="text-warning h5">Niepoprawny rok zalozenia</p>';
                unset($_SESSION['rok_zalozeniaError']);
            }
            echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Pochodzenie</label>
                  <div class='col-lg-4'>
                  <input name='Pochodzenie' type='text'  class='form-control' placeholder='Pochodzenie' value='";
            echo $_SESSION['Pochodzenie'];
            unset($_SESSION['Pochodzenie']);
            echo "'>";
            if (isset($_SESSION['pochodzenieError'])) {
                echo '<p class="text-warning h5">Niepoprawne pochodzenie</p>';
                unset($_SESSION['pochodzenieError']);
            }

            echo "</div></div>
                  <div class='form-action'><input type='submit' class='btn btn-primary btn-lg' value='Aktualizuj'>
                  <a class='btn btn-secondary btn-lg' href='marka.php'>Cofnij</a></div></div></form>";
            if (isset($_SESSION['poprawnie_u'])) {
                echo '<p class="text-warning h5 text-center">Zaktualizowano marke w bazie danych</p>';
                unset($_SESSION['poprawnie_u']);
                unset($_SESSION['Marka']);
                unset($_SESSION['Rok_zalozenia']);
                unset($_SESSION['Pochodzenie']);
            }
        }
        //delete.php
        if ($_GET['pokaz'] == "4") {
            echo "<form method='post' action='deleteMarka.php'>";
            echo "<div class='text-center text-white h2'>Usuń marke z bazy danych</div>";
            echo "<div class='form-group text-center h3'>
                  <label for='s_nazwa'>Podaj ID marki do usunięcia</label><br />";
            echo "<input type='number' name='ID_marki_Delete' id='s_nazwa'></div>";
            if (isset($_SESSION['blad_id'])) {
                echo '<p class="text-center text-warning h5">Niepoprawne ID marki do usunięcia</p>';
                unset($_SESSION['blad_id']);
            }
            echo "<div class='form-group text-center h3'><label for='h_nazwa'>Podaj hasło do bazy danych</label><br />";
            echo "<input type='password' name='haslo' id='h_nazwa'></div>";
            if (isset($_SESSION['b_haslo'])) {
                echo '<p class="text-center text-warning h5">Błędne hasło</p>';
                unset($_SESSION['b_haslo']);
            }
            echo "<div class='form-action text-center'><input type='submit' class='btn btn-primary btn-lg' value='Usuń'>
                  <a class='btn btn-secondary btn-lg' href='marka.php'>Cofnij</a></div>";
            echo "</form>";
            if(isset($_SESSION['usuniety'])){
                echo '<p class="text-center">Usunięto marke z bazy danych</p>';
                unset($_SESSION['usuniety']);
            }
        }
        //tabela
        if($_GET['pokaz'] == "5"){
            require 'database.php';
            $sql = 'SELECT ID_marki, Marka, Rok_założenia, Pochodzenie
                    FROM Marka';
            echo "<table class=\"table table-lg table-bordered table-dark text-dark text-center\">";
            echo "<thead>
                  <tr class='bg-primary text-white h5'>
                  <th scope=\"col\">ID Marki</th>
                  <th scope=\"col\">Marka</th>
                  <th scope=\"col\">Rok zalozenia</th>
                  <th scope=\"col\">Pochodzenie</th>
                  </tr>
                  </thead><tbody>";
            foreach ($db->query($sql) as $row) {
                echo "<tr class='bg-white h5'>";
                echo '<td>'. $row['ID_marki'] . '</td>';
                echo '<td>'. $row['Marka'] . '</td>';
                echo '<td>'. $row['Rok_założenia'] . '</td>';
                echo '<td>'. $row['Pochodzenie'] . '</td>';
                echo '</tr>';
            }
            echo "</tbody></table>";
        }
        ?>
     </main>
    <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Jakub Pluciński</p></footer>
</div>
</body>
</html>