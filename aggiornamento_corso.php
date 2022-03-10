<!--basic_updt2.php-->
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
//if (isset($_POST['toupdate2']) && isset($_SESSION['tbl'])) {
  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  }
  else {
    //echo "Connessione riuscita."."<br/>";
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $tipologia = isset($_POST['tipologia']) ? $_POST['tipologia'] : '';
    $costo = (isset($_POST['costo']) and is_numeric($_POST['costo'])) ? $_POST['costo'] : 0;
    $minp = (isset($_POST['minp']) and is_numeric($_POST['minp'])) ? $_POST['minp'] : 0;
    $maxp = (isset($_POST['maxp']) and is_numeric($_POST['maxp'])) ? $_POST['maxp'] : 0;
    $livello = (isset($_POST['livello']) and is_numeric($_POST['livello'])) ? $_POST['livello'] : 0;
    $corsia = (isset($_POST['corsia']) and is_numeric($_POST['corsia'])) ? $_POST['corsia'] : 0;
    $nomep = isset($_POST['nomep']) ? $_POST['nomep'] : '';
 
    $query = "UPDATE CorsoDiNuoto set  id='$id', tipologia='$tipologia', costo='$costo', minp='$minp', maxp='$maxp', livello='$livello', corsia='$corsia', nomep='$nomep' where id='$id'";
    //echo $query;
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Si è verificato un errore.<br/>";
      echo pg_last_error($conn);
      exit();
    }
    else {
      //$cmdtuples = pg_affected_rows($result);
      echo "<center>Aggiornamento avvenuto con successo.<br>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni</center>";
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
