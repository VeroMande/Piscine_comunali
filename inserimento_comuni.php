<!--inserimento.php-->
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
//if (isset($_POST['toinsert']) && isset($_SESSION['tbl'])) {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  }
  else {
    //echo "Connessione riuscita."."<br/>";
    $nomep = isset($_POST['nomep']) ? $_POST['nomep'] : '';
    $citta = isset($_POST['citta']) ? $_POST['citta'] : '';
    $via = isset($_POST['via']) ? $_POST['via'] : '';
    $cap = (isset($_POST['cap']) and is_numeric($_POST['cap'])) ? $_POST['cap'] : 0;
    $apertura = isset($_POST['apertura']) ? $_POST['apertura'] : '';
    $chiusura = isset($_POST['chiusura']) ? $_POST['chiusura'] : '';
   
    $query = "INSERT INTO Piscina (nomep, citta, via, cap, apertura, chiusura) VALUES ('$nomep','$citta','$via','$cap', '$apertura', '$chiusura')";
    $result = pg_query($conn, $query);
    //echo $query;
    if (!$result) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    }
    else {
      //$cmdtuples = pg_affected_rows($result);
      echo '<center>';
      echo "Inserimento avvenuto con successo.<br>Torna <a href='operazioni_comuni.php'> indietro</a>";
      echo '</center>';
    };
  };
/*
}else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='select_basic.php'>riprovare</a>";
}
*/
?>
</BODY>
</HTML>