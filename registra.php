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

 <h3 align="center">Creazione profilo</h3>

<br><br>

<?php
$nomehost = "";
$nomeuser = "";
$pass = "";
$dbname="my_daado";
$connessione = mysql_connect($nomehost,$nomeuser,$pass);
if(!$connessione){
		echo "Connessione al server impossibile.";
}
$database_select=mysql_select_db($dbname,$connessione);
if(!$database_select){
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
$papassword=mysql_real_escape_string(strtolower($_POST["papassword"]));
$email=mysql_real_escape_string(strtolower($_POST["email"])) . "@scuole.provincia.tn.it";
$length = 10;
$chiave = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$captcha=mysql_real_escape_string(($_POST["captcha"]));
$sqll = mysql_query("SELECT * FROM utenti WHERE email = '$email'");
$num_righe = mysql_num_rows($sqll);
session_start();
if (!$titolo or !$nome or !$cognome or !$scuola or !$materia or !$anno or !$username or !$password or !$papassword or !$email or !$captcha){
	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Tutti i campi sono obbligatori.".'<br><br>'."Per favore torna indietro e completa la procedura di registrazione.".'</div><br><br>';
}
elseif (empty($_POST['condizioni']) || $_POST['condizioni'] != 'condizioni'){
	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Non puoi registrarti senza accettare le condizioni di utilizzo del sito.".'<br><br>'."Per favore torna indietro e spunta la casella.".'</div><br><br>';
	exit;
}
elseif ($password!=$papassword){
	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Le due password che hai inserito non coincidono.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br>';
	exit;
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."L'indirizzo email che hai inserito non è in un formato valido.".'<br>'."Ti puoi registrare a DAADO utilizzando esclusivamente l'indirizzo di posta elettronica istituzionale.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br>';
    exit;
}
elseif ($_SESSION["code"]!=$captcha){
	die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Le cifre che hai copiato non corrispondono a quelle date. Per favore torna indietro e correggi.".'</div><br><br>');
	exit;
}
elseif ( $num_righe !== 0 ){
    echo '<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."L'indirizzo email ".'<b>'.$email.'</b>'." è già presente nel database.".'<br>'."Probabilmente hai già effettuato la registrazione a DAADO. Controlla la tua casella di posta elettronica istituzionale.".'</div><br><br>';
    exit;
}
else {
if (ctype_alnum($username)) {
$sql = mysql_query("SELECT * FROM utenti WHERE username = '$username'");
$num_rows = mysql_num_rows($sql);
if ( $num_rows == 0 ) {
$query="INSERT INTO utenti (titolo,nome,cognome,scuola,materia,anno,username,password,email,chiave,active) VALUES ('$titolo', '$nome', '$cognome', '$scuola', '$materia', '$anno', '$username', '$password', '$email', '$chiave',0)";
$nuovo=mysql_query($query);
require_once("phpmailer/class.phpmailer.php");
$messaggio = new PHPMailer();
$messaggio->From      = 'alessandro.vallin@scuole.provincia.tn.it';
$messaggio->FromName  = 'DAADO - Database delle Attività Aggiuntive dei DOcenti';
$messaggio->Subject   = 'Concludi la registrazione ed attiva il tuo profilo personale';
$messaggio->Body      = 'Clicca sul seguente collegamento (o copialo/incollalo nel browser) per attivare il tuo profilo: http://daado.altervista.org/attiva.php?username='.$username.'&chiave='.$chiave;
$messaggio->AddAddress($email);
$messaggio->Send();
 echo '<div class="tools-alert tools-alert-green">'."Perfetto: i tuoi dati personali sono stati salvati correttamente, e il tuo profilo è stato creato.".'<br><br>';
 echo "Per iniziare ad utilizzare DAADO non ti resta che concludere la registrazione.".'<br><b>'."Controlla la tua casella di posta elettronica istituzionale".'</b>'.", dove troverai un messaggio con le istruzioni per attivare il tuo profilo.".'</div><br><br><a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
elseif(!$nuovo) {
	die("Errore di registrazione.");
}
else {
die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Lo username ".'<b>'.$username.'</b>'." è già stato registrato nel database.".'<br>'."Per favore torna indietro e scegline uno diverso.".'</div><br><br>');
}
}
else {
die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Il campo username non può contenere lettere accentate, caratteri speciali e/o spazi vuoti. Solo stringhe di lettere e/o numeri. Per favore torna indietro e correggi.".'</div><br><br>');
}
}
mysql_close($connessione);
?>

</div>
</div>

 </body>
</html>