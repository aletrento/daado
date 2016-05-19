<!DOCTYPE html>
<html>
<head>
<title>statistiche</title>
 
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
<?php
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");

$n_utenti = mysql_query("SELECT * FROM utenti");
$utenti = (mysql_num_rows($n_utenti)-1);

$strSQL = "SELECT * FROM eventi GROUP BY utente";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$attivi = mysql_num_rows($objQuery);
$restanti = $utenti - $attivi;

$n_fem = mysql_query("SELECT * FROM utenti WHERE titolo='prof.ssa'");
$fem = mysql_num_rows($n_fem);
$mas = $utenti - $fem;

$n_eventi = mysql_query("SELECT * FROM eventi");
$eventi = mysql_num_rows($n_eventi);
$media_eventi = number_format($eventi/$attivi, 1);
$durata = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS durata FROM eventi");
$totdurata = mysql_fetch_assoc($durata);
$duratatot = number_format($totdurata['durata'], 1);

$n_80 = mysql_query("SELECT * FROM eventi WHERE categoria='80'");
$num80 = mysql_num_rows($n_80);
$per80 = number_format(($num80/$eventi)*100);
$n_70 = mysql_query("SELECT * FROM eventi WHERE categoria='70'");
$num70 = mysql_num_rows($n_70);
$per70 = number_format(($num70/$eventi)*100);
$n_40 = mysql_query("SELECT * FROM eventi WHERE categoria='40'");
$num40 = mysql_num_rows($n_40);
$per40 = number_format(($num40/$eventi)*100);
$n_fondo = mysql_query("SELECT * FROM eventi WHERE categoria='fondo'");
$numfondo = mysql_num_rows($n_fondo);
$perfondo = number_format(($numfondo/$eventi)*100);
$n_dubbie = mysql_query("SELECT * FROM eventi WHERE categoria='dubbie'");
$numdubbie = mysql_num_rows($n_dubbie);
$perdubbie = number_format(($numdubbie/$eventi)*100);

$dur_f = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS durataf FROM eventi WHERE tipo='f'");
$duf = mysql_fetch_assoc($dur_f);
$durf = $duf['durataf'];
$perdurf = number_format(($durf/$duratatot)*100);
$dur_nf = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS duratanf FROM eventi WHERE tipo='nf'");
$dunf = mysql_fetch_assoc($dur_nf);
$durnf = $dunf['duratanf'];
$perdurnf = number_format(($durnf/$duratatot)*100);
$dur_80 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS durata80 FROM eventi WHERE categoria='80'");
$du80 = mysql_fetch_assoc($dur_80);
$dur80 = $du80['durata80'];
$perdur80 = number_format(($dur80/$duratatot)*100);
$dur_70 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS durata70 FROM eventi WHERE categoria='70'");
$du70 = mysql_fetch_assoc($dur_70);
$dur70 = $du70['durata70'];
$perdur70 = number_format(($dur70/$duratatot)*100);
$dur_40 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS durata40 FROM eventi WHERE categoria='40'");
$du40 = mysql_fetch_assoc($dur_40);
$dur40 = $du40['durata40'];
$perdur40 = number_format(($dur40/$duratatot)*100);
$dur_fondo = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS duratafondo FROM eventi WHERE categoria='fondo'");
$dufondo = mysql_fetch_assoc($dur_fondo);
$durfondo = $dufondo['duratafondo'];
$perdurfondo = number_format(($durfondo/$duratatot)*100);
$dur_dubbie = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS duratadubbie FROM eventi WHERE categoria='dubbie'");
$dudubbie = mysql_fetch_assoc($dur_dubbie);
$durdubbie = $dudubbie['duratadubbie'];
$perdurdubbie = number_format(($durdubbie/$duratatot)*100);

$array_scuole = array();
$query = "SELECT * FROM utenti WHERE scuola!=''";
$result = mysql_query($query);
if ($result) {
while ($record = mysql_fetch_array($result))
    $array_scuole[] = $record['scuola'];
}

mysql_close($objConnect);
?>
<body>
 
<div class="units-row">
<div class="unit-centered unit-80">

<br>

<div class="group">
<a href="index.php"><img src="img/arrow_indietro.png" width="85" height="45" title="indietro" align="left"></a>
</div>

  <h1 align="center"><font color="#B8A08A">D</font>.<font color="#FFB870">A</font>.<font color="#9ABA88">A</font>.<font color="#ADC2FF">DO</font></h1>
  <h2 align="center"><font color="#B8A08A">D</font>atabase delle <font color="#FFB870">A</font>ttività <font color="#9ABA88">A</font>ggiuntive dei <font color="#ADC2FF">DO</font>centi</h2>

 <br><br>

  <h3 align="center">Informazioni sugli utenti registrati</h3>
 
 <br>

<div>
Ad oggi (<?php echo date("d-m-y");?>) risultano registrati <?php echo $utenti;?> <font color="#6977EE">utenti</font>: <?php echo $fem;?> femmine e <?php echo $mas;?> maschi.<br>
I docenti iscritti provengono dalle seguenti <font color="#6977EE">scuole</font>:<br>
</div>

<?php
foreach(array_count_values($array_scuole) as $k => $v)
echo "&nbsp;&#10003;&nbsp;&nbsp;".$k.": ".$v.'<br />';
?>

<br>

<div>
Dei <?php echo $utenti;?> utenti registrati, <?php echo $attivi;?> hanno salvato una o più attività, e sono quindi <font color="#6977EE">attivi</font>. I restanti <?php echo $restanti;?> non hanno ancora iniziato ad inserire dati.<br>
Sono state salvate nel database un <font color="#6977EE">numero</font> totale di <?php echo $eventi;?> attività aggiuntive (mediamente <?php echo $media_eventi;?> per ciascun utente attivo).<br>
Il numero delle attività registrate è suddiviso in:<br>
 <ul>
  <li><?php echo $per80;?>% attività funzionali;</li>
  <li><?php echo $per70;?>% attività relative all'art. 2;</li>
  <li><?php echo $per40;?>% attività di potenziamento (art. 3);</li>
  <li><?php echo $perfondo;?>% attività caricate sul FUIS;</li>
  <li><?php echo $perdubbie;?>% attività che devono essere ancora etichettate.</li>
 </ul>
La <font color="#6977EE">durata</font> complessiva delle attività registrate ammonta a <?php echo $duratatot;?> ore.<br>
Le attività <font color="#6977EE">frontali</font> (svolte assieme agli studenti) rappresentano il <?php echo $perdurf;?>%, mentre quelle <font color="#6977EE">non frontali</font> il <?php echo $perdurnf;?>%.<br>
Rispetto alla durata, le attività registrate sono così ripartite:<br>
 <ul>
  <li><?php echo $perdur80;?>% attività funzionali;</li>
  <li><?php echo $perdur70;?>% attività relative all'art. 2;</li>
  <li><?php echo $perdur40;?>% attività di potenziamento (art. 3);</li>
  <li><?php echo $perdurfondo;?>% attività caricate sul FUIS;</li>
  <li><?php echo $perdurdubbie;?>% attività che devono essere ancora etichettate.</li>
 </ul>
Il grafico seguente mostra la percentuale complessiva (rispetto al totale delle attività salvate da tutti gli utenti) delle attività relative a ciascun <font color="#6977EE"><i>tag</i></font>. Quelle di tipo forfetario non sono prese in considerazione.<br>

<center>
<figure><img src="grafico_08.php" /></figure>
</center>

Quest'altro grafico mostra la quantità totale delle ore caricate sul <font color="#6977EE"><i>FUIS</i></font> per ciascun tag, incluse le attività forfetarie.<br>

<center>
<figure><img src="grafico_09.php" /></figure>
</center>

<div class="table-container" align="center">
<table class="table-stripped">
 <tr>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
  <th class="text-centered highlight">nr. tag</th>
  <th class="text-centered highlight">significato</th>
 </tr>
 <tr>
  <td class="text-centered">1</td>
  <td class="text-left">Collegio docenti</td>
  <td class="text-centered">2</td>
  <td class="text-left">Consiglio di classe</td>
 </tr>
 <tr>
  <td class="text-centered">3</td>
  <td class="text-left">riunione di dipartimento</td>
  <td class="text-centered">4</td>
  <td class="text-left">sostituzione collega assente</td>
 </tr>
 <tr>
  <td class="text-centered">5</td>
  <td class="text-left">udienze</td>
  <td class="text-centered">6</td>
  <td class="text-left">corso di aggiornamento</td>
 </tr>
 <tr>
  <td class="text-centered">7</td>
  <td class="text-left">corso di recupero carenze (ed esami idoneità)</td>
  <td class="text-centered">8</td>
  <td class="text-left">sportello disciplinare</td>
 </tr>
 <tr>
  <td class="text-centered">9</td>
  <td class="text-left">corso extracurricolare (sostegno, CLIL, ecc.)</td>
  <td class="text-centered">10</td>
  <td class="text-left">lezione itinerante</td>
 </tr>
 <tr>
  <td class="text-centered">11</td>
  <td class="text-left">programmazione con colleghi</td>
  <td class="text-centered">12</td>
  <td class="text-left">riunione di progetto/commissione</td>
 </tr>
 <tr>
  <td class="text-centered">13</td>
  <td class="text-left">sorveglianza</td>
  <td class="text-centered">14</td>
  <td class="text-left">altro</td>
 </tr>
 <tr>
  <td class="text-centered">15</td>
  <td class="text-left">verbalista (forfait)</td>
  <td class="text-centered">16</td>
  <td class="text-left">coordinatore di classe (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">17</td>
  <td class="text-left">coordinatore di dipartimento (forfait)</td>
  <td class="text-centered">18</td>
  <td class="text-left">tutoraggio a docenti e/o studenti (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">19</td>
  <td class="text-left">responsabile di laboratorio (forfait)</td>
  <td class="text-centered">20</td>
  <td class="text-left">responsabile/referente di progetto (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">21</td>
  <td class="text-left">responsabile di commissione (forfait)</td>
  <td class="text-centered">22</td>
  <td class="text-left">funzione strumentale (forfait)</td>
 </tr>
 <tr>
  <td class="text-centered">23</td>
  <td class="text-left">collaboratore del Dirigente (forfait)</td>
  <td class="text-centered">24</td>
  <td class="text-left">uscita o viaggio d'istruzione (forfait)</td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>
