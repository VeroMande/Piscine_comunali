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
    $query = "SELECT * FROM Iscritto WHERE numtessera='" . $_POST['toupdate'] . "';";
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
      print ("<form action=\"aggiornamento_iscritto.php\" method=\"POST\">");
      print ("<tr><th>Numero Tessera</th><td><input type=\"text\" name=\"numtessera\" value='" . $array['numtessera'] . "'  required readonly></td></tr>");
      print ("<tr><th>CF Genitore</th><td><input type=\"text\" name=\"cfgenitore\" value='" . $array['cfgenitore'] . "' required></td</tr>");
      
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