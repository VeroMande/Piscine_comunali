<!--login1.php-->
<?php
session_start();
$htmlint = <<<NOW
<HTML>
	<HEAD>
		<style>
			input.left {
				float:left;
				border-radius: 12px;
			}
		</style>
	</HEAD>
<BODY> 

NOW;

if (isset($_POST['pwd'])) {
        if ($_POST['pwd'] == 'abc') {
            $now = <<<NOW
<center>
<form action="operazioni_operatore.php" method="POST">
  <input class="left" type="submit" onClick=location.href='operazioniOperatore.html" value="Continua">
</form>
<center>
NOW;
            print($htmlint);
            echo "Premi il pulsante per accedere al sito";
            print($now);
        } else {
            print($htmlint);
            echo "la password che hai inserito non risulta essere valida<br>";
            echo "Se vuoi puoi <a href='loginOperatore.html'>riprovare</a> ad accedere";
        }
} else {
        print($htmlint);
        echo "Non risultano dati passati o memorizzati in una variabile di sessione valida<br>";
        echo "Se vuoi puoi <a href='loginOperatore.html'>riprovare</a> ad accedere";
}
?>
</BODY>
</HTML>
