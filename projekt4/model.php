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
        <div class="item logo bg-dark"><p class="text-white h1 text-center font-weight-bold mt-3">PROJEKT 4 WWW - PHP I
                RAPORTOWANIE</p></div>

        <nav class='item nawigacja bg-primary'>
            <ul class='menu'>
                <li><a class='btn btn-primary btn-lg' href='model.php?pokaz=1'> Create</a></li>
                <li><a class='btn btn-primary btn-lg' href='model.php?pokaz=2'> Read</a></li>
                <li><a class="btn btn-primary btn-lg" href="model.php?pokaz=3"> Update</a></li>
                <li><a class="btn btn-primary btn-lg" href="model.php?pokaz=4"> Delete</a></li>
            </ul>
        </nav>
        <nav class='item nawigacja2 bg-primary'>
            <ul class='menu2'>
                <li><a class='btn btn-primary btn-lg' href='model.php?pokaz=5'>Tabela</a></li>
                <li><a class='btn btn-primary btn-lg' href='model.php?pokaz=6'>RaportPDF</a></li>
            </ul>
        </nav>
        <main class="meni bg-secondary text-dark mt-2 mb-2">
           <?php
        //start
        if (!isset($_GET['pokaz'])) {
            echo "<div class='form-group text-center h2'>
                  Aktualna lokalizacja: <br />Panel Modeli
                  <a href='index.php' class='btn btn-primary btn-lg btn-block mt-5'>Powrót do wyboru tabel</a>
                  </div>";
        }

           //create.php
           if ($_GET['pokaz'] == "1") {
               echo "<form method='post' action='createModel.php'>";
               echo "<div class='text-center text-white h2'>Dodaj model do bazy danych</div>";
               echo "<div class='form-group text-center h4'><label for='s_Model'>Podaj nazwę modelu</label><br />";
               echo "<input type='text' name='Model' id='s_Model'>";
               echo "</div>";
               echo "<div class='form-group text-center h4'><label for='s_Segment'>Podaj segment</label><br />";
               echo "<input type='text' name='Segment' id='s_Segment'>";
               echo "</div>";
               echo "<div class='form-group text-center h4'><label for='s_Marka'>Podaj markę</label><br />";
               echo "<input type='text' name='Marka' id='s_Marka'>";
               echo "</div>";
               echo "<div class='form-action text-center'><input class='btn btn-primary btn-lg ' type='submit' value='Dodaj model'>
                  <a class='btn btn-secondary text-center btn-lg' href='koty.php'>Cofnij</a></div></form>";
               if (isset($_SESSION['podany_Model'])) {
                   echo '<p class="text-center h4 text-warning">Niepoprawna nazwa modelu</p>';
                   unset($_SESSION['podany_Model']);
               }
               if (isset($_SESSION['podany_Segment'])) {
                   echo '<p class="text-center h4 text-warning">Niepoprawny segment</p>';
                   unset($_SESSION['podany_Segment']);
               }
               if (isset($_SESSION['podana_marka'])) {
                   echo '<p class="text-center h4 text-warning">Taka marka nie istnieje</p>';
                   unset($_SESSION['podana_marka']);
               }
               if (isset($_SESSION['poprawnie'])) {
                   echo '<p class="text-center h4 text-warning">Dodano nowy model</p>';
                   unset($_SESSION['poprawnie']);
               }
           }
           //Read.php
           if ($_GET['pokaz'] == "2") {
               echo "<form method='post' action='readModel.php'>";
               echo "<div class='container'><div class='row h2 text-center text-white'>Dane modelu</div>              
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4'>Podaj numer ID</label>
                  <div class='col-lg-4'>
                  <input type='number' name='ID_modelu' id='s_read' class='mb-1'>";
               echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Nazwa modelu</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
               echo $_SESSION['Model'];
               unset($_SESSION['Model']);
               echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Segemnt</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
               echo $_SESSION['Segemnt'];
               unset($_SESSION['Segemnt']);
               echo "</label></div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Marka</label>
                  <div class='col-lg-4'>
                  <label class='form-control'>";
               echo $_SESSION['Marka'];
               unset($_SESSION['Marka']);
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
                  <a class='btn btn-secondary btn-lg' href='model.php'>Cofnij</a>
                  </div>";
               if (isset($_SESSION['blad'])) {
                   echo "<p class='text-center h4 text-warning'>Nie ma takiego numeru ID modelu w bazie danych</p>";
                   unset($_SESSION['blad']);
               }
               echo "</div></form>";
           }
           //Update.php
           if ($_GET['pokaz'] == "3") {
               echo "<form method='post' action='read_updateModel.php'> ";
               echo "<div class='container'><div class='row h2 text-white'>Aktualizuj dane modelu</div>     
                  <div class='form-group row'>
                  <label class='col-lg-4 control-label font-weight-bold h4' for='s_read'>Podaj numer ID</label>
                  <div class='col-lg-6'>
                  <input type='number' name='Model' id='s_read' class='mb-1' />
                  <input type='submit' class='btn btn-primary btn-lg ml-2' value='Szukaj' />";
               echo " value='";
               echo $_SESSION['Model_u'];
               unset($_SESSION['Model_u']);
               echo "'>";
               if (isset($_SESSION['ModelError'])) {
                   echo "<p class='text-warning h5'>Niepoprawna nazwa modelu</p>";
                   unset($_SESSION['ModelError']);
               }
               echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Segment</label>
                  <div class='col-lg-4'>
                  <input name='Segment' type='text'  class='form-control' placeholder='Segment' value='";
               echo $_SESSION['Segment_u'];
               unset($_SESSION['Segment_u']);
               echo "'>";
               if (isset($_SESSION['SegmentError'])) {
                   echo '<p class="text-warning h5">Niepoprawny segment</p>';
                   unset($_SESSION['SegmentError']);
               }
               echo "</div></div>
                  <div class='control-group row'>
                  <label class='col-lg-4 control-label h4'>Marka</label>
                  <div class='col-lg-4'>
                  <input name='Marka' type='text'  class='form-control' placeholder='Marka' value='";
               echo $_SESSION['Marka_u'];
               unset($_SESSION['Marka_u']);
               echo "'>";
               if (isset($_SESSION['MarkaError'])) {
                   echo '<p class="text-warning h5">Niepoprawna marka</p>';
                   unset($_SESSION['MarkaError']);
               }
               echo "</div></div>
                  <div class='form-action'><input type='submit' class='btn btn-primary btn-lg' value='Aktualizuj'>
                  <a class='btn btn-secondary btn-lg' href='model.php'>Cofnij</a></div></div></form>";
               if (isset($_SESSION['poprawnie_u'])) {
                   echo '<p class="text-warning h5 text-center">Zaktualizowano model w bazie danych</p>';
                   unset($_SESSION['poprawnie_u']);
                   unset($_SESSION['Marka_u']);
                   unset($_SESSION['Segment_u']);
                   unset($_SESSION['Marka_u']);
               }
           }
           //delete.php
           if ($_GET['pokaz'] == "4") {
               echo "<form method='post' action='deleteModel.php'>";
               echo "<div class='text-center text-white h2'>Usuń model</div>";
               echo "<div class='form-group text-center h3'>
                  <label for='s_nazwa'>Podaj ID modelu do usunięcia</label><br />";
               echo "<input type='number' name='IDKot_Delete' id='s_nazwa'></div>";
               if (isset($_SESSION['blad_id'])) {
                   echo '<p class="text-center text-warning h5">Niepoprawne ID modelu</p>';
                   unset($_SESSION['blad_id']);
               }
               echo "<div class='form-group text-center h3'><label for='h_nazwa'>Podaj hasło do bazy danych</label><br />";
               echo "<input type='password' name='haslo' id='h_nazwa'></div>";
               if (isset($_SESSION['b_haslo'])) {
                   echo '<p class="text-center text-warning h5">Błędne hasło</p>';
                   unset($_SESSION['b_haslo']);
               }
               echo "<div class='form-action text-center'><input type='submit' class='btn btn-primary btn-lg' value='Usuń'>
                  <a class='btn btn-secondary btn-lg' href='model.php'>Cofnij</a></div>";
               echo "</form>";
               if (isset($_SESSION['usuniety'])) {
                   echo '<p class="text-center">Usunięto model z bazy danych</p>';
                   unset($_SESSION['usuniety']);
               }
           }
           //tabela
           if ($_GET['pokaz'] == "5") {
               require 'database.php';
               $sql = 'SELECT Model.ID_modelu, Model.Model, Model.Segment, Marka.Marka, Marka.Pochodzenie
                    FROM Model, Marka WHERE Model.Marka=Marka.Marka';
               echo "<table class=\"table table-lg table-bordered table-dark text-dark text-center\">";
               echo "<thead>
                  <tr class='bg-primary text-white h5'>
                  <th scope=\"col\">ID_modelu</th>
                  <th scope=\"col\">Model</th>
                  <th scope=\"col\">Segment</th>
                  <th scope=\"col\">Marka</th>
                  <th scope=\"col\">Pochodzenie</th>
                  </tr>
                  </thead><tbody>";
               foreach ($db->query($sql) as $row) {
                   echo "<tr class='bg-white h5'>";
                   echo '<td>' . $row['ID_modelu'] . '</td>';
                   echo '<td>' . $row['Model'] . '</td>';
                   echo '<td>' . $row['Segment'] . '</td>';
                   echo '<td>' . $row['Marka'] . '</td>';
                   echo '<td>' . $row['Pochodzenie'] . '</td>';
                   echo '</tr>';
               }
               echo "</tbody></table>";
           }

           if ($_GET['pokaz'] == "6") {
               echo "<form action='raport_pdf.php' method='post'>
                  <div class='h1 text-center text-white'>Raport w formie PDF</div>
                  <div class='h2 text-center'>Raport zestawienia modeli<br /> marki.</div>
                  <div class='h4 text-center mt-5'>
                  <label for='schronisko2'>Podaj nazwę marki
                  </label>
                  <input type='text' name='Marka' id='Marka2'>
                  <input class='btn btn-danger btn-lg ml-1' type='submit' value='Pobierz PDF'>
                  <a class='btn btn-secondary btn-lg' href='model.php'>Cofnij</a></div></form>";
               if (isset($_SESSION['blad_pdf'])) {
                   echo "<p class='text-warning h4 text-center'>Nie ma takiej marki</p>";
                   unset($_SESSION['blad_pdf']);
               }
           }

        ?>
        </main>
        <footer class="stopka text-white text-center"><p class="mt-2 h5">Autor: Jakub Pluciński</p></footer>
    </div>
    </body>
</html>