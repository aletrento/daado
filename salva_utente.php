<!DOCTYPE html>
<html>
<head>
<title>conferma modifica utente</title>
 
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

<div align="right" class="tools-alert tools-alert-blue">
Torna alla <a href="db_utenti.php">tabella UTENTI</a>
</div>

<br><br>

 <h3 align="center">Conferma modifica utente</h3>
 
<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$titolo=mysql_real_escape_string($_POST["titolo"]);
$nome=mysql_real_escape_string($_POST["nome"]);
$cognome=mysql_real_escape_string($_POST["cognome"]);
$scuola=mysql_real_escape_string($_POST["scuola"]);
$materia=mysql_real_escape_string($_POST["materia"]);
$anno=mysql_real_escape_string($_POST["anno"]);
$username=mysql_real_escape_string($_POST["username"]);
$password=mysql_real_escape_string($_POST["password"]);
$email=mysql_real_escape_string($_POST["email"]);
$active=mysql_real_escape_string($_POST["active"]);
$accesso=mysql_real_escape_string($_POST["accesso"]);

if (!$username or !$password or !$active)
{
echo '<br><div class="tools-alert tools-alert-red">'."Impossibile salvare i tuoi dati perché HAI LASCIATO QUALCHE CAMPO VUOTO O QUALCHE VALORE UGUALE A ZERO.".'<br>'."Per favore torna indietro e completa.".'</div>';
}
else
 if (!ctype_digit($active))
  {
  	echo '<br><div class="tools-alert tools-alert-red">'."Attenzione. C'è qualcosa di strano nel campo ACTIVE che hai indicato. Sono ammessi solo i valori numerici 0 e 1.".'<br>'."Per favore torna indietro e correggi.".'</div>';
  }
else
  {
$sql="UPDATE utenti SET titolo='$titolo', nome='$nome', cognome='$cognome', scuola='$scuola', materia='$materia', anno='$anno', username='$username', password='$password', email='$email', active='$active', accesso='$accesso' WHERE id='".$_GET["id"]."' ";
$update=mysql_query($sql);
echo '<div class="tools-alert tools-alert-green">'."Modifica effettuata correttamente.".'</div><br>';
  }
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>