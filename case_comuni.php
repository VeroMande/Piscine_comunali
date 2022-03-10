<!-- tutte le operazioni -->
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
    </style>
  </HEAD>
<BODY> 
NOW;
//print_R($_POST);
if (isset($_POST['operazione'])) {
  //$tbl = $_POST['tabella'];
  $op = $_POST['operazione'];
  //$_SESSION['tbl'] = $tbl;
  $_SESSION['op'] = $op;
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  } else {
    //echo "Connessione riuscita."."<br/>";
    switch ($op) {


// CASO SELEZIONE
      case 'select':
        //switch ($tbl) {
          //case 'cliente':
      $query = "SELECT * FROM Piscina";
      $result = pg_query($conn, $query);
      if (!$result) {
        echo "Si è verificato un errore.<br/>";
        echo pg_last_error($conn);
        exit();
      } else {
        print ($htmlint);
        echo '<br>
        <table>
        <tr>
        <th>nome Piscina</th>
        <th>città</td>
        <th>Via</th>
        <th>CAP</th>
        <th>Aperta da</th>
        <th>fino a</th>

        </tr>';
        while ($row = pg_fetch_array($result)) {
          echo '<tr>
          <td>' . $row['nomep'] . '</td>
          <td>' . $row['citta'] . '</td>
          <td>' . $row['via'] . '</td>
          <td>' . $row['cap'] . '</td>    
          <td>' . $row['apertura'] . '</td>    
          <td>' . $row['chiusura'] . '</td>          
          </tr>';
        };
        echo '<center></table><br>';
        echo '<center>';
        echo "Torna <a href='operazioni_comuni.php'>indietro</a> alle operazioni";
        echo '</center>';
       };
          //break;
      break;

     
// CASO CANCELLAZIONE 
      case 'delete':
        //switch ($tbl) {
          //case 'cliente':
            $query = "SELECT * FROM Piscina";
            $result = pg_query($conn, $query);
            if (!$result) {
              echo "Si è verificato un errore.<br/>";
              echo pg_last_error($conn);
              exit();
            } else {
              print ($htmlint);
              echo '<br><table>
                    <tr>
                     <th>Nome Piscina</th>
                     <th>Citta</td>
                     <th>via</th>
                     <th>cap</th>
                     <th>Aperta da</th>
                     <th>Fino a</th>
                    </tr>';
              print ("<form action=\"cancellazione_comuni.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['nomep'] . '</td>
            <td>' . $row['citta'] . '</td>
            <td>' . $row['via'] . '</td>
            <td>' . $row['cap'] . '</td>     
            <td>' . $row['apertura'] . '</td>    
            <td>' . $row['chiusura'] . '</td>                  
            <td><input type="radio" name="todelete" value=' . $row['nomep'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"delete\" value=\"Delete\"><center>";
              echo "</form>";
            };
          //break;
        //};
      break;

//CASO INSERIMENTO      
      case 'insert':
        //switch ($tbl) {
          //case 'cliente':
            print ($htmlint);
            echo '<br><table>';
            print ("<form action=\"inserimento_comuni.php\" method=\"POST\">");
            print ("<tr><th>nome Piscina</th><td><input type=\"text\" name=\"nomep\" required></td></tr>");
            print ("<tr><th>città</th><td><input type=\"text\" name=\"citta\" required></td</tr>");
            print ("<tr><th>Via</th><td><input type=\"text\" name=\"via\" required></td></tr>");
            print ("<tr><th>CAP</th><td><input type=\"text\" name=\"cap\" required></td></tr>");
            print ("<tr><th>Aperta da</th><td><input type=\"date\" name=\"apertura\" required></td></tr>");
            print ("<tr><th>Fino a</th><td><input type=\"date\" name=\"chiusura\" required></td></tr>");

            print ("<tr><td><input type=\"submit\" name=\"toinsert\" value=\"Insert\"></td></tr>");
            print ("</form>");
            print ("</table>");
          //break;
       // };
      break;
        


//CASO AGGIORNAMENTO        
      case 'update':
        //switch ($tbl) {
          //case 'cliente':
            $query = "SELECT * FROM Piscina";
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
          <th>nomeP</th>
          <th>citta</td>
          <th>Via</th>
          <th>CAP</th>
          <th>aperta da</th>
          <th>fino da</th>
        </tr>';
              print ("<form action=\"aggiornamento_base_comuni.php\" method=\"POST\">");
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['nomep'] . '</td>
            <td>' . $row['citta'] . '</td>
            <td>' . $row['via'] . '</td>
            <td>' . $row['cap'] . '</td>  
            <td>' . $row['apertura'] . '</td>  
            <td>' . $row['chiusura'] . '</td>                      
            <td><input type="radio" name="toupdate" value=' . $row['nomep'] . ' required></td>
          </tr>';
              };
              echo '</table>';
              echo "<br><center><input type=\"submit\" name=\"update\" value=\"Update\"></center>";
              echo "</form>";
            };
          //break;
        //};
      break;
    };
  };
} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='operazioni_comuni.php'>riprovare</a>";
}
?>
</BODY>
</HTML>