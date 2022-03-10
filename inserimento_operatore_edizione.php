<!-- inserimento operatore corso -->
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
if (isset($_POST['toinsert']) && isset($_SESSION['tbl'])) {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  } else {
    //echo "Connessione riuscita."."<br/>";
    $idcorso = isset($_POST['idcorso']) ? $_POST['idcorso'] : '';
    $numedizione = (isset($_POST['numedizione']) and is_numeric($_POST['numedizione'])) ? $_POST['numedizione'] : 0;
    $datainizio = isset($_POST['datainizio']) ? $_POST['datainizio'] : '';
    $datafine = isset($_POST['datafine']) ? $_POST['datafine'] : '';
    $ora = isset($_POST['ora']) ? $_POST['ora'] : '';
    $giorno = isset($_POST['giorno']) ? $_POST['giorno'] : '';
    $cfistruttore = isset($_POST['cfistruttore']) ? $_POST['cfistruttore'] : '';
    $queryEdizione = "INSERT INTO Edizione (idcorso, numedizione, datainizio, datafine, ora, giorno,cfistruttore) VALUES ('$idcorso', '$numedizione', '$datainizio', '$datafine', '$ora', '$giorno', '$cfistruttore')";
    $resultEdizione = pg_query($conn, $queryEdizione);

    if (!$resultEdizione) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    } else {
      //$cmdtuples = pg_affected_rows($result);
      echo "<center>Inserimento avvenuto con successo. Torna <br><a href='operazioni_operatore.php'>indietro</a> alle operazioni </center>";
    };
  
  };

} else {
  print ($htmlint);
  echo "Non risultano dati passati<br>";
  echo "Se vuoi puoi <a href='select_basic.php'>riprovare</a>";
};

?>
</BODY>
</HTML>