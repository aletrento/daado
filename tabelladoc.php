<!DOCTYPE html>
<html>
<head>
<title>tabella docente</title>
 
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
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
$objDB = mysql_select_db("my_daado");
$doc=trim(mysql_real_escape_string(strtolower($_GET['username'])));
$q = "SELECT * FROM utenti WHERE username='$doc'";
$r = mysql_query($q);
$info = mysql_fetch_array($r);
echo "utente collegato: ".$_SESSION['username'].'<br><br><a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a><br><br>';
echo '<a href="docenti.php"><img src="img/arrow_indietro.png" width="80" height="44" title="elenco docenti" alt="elenco docenti" align="left"></a><br><br><br>';
}
?>
<body>
 
<div class="units-row">
<div class="unit-centered unit-80">

<h3 align="center">Riepilogo delle attività svolte dal docente: <font color="#E56E94"><?php echo $info['nome'];?>&nbsp;<?php echo $info['cognome'];?></font></h3>

<br><br>

<div align="left">
Nella tabella che segue si possono vedere tutte le attività registrate finora da <font color="#E56E94"><?php echo $info['nome'];?>&nbsp;<?php echo $info['cognome'];?></font>.<br>
Puoi ordinare i dati in modo diverso cliccando sulle celle dell'intestazione.<br>
Le attività frontali (svolte con gli studenti) sono riportate in <font color='#005CB8'>blu</font>.
</div>

<br><br>

<?
$strSQL = "SELECT * FROM eventi WHERE utente='{$_GET['username']}' ORDER BY anno,mese,giorno,ora_ini asc"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<div class="table-container" align="center">
<table class="table-hovered sortable">
<tr>
 <th class="text-centered highlight sorttable_nosort">giorno</th>
 <th class="text-centered highlight">mese</th>
 <th class="text-centered highlight">anno</th>
 <th class="text-centered highlight sorttable_nosort">inizio</th>
 <th class="text-centered highlight sorttable_nosort">fine</th>
 <th class="text-centered highlight">durata<br>attività</th>
 <th class="text-centered highlight">durata<br>forfetaria</th>
 <th class="text-centered highlight">attività</th>
 <th class="text-centered highlight">categoria</th>
 <th class="text-centered highlight">tag</th>
</tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>

<tr>
<td class="text-centered"><?=$objResult["giorno"];?></td>
<td class="text-centered"><?=$objResult["mese"];?></td>
<td class="text-centered"><?=$objResult["anno"];?></td>
<td class="text-centered"><?=$objResult["ora_ini"].".".$objResult["min_ini"];?></td>
<td class="text-centered"><?=$objResult["ora_fine"].".".$objResult["min_fine"];?></td>
<td class="text-centered">
<?
if (($objResult["tag"]=='4') OR ($objResult["tag"]=='7') OR ($objResult["tag"]=='8') OR ($objResult["tag"]=='9') OR ($objResult["tag"]=='10')){
echo number_format((((($objResult["ora_fine"]*60)+($objResult["min_fine"]))-(($objResult["ora_ini"]*60)+($objResult["min_ini"])))/50), 2);
}
else {
echo number_format((((($objResult["ora_fine"]*60)+($objResult["min_fine"]))-(($objResult["ora_ini"]*60)+($objResult["min_ini"])))/60), 2);
}
?>
</td>
<td class="text-centered"><?=number_format($objResult["forfait"], 2);?></td>
<td>
<?if ($objResult["tipo"]=='f'){
echo '<font color="#005CB8">'.$objResult["descrizione"].'</font>';
}
else {
echo $objResult["descrizione"];
}
?>
</td>
<td class="text-centered"><?=$objResult["categoria"];?></td>
<td class="text-centered"><?=$objResult["tag"];?></td>
</tr>

<?
}
?>

</table>
</div>

<?
mysql_close($objConnect);
?>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM eventi WHERE utente='{$_GET['username']}' ORDER BY anno,mese,giorno,ora_ini asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysql_fetch_array($objQuery)
?>

<div class="tools-alert" align="right">
<b>Salva</b> questi dati esportando la tabella in <em>formato .csv</em> (OpenOffice Calc): <a href="tabelladoc_csv.php?username=<?=$_GET['username'];?>"><img src="img/csv.png" alt="esporta" width="30" height="30" title="esporta" align="middle" onclick="return confirm('Vuoi scaricare questa tabella in formato eXcel?\nUna copia del file verrà salvata sul server.')"></a>
</div>

<div class="tools-alert" align="right">
Esporta la tabella in <em>formato .pdf</em>: <a href="pdf_doc.php?username=<?=$_GET['username'];?>"><img src="img/pdf.png" alt="pdf" width="35" height="35" title="pdf" align="middle" onclick="return confirm('Vuoi scaricare la tabella in formato pdf?')"></a>
</div>

<?
mysql_close($objConnect);
?>

<br><br>

<div class="table-container" align="center">
<table class="table-stripped">
 <tr>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td class="text-left">Collegio docenti</td>
  <td class="text-centered">2</td>
  <td class="text-left">Consiglio di classe</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td class="text-left">riunione di dipartimento</td>
  <td class="text-centered">4</td>
  <td class="text-left">sostituzione collega assente</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td class="text-left">udienze</td>
  <td class="text-centered">6</td>
  <td class="text-left">corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td class="text-left">corso di recupero carenze (ed esami idoneità)</td>
  <td class="text-centered">8</td>
  <td class="text-left">sportello disciplinare</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td class="text-left">corso extracurricolare (sostegno, CLIL, ecc.)</td>
  <td class="text-centered">10</td>
  <td class="text-left">lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td class="text-left">programmazione con colleghi</td>
  <td class="text-centered">12</td>
  <td class="text-left">riunione di progetto/commissione</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td class="text-left">sorveglianza</td>
  <td class="text-centered">14</td>
  <td class="text-left">altro</td>
 </tr>
 <tr>
  <td class="text-centered">15</td>
  <td class="text-left">verbalista (forfait)</td>
  <td class="text-centered">16</td>
  <td class="text-left">coordinatore di classe (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">17</td>
  <td class="text-left">coordinatore di dipartimento (forfait)</td>
  <td class="text-centered">18</td>
  <td class="text-left">tutoraggio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">19</td>
  <td class="text-left">responsabile di laboratorio (forfait)</td>
  <td class="text-centered">20</td>
  <td class="text-left">responsabile/referente di progetto (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">21</td>
  <td class="text-left">responsabile di commissione (forfait)</td>
  <td class="text-centered">22</td>
  <td class="text-left">funzione strumentale (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">23</td>
  <td class="text-left">collaboratore del Dirigente (forfait)</td>
  <td class="text-centered">24</td>
  <td class="text-left">uscita o viaggio d'istruzione (forfait)</td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>