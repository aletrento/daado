<!DOCTYPE html>
<html>
<head>
<title>verifica accesso</title>
 
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
<body>
  
<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

 <h3 align="center">Verifica credenziali di accesso</h3>

<?
session_start();
session_regenerate_id(TRUE);

$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
$objDB = mysql_select_db("my_daado");
$username=trim(mysql_real_escape_string(strtolower($_POST['username'])));
$password=mysql_real_escape_string(strtolower($_POST['password']));
$query = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
$result = mysql_query($query);
$info = mysql_fetch_array($result);
if((!$username) OR (!$password))
{
	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."non hai inserito le tue credenziali.".'</div>';
	echo '<div align="center"><a href="index.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a><br><br>'."ritorna alla pagina di accesso".'</div>';
	exit;
}
else
if(mysql_num_rows($result)==1)
{
if($username == segreteria)
{
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
echo '<a href="logout.php"><img src="img/out.png" width="55" height="55" title="logout" align="right" /></a><br><br><br>'."utente collegato: $username".'<br><br><br>'.'<div align="center"><a href="docenti.php"><img src="img/arrow.png" width="80" height="40" title="accedi" /></a><br><br>'."controlla la situazione di ciascun docente".'</div>';
}
else
{
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;
$adesso = date('M j, Y @ G:i');
$getll = mysql_query("SELECT accesso FROM utenti WHERE username='$username'") or die("<div class='tools-alert tools-alert-red'>Errore:<br>non non riesco a recuperare i tuoi dati di accesso</div><br>");
list($lastlogin) = mysql_fetch_row($getll);
// Set session variable
$_SESSION['lastlogin'] = $lastlogin;
// Update New LastLogin
$updatelog = mysql_query("UPDATE utenti SET accesso='$adesso' WHERE username='$username'") or die("<font color='#FF4719'>Errore:</font><br>non non riesco ad aggiornare i tuoi dati<br>");

if (!$info['accesso'])
{
echo '<div align="right"><a href="logout.php"><img src="img/out.png" width="55" height="55" alt="logout" title="logout" align="right" /></a></div><br><br><br>'.'<div class="tools-alert tools-alert-green">'."utente collegato:".'<br>'.$info['titolo']." ".$info['nome']." ".$info['cognome'].'<br>'."scuola: ".$info['scuola'].'<br>'."disciplina: ".$info['materia'].'<br>'."anno scolastico: ".$info['anno'].'<br><br>'."ultimo accesso: non disponibile".'</div><br>'.'<div class="tools-alert tools-alert-blue" align="center"><b>'."Scegli come procedere:".'</b></div><div class="table-container" align="center"><table><tr><td>'."registra le attività che hai svolto".'</td><td><a href="ore.php"><img src="img/i.png" width="100" height="100" alt="registra" title="registra attività" /></a></td></tr><tr><td>'."visualizza le attività che hai già salvato".'</td><td><a href="tabella.php"><img src="img/t.png" width="100" height="100" alt="vedi tabella" title="vedi tabella" /></a></td></tr><tr><td>'."vai al consuntivo".'</td><td><a href="maths.php"><img src="img/c.png" width="100" height="100" alt="consuntivo" title="consuntivo" /></a></td></tr></table></div><br><br><br><div class="tools-alert tools-alert-yellow">'."Hai due minuti per un rapido questionario?&nbsp;&nbsp;&nbsp;".'<a href="questionario.php"><img src="img/iconaq.png" width="45" height="45" title="questionario" align="middle" /></a></div>';
}
else
{
echo '<div align="right"><a href="logout.php"><img src="img/out.png" width="55" height="55" alt="logout" title="logout" align="right" /></a></div><br><br><br>'.'<div class="tools-alert tools-alert-green">'."utente collegato:".'<br>'.$info['titolo']." ".$info['nome']." ".$info['cognome'].'<br>'."scuola: ".$info['scuola'].'<br>'."disciplina: ".$info['materia'].'<br>'."anno scolastico: ".$info['anno'].'<br><br>'."ultimo accesso: ".$info['accesso'].'</div><br>'.'<div class="tools-alert tools-alert-blue" align="center"><b>'."Scegli come procedere:".'</b></div><div class="table-container" align="center"><table><tr><td>'."registra le attività che hai svolto".'</td><td><a href="ore.php"><img src="img/i.png" width="100" height="100" alt="registra" title="registra attività" /></a></td></tr><tr><td>'."visualizza le attività che hai già salvato".'</td><td><a href="tabella.php"><img src="img/t.png" width="100" height="100" alt="vedi tabella" title="vedi tabella" /></a></td></tr><tr><td>'."vai al consuntivo".'</td><td><a href="maths.php"><img src="img/c.png" width="100" height="100" alt="consuntivo" title="consuntivo" /></a></td></tr></table></div><br><br><br><div class="tools-alert tools-alert-yellow">'."Hai due minuti per un rapido questionario?&nbsp;&nbsp;&nbsp;".'<a href="questionario.php"><img src="img/iconaq.png" width="45" height="45" title="questionario" align="middle" /></a></div>';
}
}
}
else
{
	echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."username e/o password non sono corretti.".'</div>';
	echo '<div align="center"><a href="index.php"><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a><br><br>'."ritorna alla pagina di accesso".'</div>';
	exit;
}
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>