<!DOCTYPE html>
<html>
<head>
<title>filtro scuola</title>
 
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
echo "utente collegato: ".$_SESSION['username'].'<br><br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>'.'<br>';
}
?>
<body>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)<br><br>

<br>

<a href="backdoor.php"><img src="img/arrow_indietro.png" width="80" height="44" title="elenco docenti" alt="elenco docenti" align="left"></a>
<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$scuola = mysql_real_escape_string("$_POST[filtra]");
if (!$scuola)
	{
	echo '<br><br><div class="tools-alert tools-alert-red">'."Hai dimenticato di selezionare una scuola.".'<br>'."Torna indietro.".'</div>';
	}
else
{
$strSQL = ("SELECT * FROM utenti WHERE username!='admin' AND username NOT LIKE 'seg_%' AND scuola='$scuola' ORDER BY cognome,nome,username asc ");
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>

<div class="units-row">
<div class="unit-centered unit-80">

<br>

<h3 align="center">Elenco dei docenti - scuola selezionata: <font color="#FF8000"><?php echo $scuola;?></font></h3>

<br><br>

<center>
<div class="table-container">
<table class="table-hovered sortable">
 <tr>
 <th class="text-centered">nome</th>
 <th class="text-centered">cognome</th>
 <th class="text-centered">disciplina</th>
 <th class="text-centered">username</th>
 <th class="text-centered"># attività</th>
 <th class="text-centered">ultimo accesso</th>
 <th colspan="3" class="text-centered big sorttable_nosort"></th>
 </tr>

<?
while($objResult = mysql_fetch_array($objQuery))
{
$qnumber = mysql_query("SELECT * FROM eventi WHERE `utente`='".$objResult['username']."'");
$number = mysql_num_rows($qnumber);
?>

<tr>
<td class="text-centered"><?=$objResult["nome"];?></td>
<td class="text-centered"><?=$objResult["cognome"];?></td>
<td class="text-centered"><?=$objResult["materia"]?></td>
<td class="text-centered"><?=$objResult["username"]?></td>
<td class="text-centered"><?
if ($number=='0'){
echo '<font color="#FF3300">'.$number.'</font>';
}
else {
echo $number;
}
?></td>
<td class="text-centered"><?=$objResult["accesso"]?></td>
<td class="text-centered"><a href="tabelladoc.php?username=<?=$objResult["username"];?>"><img src="img/look.png" width="26" height="26" title="tabella attività" onclick="return confirm('mostra le attività di questo docente')"></a></td>
<td class="text-centered"><a href="statsdoc.php?username=<?=$objResult["username"];?>"><img src="img/stats.png" width="26" height="26" title="consuntivo" onclick="return confirm('mostra il consuntivo di questo docente')"></a></td>
<td class="text-centered"><a href="stampa.php?username=<?=$objResult["username"];?>"><img src="img/printer.png" width="26" height="26" title="stampa consuntivo" onclick="return confirm('salva/stampa il consuntivo di questo docente in formato OpenOffice')"></a></td>
</tr>

<?
}
}
?>

</table>
</div>
</center>

<?
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>