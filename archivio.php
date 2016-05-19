<!DOCTYPE html>
<html>
<head>
<title>archivio</title>
 
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

<div class="units-row">
<div class="unit-centered unit-80">

 <div>
  <h2><p align="center">Archivio</p></h2>
 </div>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
$objDB = mysql_select_db("my_daado") or die("Impossibile selezionare il database.");
$user = $_SESSION['username'];
$as = $_POST['anno'];
$query = "SELECT * FROM archivio WHERE user='$user' AND anno='$as'";
$result = mysql_query($query);
$info = mysql_fetch_array($result);
if(!$as)
{
	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."non hai selezionato l'anno scolastico.".'</div><br><br>';
	echo '<center><a href="tabella.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
	exit;
}
else
if(mysql_num_rows($result)==0)
{
	echo '<div class="tools-alert tools-alert-red">'."Mi spiace.".'<br>'."L'archivio non contiene file relativi all'anno scolastico che hai scelto. Questo è il primo anno che registri attività su DAADO.".'</div><br><br>';
	echo '<center><a href="tabella.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a></center>';
	exit;
}
else
if(mysql_num_rows($result)==1)
{
$file = $info['file'];
$path = "./archivio/";
$out_file = $path.$file.'.csv';
chmod($out_file, 0777);
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="'.basename($out_file).'"');
header('Content-Length: ' . filesize($out_file));
ob_clean();
flush();
readfile($out_file);
exit();
}
mysql_close($objConnect);
?>

</div>
</div>
  
</body>
</html>
