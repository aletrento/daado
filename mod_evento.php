<!DOCTYPE html>
<html>
<head>
<title>aggiornamento evento</title>
 
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

<br>

 <h3 align="center">Modifica evento<img src="img/update.gif" width="29" height="20" title="modifica" align="center"></h3>

<br><br>

<div align="right" class="tools-alert tools-alert-blue">
Torna alla <a href="db_eventi.php">tabella EVENTI</a>
</div>

<br><br>

<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM eventi WHERE id = '".$_GET["id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Impossibile caricare i dati.".$_GET["id"];
}
if (!$objResult["ora_ini"])
{
?>

<form action="salvafor_evento.php?id=<?=$_GET["id"];?>" name="editfor" method="POST" class="forms">
<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th class="text-centered highlight">utente</th>
  <th class="text-centered highlight">durata forfetaria (ore)</th>
  <th class="text-centered highlight">attività</th>
  <th class="text-centered highlight">categoria</th>
  <th class="text-centered highlight">tipo</th>
  <th class="text-centered highlight">tag</th>
 </tr>
 <tr>
  <td><input type="text" name="utente" maxlength="25" value="<?=$objResult["utente"];?>"></td>
  <td><input type="number" name="forfait" maxlength="2" value="<?=$objResult["forfait"];?>"></td>
  <td><input type="text" name="descrizione" maxlength="60" value="<?=$objResult["descrizione"];?>"></td>
  <td><input type="text" name="categoria" maxlength="8" value="<?=$objResult["categoria"];?>"></td>
  <td><input type="text" name="tipo" maxlength="2" value="<?=$objResult["tipo"];?>"></td>
  <td><input type="number" name="tag" maxlength="2" value="<?=$objResult["tag"];?>"></td>
 </tr>
</table>
</div>

<div align="right">
<input type="submit" name="submit" value="aggiorna" class="btn btn-round">
</div>
</form>

<br>

<div class="table-container" align="center">
<table class="table-bordered">
 <tr>
  <th colspan="4" class="text-centered"><font color="#6699FF">LEGENDA</font></th>
 </tr>
 <tr>
  <th class="text-centered highlight"><font color="#6699FF">nr. tag</font></th>
  <th class="text-left highlight"><font color="#6699FF">significato tag</font></th>
  <th class="text-left highlight"><font color="#6699FF">categorie</font></th>
  <th class="text-left highlight"><font color="#6699FF">tipo attività</font></th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td>Collegio docenti</td>
  <td>80</td>
  <td>f = frontale</td>
 </tr>
 <tr>
  <td class="text-centered">2</td>
  <td>Consiglio di classe</td>
  <td>40</td>
  <td>nf = non frontale</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td>riunione di dipartimento</td>
  <td>70</td>
 </tr>
 <tr>
  <td class="text-centered">4</td>
  <td>sostituzione collega assente</td>
  <td>fondo</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td>udienze</td>
  <td>dubbie</td>
 </tr>
 <tr>
  <td class="text-centered">6</td>
  <td>corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td>corso di recupero carenze</td>
 </tr>
 <tr>
  <td class="text-centered">8</td>
  <td>sportello didattico</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td>corso extracurricolare (sostegno, CLIL, ecc.)</td>
 </tr>
 <tr>
  <td class="text-centered">10</td>
  <td>lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td>programmazione con colleghi</td>
 </tr>
 <tr>
  <td class="text-centered">12</td>
  <td>riunione di progetto/commissione/gruppo di lavoro</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td>sorveglianza</td>
 </tr>
 <tr>
  <td class="text-centered">14</td>
  <td>altro</td>
 </tr>
 <tr>
  <td class="text-centered">15</td>
  <td>verbalista (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">16</td>
  <td>coordinatore di classe (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">17</td>
  <td>coordinatore di dipartimento (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">18</td>
  <td>tutoraggio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">19</td>
  <td>responsabile di laboratorio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">20</td>
  <td>responsabile/referente di progetto (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">21</td>
  <td>responsabile di commissione (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">22</td>
  <td>funzione strumentale (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">23</td>
  <td>collaboratore del Dirigente (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">24</td>
  <td>uscita o viaggio d'istruzione (forfait)</td>
 </tr>
</table>
</div>

<?	
}	
else
{
?>

<form action="salva_evento.php?id=<?=$_GET["id"];?>" name="edit" method="POST" class="forms">
<div class="table-container" align="center">
 <table class="table-hovered">
  <tr>
   <th class="text-centered highlight">utente</th>
   <th class="text-centered highlight">giorno</th>
   <th class="text-centered highlight">mese</th>
   <th class="text-centered highlight">anno</th>
   <th class="text-centered highlight">inizio (ora)</th>
   <th class="text-centered highlight">inizio (minuti)</th>
   <th class="text-centered highlight">fine (ora)</th>
   <th class="text-centered highlight">fine (minuti)</th>
   <th class="text-centered highlight">attività</th>
   <th class="text-centered highlight">categoria</th>
   <th class="text-centered highlight">tipo</th>
   <th class="text-centered highlight">tag</th>
  </tr>
  <tr>
   <td><input type="text" name="utente" maxlength="25" value="<?=$objResult["utente"];?>"></td>
   <td><input type="number" name="giorno" maxlength="2" value="<?=$objResult["giorno"];?>"></td>
   <td><input type="number" name="mese" maxlength="2" value="<?=$objResult["mese"];?>"></td>
   <td><input type="number" name="anno" maxlength="4" value="<?=$objResult["anno"];?>"></td>
   <td><input type="number" name="ora_ini" maxlength="2" value="<?=$objResult["ora_ini"];?>"></td>
   <td><input type="number" name="min_ini" maxlength="2" value="<?=$objResult["min_ini"];?>"></td>
   <td><input type="number" name="ora_fine" maxlength="2" value="<?=$objResult["ora_fine"];?>"></td>
   <td><input type="number" name="min_fine" maxlength="2" value="<?=$objResult["min_fine"];?>"></td>
   <td><input type="text" name="descrizione" maxlength="60" value="<?=$objResult["descrizione"];?>"></td>
   <td><input type="text" name="categoria" maxlength="8" value="<?=$objResult["categoria"];?>"></td>
   <td><input type="text" name="tipo" maxlength="2" value="<?=$objResult["tipo"];?>"></td>
   <td><input type="number" name="tag" maxlength="2" value="<?=$objResult["tag"];?>"></td>
  </tr>
 </table>
</div>

<div align="right">
<input type="submit" name="submit" value="aggiorna" class="btn btn-round">
</div>
</form>

<br>

<div class="table-container" align="center">
<table class="table-bordered">
 <tr>
  <th colspan="4" class="text-centered"><font color="#6699FF">LEGENDA</font></th>
 </tr>
 <tr>
  <th class="text-centered highlight"><font color="#6699FF">nr. tag</font></th>
  <th class="text-left highlight"><font color="#6699FF">significato tag</font></th>
  <th class="text-left highlight"><font color="#6699FF">categorie</font></th>
  <th class="text-left highlight"><font color="#6699FF">tipo attività</font></th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td>Collegio docenti</td>
  <td>80</td>
  <td>f = frontale</td>
 </tr>
 <tr>
  <td class="text-centered">2</td>
  <td>Consiglio di classe</td>
  <td>40</td>
  <td>nf = non frontale</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td>riunione di dipartimento</td>
  <td>70</td>
 </tr>
 <tr>
  <td class="text-centered">4</td>
  <td>sostituzione collega assente</td>
  <td>fondo</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td>udienze</td>
  <td>dubbie</td>
 </tr>
 <tr>
  <td class="text-centered">6</td>
  <td>corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td>corso di recupero carenze</td>
 </tr>
 <tr>
  <td class="text-centered">8</td>
  <td>sportello didattico</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td>corso extracurricolare (sostegno, CLIL, ecc.)</td>
 </tr>
 <tr>
  <td class="text-centered">10</td>
  <td>lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td>programmazione con colleghi</td>
 </tr>
 <tr>
  <td class="text-centered">12</td>
  <td>riunione di progetto/commissione/gruppo di lavoro</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td>sorveglianza</td>
 </tr>
 <tr>
  <td class="text-centered">14</td>
  <td>altro</td>
 </tr>
 <tr>
  <td class="text-centered">15</td>
  <td>verbalista (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">16</td>
  <td>coordinatore di classe (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">17</td>
  <td>coordinatore di dipartimento (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">18</td>
  <td>tutoraggio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">19</td>
  <td>responsabile di laboratorio (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">20</td>
  <td>responsabile/referente di progetto (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">21</td>
  <td>responsabile di commissione (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">22</td>
  <td>funzione strumentale (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">23</td>
  <td>collaboratore del Dirigente (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">24</td>
  <td>uscita o viaggio d'istruzione (forfait)</td>
 </tr>
</table>
</div>

<?
}
mysql_close($objConnect);
?>

</div>
</div>

</body>
</html>