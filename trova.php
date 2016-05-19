<!DOCTYPE html>
<html>
<head>
<title>trova</title>
 
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
<br>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<br><br>

<div class="units-row">
<div class="unit-centered unit-80">

<h3 align="center">Risultato ricerca</h3>

<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
mysql_set_charset('utf8_unicode_ci', $objConnect);
$objDB = mysql_select_db("my_daado");
$parola = mysql_real_escape_string(strtolower($_POST["descrizione"]));

if(!$parola)
{
echo '<div class="tools-alert tools-alert-red">'."Non hai inserito alcuna stringa da cercare.".'<br>'."Torna indietro.".'</div><br>'.'<a href="tabella.php"><img src="img/arrow_indietro.png" width="80" height="44" title="tabella" align="left"></a>';
}
else
{
$strSQL = "SELECT * FROM eventi WHERE utente='{$_SESSION['username']}' AND descrizione LIKE '%$parola%' ORDER BY anno,mese,giorno,ora_ini asc";
$objQuery = mysql_query($strSQL);
$trovati = mysql_num_rows($objQuery);
if($trovati > 0)
{
 echo '<div class="tools-alert tools-alert-green">'."Numero occorrenze di ".'<b>'.$parola.'</b>'." trovate = ".$trovati.'<br><br>';
while($objResult = mysql_fetch_array($objQuery)) {
	if (($objResult["tag"]=='4') OR ($objResult["tag"]=='7') OR ($objResult["tag"]=='8') OR ($objResult["tag"]=='9') OR ($objResult["tag"]=='10'))
	{
	 echo " -  ".$objResult["giorno"]."/".$objResult["mese"]."/".$objResult["anno"].": ".$objResult["descrizione"]." - durata:  ".number_format((((($objResult["ora_fine"]*60)+($objResult["min_fine"]))-(($objResult["ora_ini"]*60)+($objResult["min_ini"])))/50), 2)." ore (forfetarie: ".$objResult["forfait"].") --> registrate su ".$objResult["categoria"];
         echo '<br><br>';
        }
        else
        {
         echo " -  ".$objResult["giorno"]."/".$objResult["mese"]."/".$objResult["anno"].": ".$objResult["descrizione"]." - durata:  ".number_format((((($objResult["ora_fine"]*60)+($objResult["min_fine"]))-(($objResult["ora_ini"]*60)+($objResult["min_ini"])))/60), 2)." ore (forfetarie: ".$objResult["forfait"].") --> registrate su ".$objResult["categoria"];
         echo '<br><br>';
        }
}
echo '</div><br>'.'<a href="tabella.php"><img src="img/arrow_indietro.png" width="80" height="44" title="tabella" align="left"></a>';
}
else {
echo '<div class="tools-alert tools-alert-yellow">'."Mi spiace. La stringa ".'<b>'.$parola.'</b>'." non è presente nel campo 'attività'.".'</div><br>'.'<a href="tabella.php"><img src="img/arrow_indietro.png" width="80" height="44" title="tabella" align="left"></a>';
}
}
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>