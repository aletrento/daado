<?php
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_bar.php");
$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");
$data = date("d-m-y");

$tag01 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag01 FROM eventi WHERE tag='01' && categoria='fondo'");
$tot_tag01 = mysql_fetch_assoc($tag01);
$durtag01 = $tot_tag01['tag01'];

$tag02 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag02 FROM eventi WHERE tag='02' && categoria='fondo'");
$tot_tag02 = mysql_fetch_assoc($tag02);
$durtag02 = $tot_tag02['tag02'];

$tag03 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag03 FROM eventi WHERE tag='03' && categoria='fondo'");
$tot_tag03 = mysql_fetch_assoc($tag03);
$durtag03 = $tot_tag03['tag03'];

$tag04 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag04 FROM eventi WHERE tag='04' && categoria='fondo'");
$tot_tag04 = mysql_fetch_assoc($tag04);
$durtag04 = $tot_tag04['tag04'];

$tag05 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag05 FROM eventi WHERE tag='05' && categoria='fondo'");
$tot_tag05 = mysql_fetch_assoc($tag05);
$durtag05 = $tot_tag05['tag05'];

$tag06 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag06 FROM eventi WHERE tag='06' && categoria='fondo'");
$tot_tag06 = mysql_fetch_assoc($tag06);
$durtag06 = $tot_tag06['tag06'];

$tag07 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag07 FROM eventi WHERE tag='07' && categoria='fondo'");
$tot_tag07 = mysql_fetch_assoc($tag07);
$durtag07 = $tot_tag07['tag07'];

$tag08 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag08 FROM eventi WHERE tag='08' && categoria='fondo'");
$tot_tag08 = mysql_fetch_assoc($tag08);
$durtag08 = $tot_tag08['tag08'];

$tag09 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag09 FROM eventi WHERE tag='09' && categoria='fondo'");
$tot_tag09 = mysql_fetch_assoc($tag09);
$durtag09 = $tot_tag09['tag09'];

$tag10 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag10 FROM eventi WHERE tag='10' && categoria='fondo'");
$tot_tag10 = mysql_fetch_assoc($tag10);
$durtag10 = $tot_tag10['tag10'];

$tag11 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag11 FROM eventi WHERE tag='11' && categoria='fondo'");
$tot_tag11 = mysql_fetch_assoc($tag11);
$durtag11 = $tot_tag11['tag11'];

$tag12 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag12 FROM eventi WHERE tag='12' && categoria='fondo'");
$tot_tag12 = mysql_fetch_assoc($tag12);
$durtag12 = $tot_tag12['tag12'];

$tag13 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag13 FROM eventi WHERE tag='13' && categoria='fondo'");
$tot_tag13 = mysql_fetch_assoc($tag13);
$durtag13 = $tot_tag13['tag13'];

$tag14 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag14 FROM eventi WHERE tag='14' && categoria='fondo'");
$tot_tag14 = mysql_fetch_assoc($tag14);
$durtag14 = $tot_tag14['tag14'];

$tag15 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag15 FROM eventi WHERE tag='15' && categoria='fondo'");
$tot_tag15 = mysql_fetch_assoc($tag15);
$durtag15 = $tot_tag15['tag15'];

$tag16 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag16 FROM eventi WHERE tag='16' && categoria='fondo'");
$tot_tag16 = mysql_fetch_assoc($tag16);
$durtag16 = $tot_tag16['tag16'];

$tag17 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag17 FROM eventi WHERE tag='17' && categoria='fondo'");
$tot_tag17 = mysql_fetch_assoc($tag17);
$durtag17 = $tot_tag17['tag17'];

$tag18 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag18 FROM eventi WHERE tag='18' && categoria='fondo'");
$tot_tag18 = mysql_fetch_assoc($tag18);
$durtag18 = $tot_tag18['tag18'];

$tag19 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag19 FROM eventi WHERE tag='19' && categoria='fondo'");
$tot_tag19 = mysql_fetch_assoc($tag19);
$durtag19 = $tot_tag19['tag19'];

$tag20 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag20 FROM eventi WHERE tag='20' && categoria='fondo'");
$tot_tag20 = mysql_fetch_assoc($tag20);
$durtag20 = $tot_tag20['tag20'];

$tag21 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag21 FROM eventi WHERE tag='21' && categoria='fondo'");
$tot_tag21 = mysql_fetch_assoc($tag21);
$durtag21 = $tot_tag21['tag21'];

$tag22 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag22 FROM eventi WHERE tag='22' && categoria='fondo'");
$tot_tag22 = mysql_fetch_assoc($tag22);
$durtag22 = $tot_tag22['tag22'];

$tag23 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag23 FROM eventi WHERE tag='23' && categoria='fondo'");
$tot_tag23 = mysql_fetch_assoc($tag23);
$durtag23 = $tot_tag23['tag23'];

$tag24 = mysql_query("SELECT SUM((((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60))+forfait) AS tag24 FROM eventi WHERE tag='24' && categoria='fondo'");
$tot_tag24 = mysql_fetch_assoc($tag24);
$durtag24 = $tot_tag24['tag24'];

$graph = new Graph(580,390);
$graph->SetScale("textint");
$ydata = array($durtag01,$durtag02,$durtag03,$durtag04,$durtag05,$durtag06,$durtag07,$durtag08,$durtag09,$durtag10,$durtag11,$durtag12,$durtag13,$durtag14,$durtag15,$durtag16,$durtag17,$durtag18,$durtag19,$durtag20,$durtag21,$durtag22,$durtag23,$durtag24);
$graph->SetMargin(50,30,70,70);
$labels = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24");
$graph->xaxis->SetTickLabels($labels);
$graph->title->Set('Numero ore (calcolate in unità di 60 minuti) caricate sul FUIS - incluse quelle forfetarie');
$graph->title->SetColor('#2E5C00');
$graph->subtitle->Set("calcolato su tutti gli utenti (data: $data)");
$graph->yaxis->title->Set('numero ore');
$graph->xaxis->title->Set('# tag (vedi legenda sotto)');
$barplot=new BarPlot($ydata);
$graph->Add($barplot);
$barplot->SetFillGradient("#E0E0D1","#CCCCB2",GRAD_HOR);
$barplot->SetColor("#CCCCB2");
$graph->Stroke();

mysql_close($objConnect);
?>
