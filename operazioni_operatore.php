<!--select_basic.php -->
<html>
  <head>
    <title>Operazioni Operatori</title>
    <style>
      html{
        background-color: #F5F5DC;

      }
      a {
        display: block;
        text-decoration: none;
        color: black;
      }

      a:hover {
        background-color: lightgray;
      }

      .active {
        background-color: lightgreen;
        font-size: 20px;
        font-style: italic;
        
      }

    </style> 
    </head>
    <body>
    <center>
    <ul><br>
     <a class="active" href="inizio.php">Home</a>
    </ul><br>
      <form action='case_operatori.php' method='POST'>
        <label for="cars">Scegli tabella:</label>
      	<select name="tabella">
      		<option value="corso">Corso di Nuoto</option>
          <option value="iscritto">Iscritto</option>
          <option value="edizione">Edizione</option>
          <option value="personale">Personale</option>
      	</select><br>
        <br><label for="cars">Scegli l'operazione:</label>
        <select name='operazione'>
          <option value='select'> Select </option>
          <option value='insert'> Insert </option>
          <option value='update'> Update </option>
          <option value='delete'> Delete </option>
        </select><br><br>
        <input type='submit'></input>
      </form>
      <!--
      <form action='mostraPersonale.php' method='POST'>
          <a><label for="fname" onclick="location.href='mostraPersonale.php'">Personale</label></a>
      </form>
      -->
    </center>
    </body>
 
</html>
