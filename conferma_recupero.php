<!DOCTYPE html>
<html>
<head>
<title>conferma</title>
 
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

 <h3 align="center">Recupero credenziali di accesso</h3>

<br><br>

<?php
$nomehost = "";
$nomeuser = "";
$pass = "";
$dbname="my_daado";
$connessione = mysql_connect($nomehost,$nomeuser,$pass);
if(!$connessione) {
		die ("Connessione al server impossibile.");
        exit;
	}
$database_select=mysql_select_db($dbname,$connessione);
if(!$database_select) {
	die ("Impossibile selezionare il database.");
    exit;
}
$email=mysql_real_escape_string(strtolower($_POST["email"])) . "@scuole.provincia.tn.it";
$captcha=mysql_real_escape_string(($_POST["captcha"]));
$sqll = mysql_query("SELECT * FROM utenti WHERE email = '$email'");
$num_righe = mysql_num_rows($sqll);
$riga = mysql_fetch_assoc($sqll);
$username = $riga["username"];
$password = $riga["password"];
session_start();
if (!$_POST["email"] or !$captcha) {
		die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Non hai inserito l'indirizzo email e/o il codice.".'<br><br>'."Per favore torna indietro e completa entrambi i campi.".'</div><br><br>');
        exit;
	}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
               die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."L'indirizzo email che hai inserito non è in un formato valido.".'<br>'."Puoi recuperare le tue credenziali di accesso esclusivamente mediante l'indirizzo di posta elettronica istituzionale.".'<br><br>'."Per favore torna indietro e correggi.".'</div><br><br>');
               exit;
        }        
if ( $num_righe == 0 ) {
    die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."L'indirizzo email che hai inserito (".'<b>'.$email.'</b>'.") non corrisponde ad alcun utente registrato.".'<br>'."Chi utilizza questo indirizzo email non ha mai effettuato la registrazione a DAADO.".'</div><br><br>');
    exit;
    }
if ($_SESSION["code"]!=$captcha) {
	die ('<div class="tools-alert tools-alert-red">'."Errore.".'<br>'."Le cifre che hai copiato non corrispondono a quelle date. Per favore torna indietro e correggi.".'</div><br><br>');
	exit;
	}
else {
require_once("phpmailer/class.phpmailer.php");
$messaggio = new PHPMailer();
$messaggio->From      = 'alessandro.vallin@scuole.provincia.tn.it';
$messaggio->FromName  = 'DAADO - Database delle Attività Aggiuntive dei DOcenti';
$messaggio->Subject   = 'Recupero credenziali di accesso';
$messaggio->Body      = "Puoi accedere a DAADO con: \n username = ".$username."\n password = ".$password;
$messaggio->AddAddress($email);
$messaggio->Send();
 echo '<div class="tools-alert tools-alert-green">'."Perfetto: Username e password sono stati inviati correttamente al tuo indirizzo.".'<br><br>';
 echo "Ti suggerisco di prendere nota delle tue credenziali di accesso. :)".'<br></div><br><br><a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
mysql_close($connessione);
?>

</div>
</div>

 </body>
</html>