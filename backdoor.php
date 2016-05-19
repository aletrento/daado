<!DOCTYPE html>
<html>
<head>
<title>tutti</title>
 
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
echo "utente collegato: ".$_SESSION['username'].'<br><br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
?>
<body>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h3 align="center">Elenco di tutti i docenti registrati</h3>

<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = ("SELECT * FROM utenti WHERE username!='admin' AND username!='sudo' AND username NOT LIKE 'seg_%' ORDER BY scuola,cognome,nome,username asc ");
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>

Si possono <font color="#7094FF"><b>ordinare i dati</b></font> in modo diverso cliccando sulle celle dell'intestazione.

<br><br>

<form class="forms" action="filtro_scuola.php" method="POST">
E' possibile <font color="#7094FF"><b>filtrare la lista</b></font> dei docenti: <select name="filtra">
<option value="" disabled selected style='display:none;'> - scuola -
<option value="Liceo 'A. Rosmini' - Trento"> Liceo "A. Rosmini" - Trento
<option value="Liceo 'G. Galilei' - Trento"> Liceo "G. Galilei" - Trento
<option value="Liceo 'L. da Vinci' - Trento"> Liceo "L. da Vinci" - Trento
<option value="Liceo 'G. Prati' - Trento"> Liceo "G. Prati" - Trento
<option value="I. T. 'A. Pozzo' - Trento"> I. T. "A. Pozzo" - Trento
<option value="I. T. 'Tambosi / Battisti' - Trento"> I. T. "Tambosi / Battisti" - Trento
<option value="Liceo Artistico 'A. Vittoria' - Trento"> Liceo Artistico "A. Vittoria" - Trento
<option value="I. T. 'M. Buonarroti' - Trento"> I. T. "M. Buonarroti" - Trento
<option value="Liceo Musicale 'F. Bonporti' - Trento"> Liceo Musicale "F. Bonporti" - Trento
<option value="Liceo 'A. Rosmini' - Rovereto"> Liceo "A. Rosmini" - Rovereto
<option value="I. I. 'F. Filzi' - Rovereto"> I. I. "F. Filzi" - Rovereto
<option value="I. T. 'F. e G. Fontana' - Rovereto"> I. T. "F. e G. Fontana" - Rovereto
<option value="I. T. 'G. Marconi' - Rovereto"> I. T. "G. Marconi" - Rovereto
<option value="I. I. 'don Milani' - Rovereto"> I. I. "don Milani" - Rovereto
<option value="I. I. 'Depero' - Rovereto"> I. I. "Depero" - Rovereto
<option value="Liceo 'A. Maffei' - Riva del Garda"> Liceo "A. Maffei" - Riva del Garda
<option value="I. I. 'G. Floriani' - Riva del Garda"> I. I. "G. Floriani" - Riva del Garda
<option value="I. I. 'M. Martini' - Mezzolombardo"> I. I. "M. Martini" - Mezzolombardo
<option value="I. I. 'M. Curie' - Pergine"> I. I. "M. Curie" - Pergine
<option value="Liceo 'B. Russell' - Cles"> Liceo "B. Russell" - Cles
<option value="I. T. 'C. A. Pilati' - Cles"> I. T. "C. A. Pilati" - Cles
<option value="I. I. 'A. Degasperi' - Borgo"> I. I. "A. Degasperi" - Borgo
<option value="I. I. 'L. Guetti' - Tione"> I. I. "L. Guetti" - Tione
<option value="I. I. 'Rosa Bianca - Weisse Rose' - Cavalese"> I. I. "Rosa Bianca - Weisse Rose" - Cavalese
<option value="I. I. - Pozza di Fassa"> I. I. - Pozza di Fassa
<option value="I. I. - Fiera di Primiero"> I. I. - Fiera di Primiero
</select>
<input type="submit" class="btn btn-round" name="filtro" value="mostra solo questi" />
</form>

<br>

<center>
<div class="table-container">
<table class="table-hovered sortable">
 <tr>
 <th class="text-centered highlight">nome</th>
 <th class="text-centered highlight">cognome</th>
 <th class="text-centered highlight">scuola</th>
 <th class="text-centered highlight">disciplina</th>
 <th class="text-centered highlight">username</th>
 <th class="text-centered highlight"># attività</th>
 <th class="text-centered highlight">ultimo accesso</th>
 <th colspan="3" class="text-centered big sorttable_nosort"></th>
 </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
$qnumber = mysql_query("SELECT * FROM eventi WHERE `utente`='".$objResult['username']."'");
$number = mysql_num_rows($qnumber);?>
<tr>
<td class="text-centered"><?=$objResult["nome"];?></td>
<td class="text-centered"><?=$objResult["cognome"];?></td>
<td class="text-centered"><?=$objResult["scuola"];?></td>
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