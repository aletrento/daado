<!DOCTYPE html>
<html>
<head>
<title>tabella docente</title>
 
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
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database.");
$objDB = mysql_select_db("my_daado");
$doc=trim(mysql_real_escape_string(strtolower($_GET['username'])));
$q = "SELECT * FROM utenti WHERE username='$doc'";
$r = mysql_query($q);
$info = mysql_fetch_array($r);
echo "utente collegato: ".$_SESSION['username'].'<br><br><br><a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a><br><br><br>';
echo '<a href="docenti.php"><img src="img/arrow_indietro.png" width="80" height="44" title="elenco docenti" alt="elenco docenti" align="left"></a><br><br>';
}
?>
<body>

<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

<h3 align="center">Consuntivo del docente: <font color="#337DCA"><?php echo $info['nome'];?>&nbsp;<?php echo $info['cognome'];?></font>&nbsp;&nbsp;(al&nbsp;<?php echo (date("d-m-y"));?>)</h3>

<?
$strSQL = "SELECT * FROM eventi WHERE utente='{$_GET['username']}' ORDER BY anno,mese,giorno,ora_ini asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

$uuu = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_80_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$vvv = mysql_fetch_assoc($uuu);
$iiii = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_80_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$llll = mysql_fetch_assoc($iiii);
$xxx = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_cons_80 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tag='2'");
$zzz = mysql_fetch_assoc($xxx);
$aaaa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_dip_80 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tag='3'");
$bbbb = mysql_fetch_assoc($aaaa);
$cccc = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_ud_80 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tag='5'");
$dddd = mysql_fetch_assoc($cccc);
$eee = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_pro80 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tag='11'");
$fff = mysql_fetch_assoc($eee);
$aaa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_coll80 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tag='1'");
$bbb = mysql_fetch_assoc($aaa);
$eeee = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro_80_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tipo='nf' AND (tag='6' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$ffff = mysql_fetch_assoc($eeee);
$gggg = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_altro_80_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='80' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10' OR tag='14' OR tag='18')");
$hhhh = mysql_fetch_assoc($gggg);

$e = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_40_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$f = mysql_fetch_assoc($e);
$mmmm = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_40_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10' OR tag='12' OR tag='13' OR tag='14')");
$nnnn = mysql_fetch_assoc($mmmm);
$ggg = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_sos40 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='f' AND tag='4'");
$hhh = mysql_fetch_assoc($ggg);
$iii = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_agg40 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='nf' AND tag='6'");
$lll = mysql_fetch_assoc($iii);
$mmm = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_altro40f_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='f' AND (tag='7' OR tag='8' OR tag='9' OR tag='10' OR tag='12' OR tag='13' OR tag='14' OR tag='18')");
$nnn = mysql_fetch_assoc($mmm);
$oooo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro40f_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='f' AND tag='24'");
$pppp = mysql_fetch_assoc($oooo);
$g = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro40nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='40' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='11' OR tag='12' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23')");
$h = mysql_fetch_assoc($g);

$a = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$b = mysql_fetch_assoc($a);
$qqqq = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_70_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$rrrr = mysql_fetch_assoc($qqqq);

$o = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_70f_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$p = mysql_fetch_assoc($o);
$uuuu = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70f_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND (tag='13' OR tag='14' OR tag='24')");
$vvvv = mysql_fetch_assoc($uuuu);
$x = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='6' OR tag='11' OR tag='12' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23')");
$y = mysql_fetch_assoc($x);
$q = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_sosti70 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='4'");
$r = mysql_fetch_assoc($q);
$w = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_rec70 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='7'");
$z = mysql_fetch_assoc($w);
$aa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_spo70 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='8'");
$bb = mysql_fetch_assoc($aa);
$cc = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_sos70 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='9'");
$dd = mysql_fetch_assoc($cc);
$ee = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_sor70 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='13'");
$ff = mysql_fetch_assoc($ee);
$gg = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_usc70_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='10'");
$hh = mysql_fetch_assoc($gg);
$ssss = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_usc70_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND tag='24'");
$tttt = mysql_fetch_assoc($ssss);
$ii = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro70f FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='f' AND (tag='14' OR tag='18')");
$ll = mysql_fetch_assoc($ii);
$oo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_prog70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND tag='11'");
$pp = mysql_fetch_assoc($oo);
$qq = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_dip70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND tag='3'");
$rr = mysql_fetch_assoc($qq);
$ss = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_com70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND tag='12'");
$tt = mysql_fetch_assoc($ss);
$uu = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_ver70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND tag='15'");
$vv = mysql_fetch_assoc($uu);
$k = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_resp70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND (tag='16' OR tag='17' OR tag='20' OR tag='21')");
$j = mysql_fetch_assoc($k);
$mm = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro70nf FROM eventi WHERE utente='{$_GET['username']}' AND categoria='70' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='5' OR tag='6' OR tag='13' OR tag='14' OR tag='18' OR tag='19' OR tag='22' OR tag='23')");
$nn = mysql_fetch_assoc($mm);

$i = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_fondo_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$l = mysql_fetch_assoc($i);
$xxxx = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_fondo_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$zzzz = mysql_fetch_assoc($xxxx);
$s = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_rec_fondo FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tag='7'");
$t = mysql_fetch_assoc($s);
$qqq = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_corsi_fondo FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tag='9'");
$rrr = mysql_fetch_assoc($qqq);
$u = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_via_fondo_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tag='24'");
$v = mysql_fetch_assoc($u);
$aaaaa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_via_fondo_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tag='10'");
$bbbbb = mysql_fetch_assoc($aaaaa);
$ooo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_altro_fondo_60 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23')");
$ppp = mysql_fetch_assoc($ooo);
$ccccc = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_altro_fondo_50 FROM eventi WHERE utente='{$_GET['username']}' AND categoria='fondo' AND tipo='f' AND (tag='4' OR tag='8' OR tag='14' OR tag='16' OR tag='18')");
$ddddd = mysql_fetch_assoc($ccccc);
$sss = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_dubbie FROM eventi WHERE utente='{$_GET['username']}' AND categoria='dubbie'");
$ttt = mysql_fetch_assoc($sss);

mysql_close($objConnect);
?>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th colspan="2" class="text-centered highlight">80 ore - funzionali (totale = <?php echo number_format(($vvv['somma_80_60']+$llll['somma_80_50']), 1);?>)</th>
 </tr>
 <tr>
  <td>collegi docenti</td>
  <td><?php echo number_format(($bbb['somma_coll80']), 1);?></td>
 </tr>
 <tr>
  <td>consigli di classe</td>
  <td><?php echo number_format(($zzz['somma_cons_80']), 1);?></td>
 </tr>
 <tr>
  <td>dipartimenti disciplinari</td>
  <td><?php echo number_format(($bbbb['somma_dip_80']), 1);?></td>
 </tr>
 <tr>
  <td>programmazione didattica</td>
  <td><?php echo number_format(($fff['somma_pro80']), 1);?></td>
 </tr>
 <tr>
  <td>udienze</td>
  <td><?php echo number_format(($dddd['somma_ud_80']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività funzionali</td>
  <td><?php echo number_format(($ffff['somma_altro_80_60']+$hhhh['somma_altro_80_50']), 1);?></td>
 </tr>
</table>
</div>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th colspan="2" class="text-centered highlight">40 ore - potenziamento formativo (totale = <?php echo number_format(($f['somma_40_60']+$nnnn['somma_40_50']), 1);?>)</th>
 </tr>
 <tr>
  <td>sostituzioni di colleghi assenti</td>
  <td><?php echo number_format(($hhh['somma_sos40']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività con gli studenti</td>
  <td><?php echo number_format(($nnn['somma_altro40f_50']+$pppp['somma_altro40f_60']), 1);?></td>
 </tr>
 <tr>
  <td>corsi di aggiornamento</td>
  <td><?php echo number_format(($lll['somma_agg40']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività non frontali</td>
  <td><?php echo number_format(($h['somma_altro40nf']), 1);?></td>
 </tr>
</table>
</div>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th colspan="2" class="text-centered highlight">70 ore - recupero (totale = <?php echo number_format(($b['somma_70_60']+$rrrr['somma_70_50']), 1);?>)</th>
 </tr>
 <tr>
  <td class="text-centered">totale <b>ore frontali</b></td>
  <td><b><?php echo number_format(($p['somma_70f_50']+$vvvv['somma_70f_60']), 1);?></b></td>
 </tr>
 <tr>
  <td>corsi di recupero (ed esami idoneità)</td>
  <td><?php echo number_format(($z['somma_rec70']), 1);?></td>
 </tr>
 <tr>
  <td>sportelli disciplinari</td>
  <td><?php echo number_format(($bb['somma_spo70']), 1);?></td>
 </tr>
 <tr>
  <td>corsi extracurricolari (sostegno, CLIL, certificazioni linguistiche, ecc.)</td>
  <td><?php echo number_format(($dd['somma_sos70']), 1);?></td>
 </tr>
 <tr>
  <td>sostituzioni colleghi assenti</td>
  <td><?php echo number_format(($r['somma_sosti70']), 1);?></td>
 </tr>
 <tr>
  <td>sorveglianza</td>
  <td><?php echo number_format(($ff['somma_sor70']), 1);?></td>
 </tr>
 <tr>
  <td>lezioni itineranti / uscite</td>
  <td><?php echo number_format(($hh['somma_usc70_50']+$tttt['somma_usc70_60']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività frontali</td>
  <td><?php echo number_format(($ll['somma_altro70f']), 1);?></td>
 </tr>
 <tr>
  <td class="text-centered">totale <b> ore non frontali</b></td>
  <td><b><?php echo number_format(($y['somma_70nf']), 1);?></b></td>
 </tr>
 <tr>
  <td>progettazione didattica</td>
  <td><?php echo number_format(($pp['somma_prog70nf']), 1);?></td>
 </tr>
 <tr>
  <td>dipartimenti disciplinari (ore eccedenti)</td>
  <td><?php echo number_format(($rr['somma_dip70nf']), 1);?></td>
 </tr>
 <tr>
  <td>partecipazione a commissioni e gruppi di lavoro</td>
  <td><?php echo number_format(($tt['somma_com70nf']), 1);?></td>
 </tr>
 <tr>
  <td>verbalista</td>
  <td><?php echo number_format(($vv['somma_ver70nf']), 1);?></td>
 </tr>
 <tr>
  <td>coordinamento e/o responsabile commissione</td>
  <td><?php echo number_format(($j['somma_resp70nf']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività non frontali</td>
  <td><?php echo number_format(($nn['somma_altro70nf']), 1);?></td>
 </tr>
</table>
</div>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <th colspan="2" class="text-centered highlight">FUIS (totale = <?php echo number_format(($l['somma_fondo_60']+$zzzz['somma_fondo_50']), 1);?>)</th>
 </tr>
 <tr>
  <td>corsi di recupero</td>
  <td><?php echo number_format(($t['somma_rec_fondo']), 1);?></td>
 </tr>
 <tr>
  <td>corsi extracurricolari (sostegno, CLIL, certificazioni linguistiche, ecc.)</td>
  <td><?php echo number_format(($rrr['somma_corsi_fondo']), 1);?></td>
 </tr>
 <tr>
  <td>lezioni itineranti, uscite e viaggi</td>
  <td><?php echo number_format(($v['somma_via_fondo_60']+$bbbbb['somma_via_fondo_50']), 1);?></td>
 </tr>
 <tr>
  <td>altre attività (coordinamento, responsabile, tutoraggio, programmazione, ...)</td>
  <td><?php echo number_format(($ppp['somma_altro_fondo_60']+$ddddd['somma_altro_fondo_50']), 1);?></td>
 </tr>
</table>
</div>

<br><br>

<div class="table-container" align="center">
<table class="table-hovered">
 <tr>
  <td class="text-centered highlight">attività salvate ma<br>non ancora inserite in una categoria precisa</td>
  <td class="text-centered"><?php echo number_format(($ttt['somma_dubbie']), 1);?></td>
 </tr>
</table>
</div>

</div>
</div>

</body>
</html>