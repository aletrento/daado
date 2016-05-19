<!DOCTYPE html>
<html>
<head>
<title>mySQL</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero">
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola">
<meta name="author" content="Alessandro Vallin">

<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="icon" href="img/clip.ico" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script src="sorttable.js"></script>
</head>
<?
session_start();
session_regenerate_id(TRUE);
if (!isset($_SESSION['username'] ) )
{
header('location:index.php');
exit;
}
else
{
echo '<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a><br>'."utente collegato: ".$_SESSION['username'].'<br>'."oggi è il giorno: ".date("d-m-y");
}
?> 
<body>

<div class="units-row">
<div class="unit-centered unit-80">
<br><br>

 <h3 align="center">Interfaccia grafica di mySQL</h3>

<br><br>

<center>
 <div class="table-container">
  <table class="table-bordered">
   <tr>
    <td class="text-centered">visualizza/modifica tabella <a href="db_utenti.php">UTENTI</a></td>
   </tr>
   <tr>
    <td class="text-centered">visualizza/modifica tabella <a href="db_eventi.php">EVENTI</a></td>
   </tr>
   <tr>
    <td class="text-centered">aggiungi <a href="agg_utente.php">utente</a></td>
   </tr>
  </table>
 </div>
</center>

</div>
</div>

</body>
</html>