<?php
session_start();
session_regenerate_id(TRUE);
if (!isset($_SESSION['username'])){
header('location:index.php');
exit;
}
else
{
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_line.php");
$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");
$giorno = date("d-m-y");
$default = 0;

$set40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40set FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09' AND categoria='40'");
$tot40set = mysql_fetch_assoc($set40);
$set_40 = $tot40set['somma40set'];
$ott40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40ott FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10' AND categoria='40'");
$tot40ott = mysql_fetch_assoc($ott40);
$ott_40 = $tot40ott['somma40ott'];
$nov40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40nov FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11' AND categoria='40'");
$tot40nov = mysql_fetch_assoc($nov40);
$nov_40 = $tot40nov['somma40nov'];
$dic40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40dic FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12' AND categoria='40'");
$tot40dic = mysql_fetch_assoc($dic40);
$dic_40 = $tot40dic['somma40dic'];
$gen40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40gen FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01' AND categoria='40'");
$tot40gen = mysql_fetch_assoc($gen40);
$gen_40 = $tot40gen['somma40gen'];
$feb40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40feb FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02' AND categoria='40'");
$tot40feb = mysql_fetch_assoc($feb40);
$feb_40 = $tot40feb['somma40feb'];
$mar40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40mar FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03' AND categoria='40'");
$tot40mar = mysql_fetch_assoc($mar40);
$mar_40 = $tot40mar['somma40mar'];
$apr40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40apr FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04' AND categoria='40'");
$tot40apr = mysql_fetch_assoc($apr40);
$apr_40 = $tot40apr['somma40apr'];
$mag40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40mag FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05' AND categoria='40'");
$tot40mag = mysql_fetch_assoc($mag40);
$mag_40 = $tot40mag['somma40mag'];
$giu40 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma40giu FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='06' AND categoria='40'");
$tot40giu = mysql_fetch_assoc($giu40);
$giu_40 = $tot40giu['somma40giu'];

$set70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70set FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09' AND categoria='70'");
$tot70set = mysql_fetch_assoc($set70);
$set_70 = $tot70set['somma70set'];
$ott70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70ott FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10' AND categoria='70'");
$tot70ott = mysql_fetch_assoc($ott70);
$ott_70 = $tot70ott['somma70ott'];
$nov70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70nov FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11' AND categoria='70'");
$tot70nov = mysql_fetch_assoc($nov70);
$nov_70 = $tot70nov['somma70nov'];
$dic70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70dic FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12' AND categoria='70'");
$tot70dic = mysql_fetch_assoc($dic70);
$dic_70 = $tot70dic['somma70dic'];
$gen70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70gen FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01' AND categoria='70'");
$tot70gen = mysql_fetch_assoc($gen70);
$gen_70 = $tot70gen['somma70gen'];
$feb70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70feb FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02' AND categoria='70'");
$tot70feb = mysql_fetch_assoc($feb70);
$feb_70 = $tot70feb['somma70feb'];
$mar70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70mar FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03' AND categoria='70'");
$tot70mar = mysql_fetch_assoc($mar70);
$mar_70 = $tot70mar['somma70mar'];
$apr70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70apr FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04' AND categoria='70'");
$tot70apr = mysql_fetch_assoc($apr70);
$apr_70 = $tot70apr['somma70apr'];
$mag70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70mag FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05' AND categoria='70'");
$tot70mag = mysql_fetch_assoc($mag70);
$mag_70 = $tot70mag['somma70mag'];
$giu70 = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma70giu FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='06' AND categoria='70'");
$tot70giu = mysql_fetch_assoc($giu70);
$giu_70 = $tot70giu['somma70giu'];

$setfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisset FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09' AND categoria='fondo'");
$totfuisset = mysql_fetch_assoc($setfuis);
$set_fuis = $totfuisset['sommafuisset'];
$ottfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisott FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10' AND categoria='fondo'");
$totfuisott = mysql_fetch_assoc($ottfuis);
$ott_fuis = $totfuisott['sommafuisott'];
$novfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisnov FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11' AND categoria='fondo'");
$totfuisnov = mysql_fetch_assoc($novfuis);
$nov_fuis = $totfuisnov['sommafuisnov'];
$dicfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisdic FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12' AND categoria='fondo'");
$totfuisdic = mysql_fetch_assoc($dicfuis);
$dic_fuis = $totfuisdic['sommafuisdic'];
$genfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisgen FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01' AND categoria='fondo'");
$totfuisgen = mysql_fetch_assoc($genfuis);
$gen_fuis = $totfuisgen['sommafuisgen'];
$febfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisfeb FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02' AND categoria='fondo'");
$totfuisfeb = mysql_fetch_assoc($febfuis);
$feb_fuis = $totfuisfeb['sommafuisfeb'];
$marfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuismar FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03' AND categoria='fondo'");
$totfuismar = mysql_fetch_assoc($marfuis);
$mar_fuis = $totfuismar['sommafuismar'];
$aprfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisapr FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04' AND categoria='fondo'");
$totfuisapr = mysql_fetch_assoc($aprfuis);
$apr_fuis = $totfuisapr['sommafuisapr'];
$magfuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuismag FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05' AND categoria='fondo'");
$totfuismag = mysql_fetch_assoc($magfuis);
$mag_fuis = $totfuismag['sommafuismag'];
$giufuis = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS sommafuisgiu FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='06' AND categoria='fondo'");
$totfuisgiu = mysql_fetch_assoc($giufuis);
$giu_fuis = $totfuisgiu['sommafuisgiu'];

if(empty($set_40)){$set_40 = $default;}
if(empty($ott_40)){$ott_40 = $default;}
if(empty($nov_40)){$nov_40 = $default;}
if(empty($dic_40)){$dic_40 = $default;}
if(empty($gen_40)){$gen_40 = $default;}
if(empty($feb_40)){$feb_40 = $default;}
if(empty($mar_40)){$mar_40 = $default;}
if(empty($apr_40)){$apr_40 = $default;}
if(empty($mag_40)){$mag_40 = $default;}
if(empty($giu_40)){$giu_40 = $default;}

if(empty($set_70)){$set_70 = $default;}
if(empty($ott_70)){$ott_70 = $default;}
if(empty($nov_70)){$nov_70 = $default;}
if(empty($dic_70)){$dic_70 = $default;}
if(empty($gen_70)){$gen_70 = $default;}
if(empty($feb_70)){$feb_70 = $default;}
if(empty($mar_70)){$mar_70 = $default;}
if(empty($apr_70)){$apr_70 = $default;}
if(empty($mag_70)){$mag_70 = $default;}
if(empty($giu_70)){$giu_70 = $default;}

if(empty($set_fuis)){$set_fuis = $default;}
if(empty($ott_fuis)){$ott_fuis = $default;}
if(empty($nov_fuis)){$nov_fuis = $default;}
if(empty($dic_fuis)){$dic_fuis = $default;}
if(empty($gen_fuis)){$gen_fuis = $default;}
if(empty($feb_fuis)){$feb_fuis = $default;}
if(empty($mar_fuis)){$mar_fuis = $default;}
if(empty($apr_fuis)){$apr_fuis = $default;}
if(empty($mag_fuis)){$mag_fuis = $default;}
if(empty($giu_fuis)){$giu_fuis = $default;}

$ydata1 = array($set_40,$ott_40,$nov_40,$dic_40,$gen_40,$feb_40,$mar_40,$apr_40,$mag_40,$giu_40);
$ydata2 = array($set_70,$ott_70,$nov_70,$dic_70,$gen_70,$feb_70,$mar_70,$apr_70,$mag_70,$giu_70);
$ydata3 = array($set_fuis,$ott_fuis,$nov_fuis,$dic_fuis,$gen_fuis,$feb_fuis,$mar_fuis,$apr_fuis,$mag_fuis,$giu_fuis);
$user = $_SESSION['username'];

$width=580;
$height=390;
$graph = new Graph($width,$height);
$graph->SetScale('intlin');
$theme_class = new SoftyTheme();
$graph->SetTheme($theme_class);
$labels = array("set","ott","nov","dic","gen","feb","mar","apr","mag","giu");
$graph->xaxis->SetTickLabels($labels);

$graph->title->Set('TOTALE (espresso in unità orarie di 60 minuti) - escluse le attività forfetarie');
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("utente: $user (data: $giorno)");
$graph->yaxis->title->Set('ore mensili');
$graph->xaxis->title->Set('mesi');

$lineplot1=new LinePlot($ydata1);
$lineplot2=new LinePlot($ydata2);
$lineplot3=new LinePlot($ydata3);

$graph->Add($lineplot1);
$graph->Add($lineplot2);
$graph->Add($lineplot3);

$lineplot1->SetWeight(6);
$lineplot2->SetWeight(6);
$lineplot3->SetWeight(6);

$lineplot1->SetLegend('art. 3 (40)');
$lineplot2->SetLegend('art. 2 (70)');
$lineplot3->SetLegend('FUIS');

$graph->img->SetAntiAliasing(false);
$graph->Stroke();
mysql_close($objConnect);
}
?>