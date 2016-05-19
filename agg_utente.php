<!DOCTYPE html>
<html>
<head>
<title>aggiunta utente</title>
 
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="keywords" content="docenti, scuola secondaria, Trentino, ore, database, articoli, recupero">
<meta name="description" content="sito per la registrazione delle attività aggiuntive svolte a scuola">
<meta name="author" content="Alessandro Vallin">

<link rel="stylesheet" href="css/kube.min.css" />
<link rel="stylesheet" href="css/stile.css" />
<link rel="stylesheet" href="css/animate.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="icon" href="img/clip.ico" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
<script src="js/kube.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="jquery/external/jquery/jquery.js"></script>
<script src="jquery/jquery-ui.js"></script>
<style type="text/css">
div {
  -webkit-animation-delay: 3s;
  -moz-animation-delay: 3s;
  -ms-animation-delay: 3s;
}
</style>
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
echo "utente collegato: ".$_SESSION['username'].'<br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
?>
<body>

<div class="units-row">
<div class="unit-centered unit-80">

<br>

 <h3 align="center">Inserisci un nuovo utente nel database</h3>

<br>

<form action="conferma_utente.php" method="POST" style="font-family: 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif;" class="forms">
<div class="table-container" align="center">
<table>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli il <font color="#6D8D4D"><b>titolo</b></font>:</td>
  <td>
  <select name="titolo">
	<option value="" disabled selected style='display:none;'> ...
	<option value="prof."> prof.
	<option value="prof.ssa"> prof.ssa
  </select>
  </td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Inserisci il <font color="#6D8D4D"><b>nome</b></font>:</td>
  <td><input id="nome" type="text" name="nome" class="width-30" maxlength="25" placeholder="William" /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Inserisci il <font color="#6D8D4D"><b>cognome</b></font>:</td>
  <td><input id="cognome" type="text" name="cognome" class="width-30" maxlength="25" placeholder="Shakespeare" /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona la <font color="#6D8D4D"><b>scuola</b></font>:</td>
  <td>
   <select name="scuola" id="scuola">
    <option value="" disabled selected style='display:none;'> - dove lavora -
    <option value="Liceo 'A. Rosmini' - Trento"> Liceo "A. Rosmini" - Trento
    <option value="Liceo 'G. Galilei' - Trento"> Liceo "G. Galilei" - Trento
    <option value="Liceo 'L. da Vinci' - Trento"> Liceo "L. da Vinci" - Trento
    <option value="Liceo 'G. Prati' - Trento"> Liceo "G. Prati" - Trento
    <option value="I. T. 'A. Pozzo' - Trento"> I. T. "A. Pozzo" - Trento
    <option value="I. T. 'Tambosi / Battisti' - Trento"> I. T. "Tambosi / Battisti" - Trento
    <option value="Liceo Artistico 'A. Vittoria' - Trento"> Liceo Artistico "A. Vittoria" - Trento
    <option value="I. T. 'M. Buonarroti' - Trento"> I. T. "M. Buonarroti" - Trento
    <option value="Liceo Musicale 'F. Bonporti' - Trento"> Liceo Musicale "F. Bonporti" - Trento
    <option value="Liceo 'A. Rosmini' - Rovereto"> Liceo "A. Rosmini" - Rovereto
    <option value="I. I. 'F. Filzi' - Rovereto"> I. I. "F. Filzi" - Rovereto
    <option value="I. T. 'F. e G. Fontana' - Rovereto"> I. T. "F. e G. Fontana" - Rovereto
    <option value="I. T. 'G. Marconi' - Rovereto"> I. T. "G. Marconi" - Rovereto
    <option value="I. I. 'don Milani' - Rovereto"> I. I. "don Milani" - Rovereto
    <option value="I. I. 'Depero' - Rovereto"> I. I. "Depero" - Rovereto
    <option value="Liceo 'A. Maffei' - Riva del Garda"> Liceo "A. Maffei" - Riva del Garda
    <option value="I. I. 'G. Floriani' - Riva del Garda"> I. I. "G. Floriani" - Riva del Garda
    <option value="I. I. 'M. Martini' - Mezzolombardo"> I. I. "M. Martini" - Mezzolombardo
    <option value="I. I. 'M. Curie' - Pergine"> I. I. "M. Curie" - Pergine
    <option value="Liceo 'B. Russell' - Cles"> Liceo "B. Russell" - Cles
    <option value="I. T. 'C. A. Pilati' - Cles"> I. T. "C. A. Pilati" - Cles
    <option value="I. I. 'A. Degasperi' - Borgo"> I. I. "A. Degasperi" - Borgo
    <option value="I. I. 'L. Guetti' - Tione"> I. I. "L. Guetti" - Tione
    <option value="I. I. 'Rosa Bianca - Weisse Rose' - Cavalese"> I. I. "Rosa Bianca - Weisse Rose" - Cavalese
    <option value="I. I. - Pozza di Fassa"> I. I. - Pozza di Fassa
    <option value="I. I. - Fiera di Primiero"> I. I. - Fiera di Primiero
   </select>
  </td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Inserisci la <font color="#6D8D4D"><b>disciplina</b></font>:</td>
  <td><input id="materia" type="text" name="materia" class="width-20" maxlength="30" placeholder=" - cosa insegna - " /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Seleziona l'<font color="#6D8D4D"><b>anno scolastico</b></font>:</td>
  <td>
   <select name="anno" id="anno">
    <option value="" disabled selected style='display:none;'> ...
    <option value="2015/16"> 2015/16
   </select>
  </td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli un <font color="#6D8D4D"><b>username</b></font>:</td>
  <td><input id="username" type="text" name="username" class="width-20" maxlength="25" /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Scegli una <font color="#6D8D4D"><b>password</b></font>:</td>
  <td><input id="password" type="text" name="password" class="width-20" maxlength="25" /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;Inserisci un <font color="#6D8D4D"><b>indirizzo e-mail</b></font>:</td>
  <td><input id="email" type="text" name="email" class="width-40" maxlength="60" /></td>
 </tr>
 <tr>
  <td>&nbsp;&nbsp;&#x2714;&nbsp;&nbsp;<font color="#6D8D4D"><b>Attiva</b></font> l'utente:</td>
  <td>
  attivato&nbsp;&nbsp;<input type="radio" name="active" value="1" checked>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;disattivato&nbsp;&nbsp;<input type="radio" name="active" value="0">
  </td>
 </tr>
</table>
</div>
<div align="center">
<input type="submit" name="invia" value="salva" class="btn btn-round" />
</div>
</form> 

</div>
</div>

</body>
</html>