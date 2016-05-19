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

<nav class="navbar navbar-pills">
 <ul>
  <li><a href="intro.php"><img src="img/what.png" width="35" height="35" alt="intro"></a></li>
  <li><a href="index.php"><img src="img/signin.png" width="35" height="35" alt="accedi"></a></li>
  <li><a href="info.php"><img src="img/pie.png" width="35" height="35" alt="numeri"></a></li>
  <li><a href="files.php"><img src="img/share.png" width="35" height="35" alt="condividi"></a></li>
 </ul>
</nav>

<div class="units-row">
<div class="unit-centered unit-80">

  <h1 align="center"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font>.</h1>
  <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>

<br><br>

<h3 align="center"><img src="img/signup.png" style="vertical-align:middle" width="45" height="45" alt="iscriviti">&nbsp;&nbsp;&nbsp;&nbsp;<font color="#94B84D">Registrazione</font>&nbsp;(per i nuovi utenti)</h3>

<br>

<div class="tools-alert tools-alert-yellow">
Per favore, compila <strong>tutti</strong> i seguenti campi:
</div>

<form action="registra.php" method="POST" class="forms">
<div class="table-container" align="center">
<table>
 <tr>
  <td>
   <select name="titolo">
    <option value="" disabled selected style='display:none;'> ...
    <option value="prof."> prof.
    <option value="prof.ssa"> prof.ssa
   </select>
  </td>
  <td>nome: <input type="text" name="nome"></td>
  <td>cognome: <input type="text" name="cognome"></td>
 </tr>
 <tr>
  <td>scuola:</td>
  <td colspan="2">
   <select name="scuola">
    <option value="" disabled selected style='display:none;'> - dove lavori -
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
  <td>disciplina:</td>
  <td colspan="2">
   <input type="text" name="materia" placeholder=" - cosa insegni - ">
  </td>
 </tr>
 <tr>
  <td>anno scolastico:</td>
  <td>
   <select name="anno">
    <option value="" disabled selected style='display:none;'> ...
    <option value="2015/16"> 2015/16
   </select>
  </td>
  <td></td>
 </tr>
 <tr>
  <td>scegli il tuo username:</td>
  <td><input type="text" name="username"></td>
  <td></td>
 </tr>
 <tr>
  <td>scegli la tua password:</td>
  <td><input type="password" name="password"></td>
  <td></td>
 </tr>
 <tr>
  <td>digita nuovamente la tua password:</td>
  <td><input type="password" name="papassword"></td>
  <td></td>
 </tr>
 <tr>
  <td>scrivi il tuo indirizzo email istituzionale:</td>
  <td class="input-groups"><input type="text" name="email" placeholder="nome.cognome"><span class="input-append">@scuole.provincia.tn.it</span></td>
  <td></td>
 </tr>
 <tr>
  <td>copia queste 4 cifre:</td>
  <td><img src="captcha.php" style="vertical-align:middle"></td>
  <td><input name="captcha" maxlength="4" type="text"></td>
 </tr>
 <tr>
  <td colspan="3">
   <input type="checkbox" name="condizioni" id="condizioni" value="condizioni" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spunta la casella se accetti le <a href="condizioni.php" target="_blank">condizioni</a> di utilizzo del sito.
  </td>
 </tr>
 <tr>
  <td colspan="3" class="text-centered"><input type="submit" name="clicca" value="registrati" class="btn btn-round" /></td>
 </tr>
</table>
</div>
</form>

</div>
</div>

</body>
</html>