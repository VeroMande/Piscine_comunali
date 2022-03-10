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
// if (isset($_POST['toupdate'])) /*&& isset($_SESSION['tbl']))*/ {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  } else {
    //echo "Connessione riuscita."."<br/>";
    $query = "SELECT * FROM Piscina WHERE nomep='" . $_POST['toupdate'] . "';";
    //echo $query;
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    } else {
      //$cmdtuples = pg_affected_rows($result);
      $array = pg_fetch_array($result);
      print ($htmlint);
      print ("<table>");
      print ("<form action=\"aggiornamento_comuni.php\" method=\"POST\">");
      print ("<tr><th>Nome Piscina</th><td><input type=\"text\" name=\"nomep\" value='" . $array['nomep'] . "'  required readonly></td></tr>");
      //print ("<tr><th>Città</th><td><input type=\"text\" name=\"citta\" value='" . $array['citta'] . "' required></td</tr>");
      print ("<tr><th>Via</th><td><input type=\"text\" name=\"via\" value='" . $array['via'] . "' required></td></tr>");
      print ("<tr><th>CAP</th><td><input type=\"text\" name=\"cap\" value='" . $array['cap'] . "' required></td></tr>");
      print ("<tr><th>Aperto Da</th><td><input type=\"date\" name=\"apertura\" value='" . $array['apertura'] . "' required></td></tr>");
      print ("<tr><th>Fino A</th><td><input type=\"date\" name=\"chiusura\" value='" . $array['chiusura'] . "' required></td></tr>");
      print ("<tr><td><input type=\"submit\" name=\"toupdate2\" value=\"Send\"></td></tr>");
      print ("</form>");
      print ("</table>");
    };
  };

/*} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='aggiornamento_comuni.php'>riprovare</a>";
}
*/
?>
</BODY>
</HTML>