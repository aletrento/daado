<!DOCTYPE html>
<html>
<head>
<title>mySQL - EVENTI</title>
 
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
<h3 align="center">mySQL - tabella EVENTI</h3>
<br>
Si possono <font color="#7094FF"><b>ordinare i dati</b></font> in modo diverso cliccando sulle celle dell'intestazione.
<br><br>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = ("SELECT * FROM eventi ORDER BY utente,anno,mese,giorno,ora_ini asc ");
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>

<div class="table-container" align="center">
<table class="table-hovered sortable">
 <tr>
  <th class="text-centered highlight">utente</th>
  <th class="text-centered highlight">giorno</th>
  <th class="text-centered highlight">mese</th>
  <th class="text-centered highlight">anno</th>
  <th class="text-centered highlight">ora_ini</th>
  <th class="text-centered highlight">min_ini</th>
  <th class="text-centered highlight">ora_fine</th>
  <th class="text-centered highlight">min_fine</th>
  <th class="text-centered highlight">forfait</th>
  <th class="text-centered highlight">descrizione</th>
  <th class="text-centered highlight">categoria</th>
  <th class="text-centered highlight">tipo</th>
  <th class="text-centered highlight">tag</th>
  <th colspan="2" class="text-centered sorttable_nosort"></th>
 </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
 <tr>
  <td class="text-centered"><?=$objResult["utente"];?></td>
  <td class="text-centered"><?=$objResult["giorno"];?></td>
  <td class="text-centered"><?=$objResult["mese"];?></td>
  <td class="text-centered"><?=$objResult["anno"];?></td>
  <td class="text-centered"><?=$objResult["ora_ini"];?></td>
  <td class="text-centered"><?=$objResult["min_ini"];?></td>
  <td class="text-centered"><?=$objResult["ora_fine"];?></td>
  <td class="text-centered"><?=$objResult["min_fine"];?></td>
  <td class="text-centered"><?=$objResult["forfait"];?></td>
  <td class="text-centered"><?=$objResult["descrizione"];?></td>
  <td class="text-centered"><?=$objResult["categoria"];?></td>
  <td class="text-centered"><?=$objResult["tipo"];?></td>
  <td class="text-centered"><?=$objResult["tag"];?></td>
  <td class="text-centered"><a href="mod_evento.php?id=<?=$objResult["id"];?>"><img src="img/update.gif" width="29" height="20" title="modifica" onclick="return confirm('Vuoi davvero modificare questi dati?')"></a></td>
  <td class="text-centered"><a href="can_evento.php?id=<?=$objResult["id"];?>"><img src="img/bin.png" width="19" height="20" title="cancella" onclick="return confirm('Vuoi davvero cancellare questi dati?')"></a></td>
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