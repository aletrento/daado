<!DOCTYPE html>
<html>
<head>
<title>mySQL - UTENTI</title>
 
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
<div class="tools-alert tools-alert-blue" align="left">
Torna alla <a href="db.php">pagina precedente</a>
</div>
<h3 align="center">mySQL - tabella UTENTI</h3>
<br>
Si possono <font color="#7094FF"><b>ordinare i dati</b></font> in modo diverso cliccando sulle celle dell'intestazione.
<br><br>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = ("SELECT * FROM utenti WHERE username!='sudo' ORDER BY scuola,cognome,nome,username asc ");
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>

<div class="table-container" align="center">
<table class="table-hovered sortable">
 <tr>
  <th class="text-centered highlight">titolo</th>
  <th class="text-centered highlight">nome</th>
  <th class="text-centered highlight">cognome</th>
  <th class="text-centered highlight">scuola</th>
  <th class="text-centered highlight">materia</th>
  <th class="text-centered highlight">username</th>
  <th class="text-centered highlight">password</th>
  <th class="text-centered highlight">active</th>
  <th class="text-centered highlight">accesso</th>
  <th colspan="2" class="text-centered sorttable_nosort"></th>
 </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
 <tr>
  <td class="text-centered"><?=$objResult["titolo"];?></td>
  <td class="text-centered"><?=$objResult["nome"];?></td>
  <td class="text-centered"><?=$objResult["cognome"];?></td>
  <td class="text-centered"><?=$objResult["scuola"];?></td>
  <td class="text-centered"><?=$objResult["materia"];?></td>
  <td class="text-centered"><?=$objResult["username"];?></td>
  <td class="text-centered"><?=$objResult["password"];?></td>
  <td class="text-centered"><?=$objResult["active"];?></td>
  <td class="text-centered"><?=$objResult["accesso"];?></td>
  <td class="text-centered"><a href="mod_utente.php?id=<?=$objResult["id"];?>"><img src="img/update.gif" width="29" height="20" title="modifica" onclick="return confirm('Vuoi davvero modificare questi dati?')"></a></td>
  <td class="text-centered"><a href="can_utente.php?id=<?=$objResult["id"];?>"><img src="img/bin.png" width="19" height="20" title="cancella" onclick="return confirm('Vuoi davvero cancellare questi dati?')"></a></td>
 </tr>
<?
}
?>
</table>
</div>
<?
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>