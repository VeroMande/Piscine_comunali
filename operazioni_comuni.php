<!--select_basic.php -->
<html>
  <head>
    <title>Operazioni Strutture</title>
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
      <form action='case_comuni.php' method='POST'>
        <h4>Operazioni sulle piscine</h4>
        <p> Scegli l'operazione che vuoi effettuare: </p>
        <select name='operazione'>
          <option value='select'> Select </option>
          <option value='insert'> Insert </option>
          <option value='update'> Update </option>
          <option value='delete'> Delete </option>
        </select>
        <input type='submit'></input>
      </form>
    </center>
    </body>
 
</html>