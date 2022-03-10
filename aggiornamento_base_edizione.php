<!--basic_upd.php-->
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
if (isset($_POST['toupdate'])) /*&& isset($_SESSION['tbl']))*/ {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  }
  else {
    //echo "Connessione riuscita."."<br/>";
    $query = "SELECT * FROM Edizione WHERE idcorso='" . $_POST['toupdate'] . "';";
    //echo $query;
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    }
    else {
      //$cmdtuples = pg_affected_rows($result);
      $array = pg_fetch_array($result);
      print ($htmlint);
      print ("<table>");
      print ("<form action=\"aggiornamento_edizione.php\" method=\"POST\">");
      print ("<tr><th>ID Corso</th><td><input type=\"text\" name=\"idcorso\" value='" . $array['idcorso'] . "'  required readonly></td></tr>");
      print ("<tr><th>numero Edizione</th><td><input type=\"number\" name=\"numedizione\" value='" . $array['numedizione'] . "' required></td</tr>");
      print ("<tr><th>Data Inizio</th><td><input type=\"date\" name=\"datainizio\" value='" . $array['datainizio'] . "' required></td</tr>");
      print ("<tr><th>Data Fine</th><td><input type=\"date\" name=\"datafine\" value='" . $array['datafine'] . "' required></td</tr>");
      print ("<tr><th>Ora</th><td><input type=\"time\" name=\"ora\" value='" . $array['ora'] . "' required></td</tr>");
      print ("<tr><th>Giorno</th><td><input type=\"text\" name=\"giorno\" value='" . $array['giorno'] . "' required></td</tr>");
      print ("<tr><th>CF Istruttore</th><td><input type=\"text\" name=\"cfistruttore\" value='" . $array['cfistruttore'] . "' required></td</tr>");
      
      print ("<tr><td><input type=\"submit\" name=\"toupdate2\" value=\"Send\"></td></tr>");
      print ("</form>");
      print ("</table>");
    };
  };

} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='aggiornamento.php'>riprovare</a>";
}
?>
</BODY>
</HTML>