<!--cancellazione.php-->
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
if (isset($_POST['todelete']) && isset($_SESSION['tbl'])) {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  } else {
    $idcorso=isset($_POST['idcorso']) ? $_POST['idcorso']: '';
    //$citta=isset($_POST['citta']) ? $_POST['citta']: '';

    //echo "Connessione riuscita."."<br/>";
    $query = "DELETE FROM Edizione WHERE idcorso='" . $_POST['todelete'] . "';";
    //echo $query;
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    }
    else {
      //$cmdtuples = pg_affected_rows($result);
      echo "<center>Cancellazione avvenuta con successo. Torna <br><a href='operazioni_operatore.php'>indietro</a> alle operazioni</center>";
    };
  };

} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='cancellazione_operatore_edizione.php'>riprovare</a>";
}

?>
</BODY>
</HTML>