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

  $conn = pg_connect("host=localhost port=5432 dbname=project_piscine user=postgres password=unimi");
  if (!$conn) {
    echo 'Connessione al database fallita.';
    exit();
  }
  else {
    //echo "Connessione riuscita."."<br/>";

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
              </tr>';
              while ($row = pg_fetch_array($result)) {
                echo '<tr>
            <td>' . $row['cf'] . '</td>
            <td>' . $row['nome'] . '</td>
            <td>' . $row['cognome'] . '</td>
            <td>' . $row['numero'] . '</td> 
            <td>' . $row['nomep'] . '</td> 
          </tr>';
              };
              echo '</table><br>';
              echo "<center>Torna <a href='operazioni_operatore.php'>indietro</a> alle operazioni</center><br><br>";
            };

};
