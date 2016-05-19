<!DOCTYPE html>
<html>
<head>
<title>consuntivo</title>
 
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
<style>
span.bar {
    background: url(img/bar.png) 0 0 repeat-y;
    display: block;
    width: 200px;
    line-height: 20px;
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
echo "utente collegato: ".$_SESSION['username'].'<br><br>'.'<a href="logout.php"><right><img src="img/out.png" width="55" height="55" title="logout" align="right"></right></a>';
}
?>
<body>
<?
$objConnect = mysql_connect("","","") or die("Impossibile selezionare il database");
$objDB = mysql_select_db("my_daado");
$strSQL = "SELECT * FROM utenti WHERE username='{$_SESSION['username']}'";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Mi spiace, ma non trovo i tuoi dati personali.";
}
else
{
?>
<?php echo $objResult["titolo"]." ".$objResult["nome"]." ".$objResult["cognome"];?>
<br>
<?php echo "scuola: ".$objResult["scuola"];?>
<br>
<?php echo "disciplina: ".$objResult["materia"];?>
<br>
<?php echo "a.s.: ".$objResult["anno"];?>
<?
}
?>
(oggi è il giorno: <?php echo (date("d-m-y"));?>)

<div class="units-row">
<div class="unit-centered unit-80">

<br><br>

 <h3 align="center">Consuntivo delle attività svolte</h3>
 
<br><br>

<?php
$monte=mysql_real_escape_string($_POST["monte"]);
if(!$monte)
{
   echo '<center><div class="tools-alert tools-alert-red"><a href="maths.php"><br><br><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a><br><br>'."Non hai inserito il tuo monte ore settimanale.".'<br>'."Non riesco a caricare i tuoi dati.".'</div></center><br><br><br><br>';
}
else
if (!(ctype_digit($monte)))
{
   echo '<center><div class="tools-alert tools-alert-red"><a href="maths.php"><br><br><img src="img/arrow_indietro.png" width="80" height="40" title="indietro"></a><br><br>'."Hai davvero inserito un numero intero?".'<br>'."Non riesco a caricare i tuoi dati.".'</div></center><br><br><br><br>';
}
else
{
?>

<div align="right">
Torna alla pagina di <a href="ore1.php">inserimento</a> dati.
<br><br>
Torna alla tabella di <a href="tabella.php">riepilogo</a>.
</div>

<br><br>

<div align="left">
 <ul>
  <li>Per le <samp>sostituzioni</samp>, i <samp>corsi di recupero</samp>, gli <samp>sportelli</samp>, i <samp>corsi extracurricolari</samp> e le <samp>lezioni itineranti</samp> (tag 4, 7, 8, 9 e 10) viene espresso in <font color="#7A5229"><b>unità orarie di 50'</b></font>.</li>
  <li>Per tutte le altre attività viene espresso in <font color="#7A5229"><b>unità orarie di 60'</b></font>.</li>
  <li>Tra parentesi viene indicato il numero di <font color="#297ACC">ore da fare</font>, proporzionale al monte ore cattedra.</li>
 </ul>
</div>

<br>

<?php
$aaa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$bbb = mysql_fetch_assoc($aaa);
$sss = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$ttt = mysql_fetch_assoc($sss);

$mmm = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_80_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='80' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$nnn = mysql_fetch_assoc($mmm);
$a = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_80_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='80' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$b = mysql_fetch_assoc($a);

$c = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$d = mysql_fetch_assoc($c);
$ooo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_70_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$ppp = mysql_fetch_assoc($ooo);
$u = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70f_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND tipo='f' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$v = mysql_fetch_assoc($u);
$uu = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_70f_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$vv = mysql_fetch_assoc($uu);
$x = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_70nf_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$y = mysql_fetch_assoc($x);
$uuu = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_70nf_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' AND tipo='nf' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$vvv = mysql_fetch_assoc($uuu);
$qq = mysql_query("SELECT SUM(forfait) AS somma_for_70_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' && forfait!='0' && (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$rr = mysql_fetch_assoc($qq);
$www = mysql_query("SELECT SUM(forfait) AS somma_for_70_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='70' && forfait!='0' && (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$zzz = mysql_fetch_assoc($www);

$e = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_40_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$f = mysql_fetch_assoc($e);
$qqq = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_40_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10' OR tag='12' OR tag='13' OR tag='14')");
$rrr = mysql_fetch_assoc($qqq);
$aa = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_40f_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='f' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$bb = mysql_fetch_assoc($aa);
$ee = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_40f_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='f' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10' OR tag='12' OR tag='13' OR tag='14')");
$ff = mysql_fetch_assoc($ee);
$cc = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_40nf_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='nf' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$dd = mysql_fetch_assoc($cc);
$gg = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_40nf_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' AND tipo='nf' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$hh = mysql_fetch_assoc($gg);
$ss = mysql_query("SELECT SUM(forfait) AS somma_for_40_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' && forfait!='0' && (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$tt = mysql_fetch_assoc($ss);
$ggg = mysql_query("SELECT SUM(forfait) AS somma_for_40_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='40' && forfait!='0' && (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$hhh = mysql_fetch_assoc($ggg);

$g = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_fondo_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$h = mysql_fetch_assoc($g);
$ccc = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_fondo50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='fondo' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$ddd = mysql_fetch_assoc($ccc);

$i = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_dubbie_60 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='dubbie' AND (tag='1' OR tag='2' OR tag='3' OR tag='5' OR tag='6' OR tag='11' OR tag='12' OR tag='13' OR tag='14' OR tag='15' OR tag='16' OR tag='17' OR tag='18' OR tag='19' OR tag='20' OR tag='21' OR tag='22' OR tag='23' OR tag='24')");
$l = mysql_fetch_assoc($i);
$eee = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_dubbie_50 FROM eventi WHERE utente='{$_SESSION['username']}' AND categoria='dubbie' AND (tag='4' OR tag='7' OR tag='8' OR tag='9' OR tag='10')");
$fff = mysql_fetch_assoc($eee);

$m = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_aggiornamento FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='6'");
$n = mysql_fetch_assoc($m);
$o = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_supplenze FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='4'");
$p = mysql_fetch_assoc($o);
$q = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_udienze FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='5'");
$r = mysql_fetch_assoc($q);
$s = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_collegi FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='1'");
$t = mysql_fetch_assoc($s);
$iii = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_consigli FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='2'");
$lll = mysql_fetch_assoc($iii);
$ii = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_recupero FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='7'");
$ll = mysql_fetch_assoc($ii);
$mm = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/50)+forfait) AS somma_sportello FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='8'");
$nn = mysql_fetch_assoc($mm);
$oo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_sorve FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='13'");
$pp = mysql_fetch_assoc($oo);
$xx = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)+forfait) AS somma_dip FROM eventi WHERE utente='{$_SESSION['username']}' AND tag='3'");
$zz = mysql_fetch_assoc($xx);

$stat80_tot = number_format((80*($monte/18)), 1);
$stat80_user = number_format(($b['somma_80_50']+$nnn['somma_80_60']), 1);
$stat80_fatte = round((100*($stat80_user/$stat80_tot)));
$pos80 = 200 - ($stat80_fatte / 100) * 200;

$stat40_tot = number_format((40*($monte/18)), 1);
$stat40_user = number_format(($f['somma_40_60']+$rrr['somma_40_50']), 1);
$stat40_fatte = round((100*($stat40_user/$stat40_tot)));
$pos40 = 200 - ($stat40_fatte / 100) * 200;

$stat40f_tot = number_format((30*($monte/18)), 1);
$stat40f_user = number_format(($bb['somma_40f_60']+$ff['somma_40f_50']), 1);
$stat40f_fatte = round((100*($stat40f_user/$stat40f_tot)));
$pos40f = 200 - ($stat40f_fatte / 100) * 200;

$statagg_tot = number_format((10*($monte/18)), 1);
$statagg_user = number_format(($n['somma_aggiornamento']), 1);
$statagg_fatte = round((100*($statagg_user/$statagg_tot)));
$posagg = 200 - ($statagg_fatte / 100) * 200;

$stat70f_tot = number_format((50*($monte/18)), 1);
$stat70f_user = number_format(($v['somma_70f_60']+$vv['somma_70f_50']), 1);
$stat70f_fatte = round((100*($stat70f_user/$stat70f_tot)));
$pos70f = 200 - ($stat70f_fatte / 100) * 200;

$stat70nf_tot = number_format((20*($monte/18)), 1);
$stat70nf_user = number_format(($y['somma_70nf_60']+$vvv['somma_70nf_50']), 1);
$stat70nf_fatte = round((100*($stat70nf_user/$stat70nf_tot)));
$pos70nf = 200 - ($stat70nf_fatte / 100) * 200;

$statcoll_tot = number_format((13*($monte/18)), 1);
$statcoll_user = number_format(($t['somma_collegi']), 1);
$statcoll_fatte = round((100*($statcoll_user/$statcoll_tot)));
$poscoll = 200 - ($statcoll_fatte / 100) * 200;

$statcons_tot = number_format((42*($monte/18)), 1);
$statcons_user = number_format(($lll['somma_consigli']), 1);
$statcons_fatte = round((100*($statcons_user/$statcons_tot)));
$poscons = 200 - ($statcons_fatte / 100) * 200;
}
 mysql_close($objConnect);
 ?>

<div class="table-container" align="center">
<table class="table-bordered">
 <tr>
 <th colspan="1" class="text-centered highlight">80 ore<br>attività funzionali<br>(<?php echo number_format((80*($monte/18)), 1);?>)</th>
 <th colspan="3" class="text-centered highlight">40 ore<br>potenziamento<br>(<?php echo number_format((40*($monte/18)), 1);?>)</th>
 <th colspan="3" class="text-centered highlight">recupero 70 ore<br>(<?php echo number_format((70*($monte/18)), 1);?>)</th>
 <th colspan="1" class="text-centered highlight">FUIS</th>
 <th class="text-centered highlight">attività<br>da definire</th>
 <th class="text-centered"></th>
 </tr>
   <tr>
     <td colspan="1" class="text-centered"><?php echo number_format(($nnn['somma_80_60']+$b['somma_80_50']), 2);?></td>
     <td colspan="3" class="text-centered"><?php echo number_format(($f['somma_40_60']+$rrr['somma_40_50']), 2);?></td>
     <td colspan="3" class="text-centered"><?php echo number_format(($d['somma_70_60']+$ppp['somma_70_50']), 2);?></td>
     <td colspan="1" class="text-centered"><?php echo number_format(($h['somma_fondo_60']+$ddd['somma_fondo_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($l['somma_dubbie_60']+$fff['somma_dubbie_50']), 2);?></td>
     <td class="text-centered">totale (al <?php echo (date("d-m-y"));?>):<br><?php echo number_format(($bbb['somma_60']+$ttt['somma_50']), 1);?> ore</td>
   </tr>
   <tr>
     <td class="text-centered"></td>
     <td class="text-centered">frontali</td>
     <td class="text-centered">non frontali</td>
     <td class="text-centered">forfait</td>
     <td class="text-centered">frontali<br>(<?php echo number_format((50*($monte/18)), 1);?>)</td>
     <td class="text-centered">non frontali<br>(<?php echo number_format((20*($monte/18)), 1);?>)</td>
     <td class="text-centered">forfait</td>
     <td class="text-centered"></td>
     <td class="text-centered"></td>
     <td class="text-centered"></td>
   </tr>
   <tr>
     <td class="text-centered"></td>
     <td class="text-centered"><?php echo number_format(($bb['somma_40f_60']+$ff['somma_40f_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($dd['somma_40nf_60']+$hh['somma_40nf_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($tt['somma_for_40_60']+$hhh['somma_for_40_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($v['somma_70f_60']+$vv['somma_70f_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($y['somma_70nf_60']+$vvv['somma_70nf_50']), 2);?></td>
     <td class="text-centered"><?php echo number_format(($rr['somma_for_70_60']+$zzz['somma_for_70_50']), 2);?></td>
     <td class="text-centered"></td>
     <td class="text-centered"></td>
     <td class="text-centered"></td>
   </tr>
</table>
</div>

<br><br>

<h3 align="center">TOTALE PER CATEGORIA</h3>

<div class="table-container" align="center">
<table>
 <tr>
  <td class="text-centered highlight"><b>aggiornamento</b><br>(<?php echo number_format((10*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>sostituzioni</b><br>(<?php echo number_format((15*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>udienze generali</b><br>(<?php echo number_format((9*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>collegi docenti</b><br>(<?php echo number_format((13*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>consigli di classe</b><br>(<?php echo number_format((42*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>dipartimenti</b><br>(<?php echo number_format((10*($monte/18)), 1);?> ore)</td>
  <td class="text-centered highlight"><b>corsi di recupero<br>ed esami idoneità</b></td>
  <td class="text-centered highlight"><b>sportelli<br>disciplinari</b></td>
  <td class="text-centered highlight"><b>sorveglianza</b><br>(<?php echo number_format((11*($monte/18)), 1);?> ore)</td>
  </tr>
 <tr>
  <td class="text-centered"><?php echo number_format(($n['somma_aggiornamento']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($p['somma_supplenze']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($r['somma_udienze']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($t['somma_collegi']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($lll['somma_consigli']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($zz['somma_dip']), 2);?></td>     
  <td class="text-centered"><?php echo number_format(($ll['somma_recupero']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($nn['somma_sportello']), 2);?></td>
  <td class="text-centered"><?php echo number_format(($pp['somma_sorve']), 2);?></td>
 </tr>
</table>
</div>

<br><br>

<h3 align="left">% delle ore prestate finora (sul totale dovuto)</h3>

<div align="left">
<?
echo '<label>80 ore (funzionali)</label>';
echo '<span class="bar" style="background-position: -'.$pos80.'px 0;">'.$stat80_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>40 ore</label>';
echo '<span class="bar" style="background-position: -'.$pos40.'px 0;">'.$stat40_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>40 ore frontali (potenziamento studenti)</label>';
echo '<span class="bar" style="background-position: -'.$pos40f.'px 0;">'.$stat40f_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>corsi di aggiornamento</label>';
echo '<span class="bar" style="background-position: -'.$posagg.'px 0;">'.$statagg_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>70 ore frontali</label>';
echo '<span class="bar" style="background-position: -'.$pos70f.'px 0;">'.$stat70f_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>70 ore non frontali</label>';
echo '<span class="bar" style="background-position: -'.$pos70nf.'px 0;">'.$stat70nf_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>collegi docenti</label>';
echo '<span class="bar" style="background-position: -'.$poscoll.'px 0;">'.$statcoll_fatte.'%</span>';
?>
</div>

<div align="left">
<?
echo '<label>consigli di classe</label>';
echo '<span class="bar" style="background-position: -'.$poscons.'px 0;">'.$statcons_fatte.'%</span>';
?>
</div>

<br><br>

<div class="tools-alert tools-alert-yellow" align="right">
Vai alle tue statistiche: <a href="statistiche.php"><img src="img/stats.png" alt="statistiche" width="40" height="40" title="statistche" valign="middle"></a>
</div>

</div>
</div>

</body>
</html>