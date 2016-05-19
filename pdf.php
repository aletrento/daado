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
include('mpdf/mpdf.php');
$giorno=date("d-m-Y-h:i");
$utente=$_SESSION['username'];
$mpdf=new mPDF('utf-8', 'A4-P');
$stylesheet = file_get_contents('css/kube.min.css');
ob_start();
?>
<html>
<body>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$q = "SELECT * FROM utenti WHERE username='$utente'";
$query = mysql_query($q) or die ("Error Query [".$q."]");
$risultato = mysql_fetch_array($query);
if(!$risultato)
{
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
else
{
echo '<small>'.$risultato["titolo"]." ".$risultato["nome"]." ".$risultato["cognome"].'<br>'."scuola: ".$risultato["scuola"].'<br>'."disciplina: ".$risultato["materia"].'<br>'."a.s.: ".$risultato["anno"].'</small><br>';
}
?>
<small>questo documento è stato creato il giorno: <?php echo (date("d-m-y"));?></small>
<div class="units-row">
<div class="unit-centered unit-95">
<br>
<h4 align="center">Riepilogo delle attività svolte</h4>
<br>
<?
$strSQL = "SELECT * FROM eventi WHERE utente='$utente' ORDER BY anno,mese,giorno,ora_ini asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<div class="tools-alert tools-alert-blue smaller">
Le <em>attività frontali</em> (svolte con gli studenti) sono riportate in blu.<br>
Per le sostituzioni, i corsi di recupero, gli sportelli, i corsi extracurricolari e le lezioni itineranti (tag 4, 7, 8, 9 e 10) la durata delle attività è espressa in <em>unità orarie di 50'</em>.<br>
La durata di tutte le altre attività è indicata in <em>unità orarie di 60'</em>.
</div>
<div class="table-container" align="center">
<table class="table-simple">
 <tr>
 <th class="text-centered highlight">giorno</th>
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
<?
if ($objResult["tipo"]=='f'){
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
mysql_close($objConnect);
?>
</table>
</div>

<div class="highlight text-right smaller light">
Questa tabella è stata fatta con <em>DAADO</em>.<br>
<var>http://daado.altervista.org/</var>
</div>

</div>
</div>
</body>
</html>
<?
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output('tabella_'.$utente.'_'.$giorno.'.pdf','I');
exit;
}
?>