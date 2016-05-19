<!DOCTYPE html>
<html>
<head>
<title>inserimento dati</title>
 
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
<body bgcolor="#FFFFFF">
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM utenti WHERE username='{$_SESSION['username']}'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
else
{
echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"].'<br>'."scuola: ".$objResult["scuola"].'<br>'."disciplina: ".$objResult["materia"].'<br>'."a.s.: ".$objResult["anno"];
}
mysql_close($objConnect);
?>

(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h3 align="center">Registra le attività svolte - incarichi a forfait</h3>

<br><br>
 
<form class="forms" action="conferma_forfait.php" method="POST">

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;<font color="#6D8D4D"><b>Numero</b></font> delle ore riconosciute: <input type="text" name="forfait" maxlength="2" />

<br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;<font color="#6D8D4D"><b>Incarico</b></font> svolto: <input type="text" class="width-50" name="descrizione" maxlength="60" placeholder="descrivi brevemente l'attività" />

<br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona una <font color="#6D8D4D"><b>categoria</b></font>:
<select name="categoria">
	<option value="" disabled selected style='display:none;'> su quale articolo?
	<option value="80"> 80 (att. funzionali)
	<option value="40"> 40 (art. 3 - potenziamento)
	<option value="70"> 70 (art. 2)
	<option value="fondo"> FUIS
	<option value="dubbie"> non so ancora
</select>

<br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli il <font color="#6D8D4D"><b>tipo</b></font> di attività:
<select name="tipo">
	<option value="" disabled selected style='display:none;'> assieme agli studenti?
	<option value="f"> frontali
	<option value="nf"> non frontali
</select>

<br>

&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona un'etichetta (<font color="#6D8D4D"><b>tag</b></font>):

<br>

<div class="table-container" align="center">
<table class="table-hovered sortable">
 <tr>
   <th class="text-centered highlight"></th>
   <th class="text-centered highlight">tag</th>
   <th class="text-centered highlight"></th>
   <th class="text-centered highlight">tag</th>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="15" checked></td>
   <td>verbalista</td>
   <td><input type="radio" name="tag" value="16"></td>
   <td>coordinatore di classe</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="17"></td>
   <td>coordinatore di dipartimento</td>
   <td><input type="radio" name="tag" value="18"></td>
   <td>tutoraggio (a docenti e/o studenti)</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="19"></td>
   <td>responsabile di laboratorio</td>
   <td><input type="radio" name="tag" value="20"></td>
   <td>responsabile/referente di progetto</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="21"></td>
   <td>responsabile di commissione</td>
   <td><input type="radio" name="tag" value="22"></td>
   <td>funzione strumentale</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="23"></td>
   <td>collaboratore del Dirigente</td>
   <td><input type="radio" name="tag" value="24"></td>
   <td>uscita o viaggio d'istruzione</td>
 </tr>
 <tr>
   <td><input type="radio" name="tag" value="13"></td>
   <td>sorveglianza</td>
   <td><input type="radio" name="tag" value="14"></td>
   <td>altro</td>
 </tr> 
</table>
</div>

<div align="center">
<input type="submit" class="btn btn-round" name="invia" value="salva" />
</div>
</form>

<br>

<div class="tools-alert tools-alert-blue" align="right">
Torna alla pagina di <a href="ore1.php">inserimento</a> precedente.
</div>

</div>
</div>

</body>
</html>