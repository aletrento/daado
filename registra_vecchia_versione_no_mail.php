<!DOCTYPE html>
<html>
<head>
<title>registrazione</title>
 
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

<div>
<img src="img/dado.png" align="right" width="100" height="100" title="logo" hspace="10" vspace="10" />
</div>

<br>

 <h3 align="center">Conferma registrazione</h3>

<br><br>

<?php
$nomehost = "";
$nomeuser = "";
$pass = "";
$dbname="my_daado";
$connessione = mysql_connect($nomehost,$nomeuser,$pass);
if(!$connessione)
	{
		echo "Connessione al server impossibile.";
	}
$database_select=mysql_select_db($dbname,$connessione);
if(!$database_select)
{
	echo "Impossibile selezionare il database.";
}
$titolo=($_POST["titolo"]);
$nome=($_POST["nome"]);
$cognome=mysql_real_escape_string(($_POST["cognome"]));
$scuola=addslashes($_POST["scuola"]);
$materia=mysql_real_escape_string(($_POST["materia"]));
$anno=($_POST["anno"]);
$username=mysql_real_escape_string(strtolower($_POST["username"]));
$password=mysql_real_escape_string(strtolower($_POST["password"]));
$email=mysql_real_escape_string(strtolower($_POST["email"])) . "@scuole.provincia.tn.it";
$length = 10;
$chiave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$captcha=mysql_real_escape_string(($_POST["captcha"]));
session_start();
if (!$titolo or !$nome or !$cognome or !$scuola or !$materia or !$anno or !$username or !$password or !$email or !$captcha)
	{
		echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."tutti i campi sono obbligatori.".'<br><br>'."Per favore torna indietro e completa la procedura di registrazione.".'</div><br><br>';
	}
elseif (empty($_POST['condizioni']) || $_POST['condizioni'] != 'condizioni')
        {
               echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."non puoi registrarti senza accettare le condizioni di utilizzo del sito.".'<br><br>'."Per favore torna indietro e spunta la casella.".'</div><br><br>';
               exit;
        }
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
               echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."l'indirizzo email che hai inserito non è in un formato valido.".'<br>'."Ti puoi registrare a DAADO utilizzando esclusivamente l'indirizzo di posta elettronica istituzionale.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br>';
        }        
elseif ($_SESSION["code"]!=$captcha)
	{
	die ('<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."le cifre che hai copiato non corrispondono a quelle date. Per favore torna indietro e correggi.".'</div><br><br>');
	exit;
	}
else{
if (ctype_alnum($username)) {
$sql = mysql_query("SELECT * FROM utenti WHERE username = '$username'");
$num_rows = mysql_num_rows($sql);
if ( $num_rows == 0 ) {
$query="INSERT INTO utenti (titolo,nome,cognome,scuola,materia,anno,username,password,email,chiave,active) VALUES ('$titolo', '$nome', '$cognome', '$scuola', '$materia', '$anno', '$username', '$password', '$email', '$chiave',0)";
$nuovo=mysql_query($query);
if(!$nuovo)
{
	die("Errore di registrazione.");
}
else
echo '<div class="tools-alert tools-alert-green">'."Perfetto:".'<br>'."i tuoi dati personali sono stati salvati correttamente, e il tuo profilo è stato creato.".'<br><br>'."Prendi nota del tuo username (".'<font color="#1975FF"><b>'.$username.'</b></font>'.") e della tua password (".'<font color="#1975FF"><b>'.$password.'</b></font>'.").".'<br>'."Ti serviranno per accedere al sito e caricare i tuoi dati.".'</div>';
echo '<br><br><br>'."Clicca sulla freccia per effettuare il log in ed iniziare a registrare le attività che hai svolto.".'<br><br>'.'<a href="index.php"><img src="img/arrow_indietro.png" width="100" height="55" title="accedi" align="left"></a>';
}
else
echo '<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."lo username ".'<b>'.$username.'</b>'." è già stato registrato nel database.".'<br>'."Per favore torna indietro e scegline uno diverso.".'</div><br><br>';
}
else
die ('<div class="tools-alert tools-alert-red">'."Errore:".'<br>'."il campo username non può contenere lettere accentate, caratteri speciali e/o spazi vuoti. Solo stringhe di lettere e/o numeri. Per favore torna indietro e correggi.".'</div><br><br>');
}
mysql_close($connessione);
?>

</div>
</div>

 </body>
</html>