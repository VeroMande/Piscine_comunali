<!--opt_basic.php-->
<?php
session_start();
$htmlint = <<<NOW
<HTML>
  <HEAD>
    <style>
      table, th, td {
        text-align: left;
        border: 1px solid black;
        border-collapse: collapse;
        text-align:center;
        height:25px;
      }
      table {
        margin-left:auto;
        margin-right:auto;
      }
      th {
        background-color: #90EE90;
      }
      td {
        background-color: #FAF0E6;
      }
      #centro{
      text-align:center;
    }
    </style>
  </HEAD>
<BODY> 
NOW;
//print_R($_POST);
if (isset($_POST['tabella']) && isset($_POST['operazione'])) {
  $tbl = $_POST['tabella'];
  $op = $_POST['operazione'];
  $_SESSION['tbl'] = $tbl;
  $_SESSION['op'] = $op;
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  }
  else {
    //echo "Connessione riuscita."."<br/>";
    switch ($op) {

      
//////////////////////////// CASO SELEZIONE //////////////////////////////////////
      case 'select':
        switch ($tbl) {

          /////////////// selezione corso ////////////////
          case 'corso':
            $query = "SELECT * FROM CorsoDiNuoto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              echo '<h2 id=centro>Corsi di nuoto</h2>';
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>ID</th>
          <th>Tipologia</td>
          <th>Costo</th>
          <th>Partecipanti Min</th>
          <th>Partecipanti Max</th>
          <th>Livello</th>
          <th>Corsia</th>
          <th>Piscina</th>
        </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['tipologia'] . '</td>
            <td>' . $row['costo'] . '</td>
            <td>' . $row['minp'] . '</td>          
            <td>' . $row['maxp'] . '</td>
            <td>' . $row['livello'] . '</td>
            <td>' . $row['corsia'] . '</td>    
            <td>' . $row['nomep'] . '</td>         
          </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni</center>";
            };
          break;


          //////// selezione iscritto /////////
          case 'iscritto':
            $query = "SELECT * FROM iscritto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {                            
              echo '<h2 id=centro>Iscritti ai corsi</h2>';
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>Numero Tessera</th>
          <th>CF Genitore</th>
        </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['numtessera'] . '</td>
            <td>' . $row['cfgenitore'] . '</td>             
          </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni </center>";
            };
         // break;

          echo '<br><br>';
          // selezione ESAME 
          // mostra le info degli iscritti selezionando gli iscritti che si sono piazzati sul podio più di una volta per un dato corso e anno (a mia scelta)
          case 'iscritto':
            $query = "SELECT numtesseraiscritto, idcorso, anno 
                      FROM partecipa 
                      WHERE idcorso='254a3' AND anno='2021'
                      GROUP BY numtesseraiscritto, idcorso, anno
                      HAVING COUNT(piazzamento)>1";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {                            
              echo '<h2 id=centro>Informazioni degli iscritti che si sono posizionati sul podio più di una volta</h2>';
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>Numero Tessera Iscritto</th>
          <th>idcorso</th>
          <th>anno</th>
        </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['numtesseraiscritto'] . '</td>
            <td>' . $row['idcorso'] . '</td> 
            <td>' . $row['anno'] . '</td>             
          </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni </center>";
            };
          break;

          /////////// selezione edizione //////////////////
          case 'edizione':
            $query = "SELECT * FROM edizione";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {
              echo '<h2 id=centro>Edizioni</h2>';
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>idcorso</th>
          <th>numEdizione</th>
          <th>dataInizio</th>
          <th>dataFine</th>
          <th>ora</th>
          <th>giorno</th>
          <th>cfIstruttore</th>
        </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['idcorso'] . '</td>
            <td>' . $row['numedizione'] . '</td>
            <td>' . $row['datainizio'] . '</td>
            <td>' . $row['datafine'] . '</td>
            <td>' . $row['ora'] . '</td>
            <td>' . $row['giorno'] . '</td>
            <td>' . $row['cfistruttore'] . '</td>
            </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni</center>";
            };
          break;


          /////////// selezione PERSONALE //////////////////
          case 'personale':
          echo ('<h2 id=centro>PERSONALE</h2>');
            $query = 
            "SELECT * 
             FROM personale JOIN responsabile ON personale.cf=responsabile.cf JOIN tel_personale ON responsabile.cf = tel_personale.cf 
             WHERE responsabile.cf=personale.cf";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {
              print ($htmlint);
              echo '<br>
              <h2 id=centro>Responsabili</h2>
              <table>
              <tr>
                <th>CF</th>
                <th>Nome</th>
                <th>Cognome</td>
                <th>Numero di telefono</td>
              </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['cf'] . '</td>
            <td>' . $row['nome'] . '</td>
            <td>' . $row['cognome'] . '</td>
            <td>' . $row['numero'] . '</td>  
          </tr>';
              };
              echo '</table><br>';
              
            };


            $query = 
            "SELECT * 
             FROM personale JOIN medico ON personale.cf=medico.cf JOIN tel_personale ON medico.cf = tel_personale.cf 
             WHERE medico.cf=personale.cf";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {
              print ($htmlint);
              echo '<br>
              <h2 id=centro>Medici</h2>
              <table>
              <tr>
                <th>CF</th>
                <th>Nome</th>
                <th>Cognome</td>
                <th>Numero di telefono</td>
              </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['cf'] . '</td>
            <td>' . $row['nome'] . '</td>
            <td>' . $row['cognome'] . '</td>
            <td>' . $row['numero'] . '</td>  
          </tr>';
              };
              echo '</table><br>';
              
            };



          $query = 
            "SELECT * 
              FROM 
              tel_personale JOIN istruttore ON tel_personale.cf = istruttore.cf
              JOIN personale ON istruttore.cf=personale.cf 
              JOIN impiego ON personale.cf= impiego.cfistruttore
              WHERE istruttore.cf=personale.cf";

            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {
              print ($htmlint);
              echo '<br>
              <h2 id=centro>Istruttori</h2>
              <table>
              <tr>
                <th>CF</th>
                <th>Nome</th>
                <th>Cognome</td>
                <th>Numero di telefono</td>
                <th>Nome piscina</td>
                <th>ferie</td>
                <th>duratacontratto</td>
              </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['cf'] . '</td>
            <td>' . $row['nome'] . '</td>
            <td>' . $row['cognome'] . '</td>
            <td>' . $row['numero'] . '</td> 
            <td>' . $row['nomep'] . '</td> 
            <td>' . $row['ferie'] . '</td>
            <td>' . $row['duratacontratto'] . '</td>
          </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni</center><br><br>";
            };
          break;



        };
      break;
  
////////////////////////////// CASO CANCELLAZIONE ////////////////////////////////
      case 'delete':
        switch ($tbl) {
          
          /////////////////////////////////delete corso //////////////////////
          case 'corso':
            $query = "SELECT * FROM CorsoDiNuoto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>ID</th>
          <th>Tipologia</td>
          <th>Costo</th>
          <th>Partecipanti Min</th>
          <th>Partecipanti Max</th>
          <th>livello</th>
          <th>Corsia</th>
          <th>Piscina</th>
        </tr>';
              print ("<form action=\"cancellazione_operatore_corso.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['tipologia'] . '</td>
            <td>' . $row['costo'] . '</td>
            <td>' . $row['minp'] . '</td>          
            <td>' . $row['maxp'] . '</td>
            <td>' . $row['livello'] . '</td>     
            <td>' . $row['corsia'] . '</td> 
            <td>' . $row['nomep'] . '</td>             
            <td><input type="radio" name="todelete" value=' . $row['id'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"delete\" value=\"Delete\"></center>";
              echo "</form>";
            };
          break;


          /////////////////////////delete iscritto ////////////////////////////
          case 'iscritto':
            $query = "SELECT * FROM iscritto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>Numero Tessera</th>
          <th>CF Genitore</td>
        </tr>';
              print ("<form action=\"cancellazione_operatore_iscritto.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['numtessera'] . '</td>
            <td>' . $row['cfgenitore'] . '</td>           
            <td><input type="radio" name="todelete" value=' . $row['numtessera'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"delete\" value=\"Delete\"></center>";
              echo "</form>";
            };
          break;


          /////////////////////////delete edizione ////////////////////////////
          case 'edizione':
            $query = "SELECT * FROM edizione";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>ID Corso</th>
          <th>numero Edizione</td>
          <th>dataInizio</th>
          <th>dataFine</th>
          <th>ora</th>
          <th>giorno</th>
          <th>cfIstruttore</th>
        </tr>';
              print ("<form action=\"cancellazione_operatore_edizione.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['idcorso'] . '</td>
            <td>' . $row['numedizione'] . '</td>   
            <td>' . $row['datainizio'] . '</td>   
            <td>' . $row['datafine'] . '</td>   
            <td>' . $row['ora'] . '</td>   
            <td>' . $row['giorno'] . '</td>   
            <td>' . $row['cfistruttore'] . '</td>   
            <td><input type="radio" name="todelete" value=' . $row['idcorso'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"delete\" value=\"Delete\"></center>";
              echo "</form>";
            };
          break;

          /////////////////////////delete istruttore ////////////////////////////
          case 'personale':
            $query = "SELECT * FROM  tel_personale JOIN istruttore ON tel_personale.cf = istruttore.cf
              JOIN personale ON istruttore.cf=personale.cf 
              JOIN impiego ON personale.cf= impiego.cfistruttore
              WHERE istruttore.cf=personale.cf";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo "<center>CANCELLAZIONE ISTRUTTORE</center>";
              echo '<br><table>
        <tr>
          <th>CF</th>
          <th>nome</td>
          <th>cognome</td>
          <th>Telefono</th>
          <th>Piscina</td>
        </tr>';
              print ("<form action=\"cancellazione_operatore_istruttore.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['cf'] . '</td>
            <td>' . $row['nome'] . '</td>   
            <td>' . $row['cognome'] . '</td>   
            <td>' . $row['numero'] . '</td> 
            <td>' . $row['nomep'] . '</td>        
            <td><input type="radio" name="todelete" value=' . $row['cf'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"delete\" value=\"Delete\"></center>";
              echo "</form>";
            };
          break;



        };
      break;
        //

///////////////////////////////CASO INSERIMENTO /////////////////////////////////     
      case 'insert':
        switch ($tbl) {

          /////////////// inserimento corso /////////
          case 'corso':
            print ($htmlint);
            echo '<br><table>';
            print ("<form action=\"inserimento_operatore_corso.php\" method=\"POST\">");
            print ("<tr><th>ID</th><td><input type=\"text\" name=\"id\" required></td></tr>");
            print ("<tr><th>Tipologia</th><td><input type=\"text\" name=\"tipologia\" required></td</tr>");
            print ("<tr><th>Costo</th><td><input type=\"number\" name=\"costo\" required></td></tr>");
            print ("<tr><th>Partecipanti Min</th><td><input type=\"number\" name=\"minp\" required></td></tr>");
            print ("<tr><th>Partecipanti Max</th><td><input type=\"number\" name=\"maxp\"></td></tr>");
            print ("<tr><th>Livello</th><td><input type=\"number\" name=\"livello\"></td></tr>");
            print ("<tr><th>Corsia</th><td><input type=\"number\" name=\"corsia\"></td></tr>");
            print ("<tr><th>Piscina</th><td><input type=\"text\" name=\"nomep\"></td></tr>");
      
            print ("<tr><td><input type=\"submit\" name=\"toinsert\" value=\"Insert\"></td></tr>");
            print ("</form>");
            print ("</table>");
          break;

          /////////////// inserimento iscritto /////////
          case 'iscritto':
            print ($htmlint);
            echo '<br><table>';
            print ("<form action=\"inserimento_operatore_iscritto.php\" method=\"POST\">");
            print ("<tr><th>Numero Tessera</th><td><input type=\"text\" name=\"numtessera\" required></td></tr>");
            print ("<tr><th>CF Genitore</th><td><input type=\"text\" name=\"cfgenitore\" required></td</tr>");
          
            print ("<tr><td><input type=\"submit\" name=\"toinsert\" value=\"Insert\"></td></tr>");
            print ("</form>");
            print ("</table>");
          break;

          /////////////// inserimento edizione /////////
          case 'edizione':
            print ($htmlint);
            echo '<br><table>';
            print ("<form action=\"inserimento_operatore_edizione.php\" method=\"POST\">");
            print ("<tr><th>ID Corso</th><td><input type=\"text\" name=\"idcorso\" required></td></tr>");
            print ("<tr><th>Edizione</th><td><input type=\"number\" name=\"numedizione\" required></td</tr>");
            print ("<tr><th>Data inizio</th><td><input type=\"date\" name=\"datainizio\" required></td></tr>");
            print ("<tr><th>Data fine</th><td><input type=\"date\" name=\"datafine\" required></td</tr>");
            print ("<tr><th>Ora</th><td><input type=\"time\" name=\"ora\" required></td></tr>");
            print ("<tr><th>Giorno</th><td><input type=\"text\" name=\"giorno\" required></td</tr>");
            print ("<tr><th>CFistruttore</th><td><input type=\"text\" name=\"cfistruttore\" required></td</tr>");
          
            print ("<tr><td><input type=\"submit\" name=\"toinsert\" value=\"Insert\"></td></tr>");
            print ("</form>");
            print ("</table>");
          break;

      


        /////////////// inserimento istruttore /////////
          case 'personale':
            print ($htmlint);
            echo "<center>INSERIMENTO ISTRUTTORE</center>";
            echo '<br><table>';
            print ("<form action=\"inserimento_operatore_istruttore.php\" method=\"POST\">");
            print ("<tr><th>CF istruttore</th><td><input type=\"text\" name=\"cfistruttore\" required></td></tr>");
            print ("<tr><th>inizio</th><td><input type=\"date\" name=\"inizio\" required></td</tr>");
            print ("<tr><th>fine</th><td><input type=\"date\" name=\"fine\" required></td></tr>");
            print ("<tr><th>>Piscina</th><td><input type=\"text\" name=\"nomep\" required></td></tr>");
            print ("<tr><th>numero</th><td><input type=\"number\" name=\"numero\" required></td></tr>");
      
            print ("<tr><td><input type=\"submit\" name=\"toinsert\" value=\"Insert\"></td></tr>");
            print ("</form>");
            print ("</table>");
          };
          break;

    





        //

//////////////////////////////// CASO AGGIORNAMENTO //////////////////////////       
      case 'update':
        switch ($tbl) {
          //////////////// aggiornamento corso ///////////
          case 'corso':
            $query = "SELECT * FROM CorsoDiNuoto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>ID</th>
          <th>Tipologia</td>
          <th>Costo</th>
          <th>Partecipanti min</th>
          <th>partecipanti max</th>
          <th>livello</th>
          <th>corsia</th>
          <th>Piscina</th>

        </tr>';
              print ("<form action=\"aggiornamento_base_corso.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['tipologia'] . '</td>
            <td>' . $row['costo'] . '</td>
            <td>' . $row['minp'] . '</td>          
            <td>' . $row['maxp'] . '</td>
            <td>' . $row['livello'] . '</td>
            <td>' . $row['corsia'] . '</td>             
            <td>' . $row['nomep'] . '</td>             
            <td><input type="radio" name="toupdate" value=' . $row['id'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"update\" value=\"Update\"></center>";
              echo "</form>";
            };
          break;

          //////////////// aggiornamento iscritto ///////////
          case 'iscritto':
            $query = "SELECT * FROM Iscritto";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>Numero Tessera</th>
          <th>CF Genitore</td>
        </tr>';
              print ("<form action=\"aggiornamento_base_iscritto.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['numtessera'] . '</td>
            <td>' . $row['cfgenitore'] . '</td>

            <td><input type="radio" name="toupdate" value=' . $row['numtessera'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"update\" value=\"Update\"></center>";
              echo "</form>";
            };
          break;


          //////////////// aggiornamento edizione ///////////
          case 'edizione':
            $query = "SELECT * FROM Edizione";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            }
            else {
              print ($htmlint);
              echo '<br><table>
        <tr>
          <th>ID corso</th>
          <th>numero Edizione</td>
          <th>Data Inizio</td>
          <th>Data fine</td>
          <th>ora</td>
          <th>giorno</td>
          <th>CF istruttore</td>
        </tr>';
              print ("<form action=\"aggiornamento_base_edizione.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['idcorso'] . '</td>
            <td>' . $row['numedizione'] . '</td>
            <td>' . $row['datainizio'] . '</td>
            <td>' . $row['datafine'] . '</td>
            <td>' . $row['ora'] . '</td>
            <td>' . $row['giorno'] . '</td>
            <td>' . $row['cfistruttore'] . '</td>
            <td><input type="radio" name="toupdate" value=' . $row['idcorso'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"update\" value=\"Update\"></center>";
              echo "</form>";
            };
          break;


        };
      break;
    };
  };
} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='operazioni_operatore.php'>riprovare</a>";
}
?>
</BODY>
</HTML>