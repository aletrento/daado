<?php
session_start();
session_regenerate_id(TRUE);
if (!isset($_SESSION['username'] ) )
{
header('location:index.php');
exit;
}
else
{
include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_bar.php");
$objConnect = mysql_connect("","","") or die;
$objDB = mysql_select_db("my_daado");

$data = date("d-m-y");
$users = "SELECT * FROM utenti WHERE username != 'segreteria'"; 
$q_users = mysql_query($users);
$n_users = mysql_num_rows($q_users);

$settembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_settembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09'");
$tot_settembre = mysql_fetch_assoc($settembre);
$set = $tot_settembre['somma_settembre'];
$set_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS settembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='09' AND tipo='f'");
$tot_set_f = mysql_fetch_assoc($set_f);
$fset = $tot_set_f['settembre'];
$per_set = ($fset/$set)*100;

$ottobre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_ottobre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10'");
$tot_ottobre = mysql_fetch_assoc($ottobre);
$ott = $tot_ottobre['somma_ottobre'];
$ott_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS ottobre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='10' AND tipo='f'");
$tot_ott_f = mysql_fetch_assoc($ott_f);
$fott = $tot_ott_f['ottobre'];
$per_ott = ($fott/$ott)*100;

$novembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_novembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11'");
$tot_novembre = mysql_fetch_assoc($novembre);
$nov = $tot_novembre['somma_novembre'];
$nov_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS novembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='11' AND tipo='f'");
$tot_nov_f = mysql_fetch_assoc($nov_f);
$fnov = $tot_nov_f['novembre'];
$per_nov = ($fnov/$nov)*100;

$dicembre = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_dicembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12'");
$tot_dicembre = mysql_fetch_assoc($dicembre);
$dic = $tot_dicembre['somma_dicembre'];
$dic_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS dicembre FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='12' AND tipo='f'");
$tot_dic_f = mysql_fetch_assoc($dic_f);
$fdic = $tot_dic_f['dicembre'];
$per_dic = ($fdic/$dic)*100;

$gennaio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_gennaio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01'");
$tot_gennaio = mysql_fetch_assoc($gennaio);
$gen = $tot_gennaio['somma_gennaio'];
$gen_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS gennaio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='01' AND tipo='f'");
$tot_gen_f = mysql_fetch_assoc($gen_f);
$fgen = $tot_gen_f['gennaio'];
$per_gen = ($fgen/$gen)*100;

$febbraio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_febbraio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02'");
$tot_febbraio = mysql_fetch_assoc($febbraio);
$feb = $tot_febbraio['somma_febbraio'];
$feb_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS febbraio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='02' AND tipo='f'");
$tot_feb_f = mysql_fetch_assoc($feb_f);
$ffeb = $tot_feb_f['febbraio'];
$per_feb = ($ffeb/$feb)*100;

$marzo = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_marzo FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03'");
$tot_marzo = mysql_fetch_assoc($marzo);
$mar = $tot_marzo['somma_marzo'];
$mar_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS marzo FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='03' AND tipo='f'");
$tot_mar_f = mysql_fetch_assoc($mar_f);
$fmar = $tot_mar_f['marzo'];
$per_mar = ($fmar/$mar)*100;

$aprile = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_aprile FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04'");
$tot_aprile = mysql_fetch_assoc($aprile);
$apr = $tot_aprile['somma_aprile'];
$apr_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS aprile FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='04' AND tipo='f'");
$tot_apr_f = mysql_fetch_assoc($apr_f);
$fapr = $tot_apr_f['aprile'];
$per_apr = ($fapr/$apr)*100;

$maggio = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS somma_maggio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05'");
$tot_maggio = mysql_fetch_assoc($maggio);
$mag = $tot_maggio['somma_maggio'];
$mag_f = mysql_query("SELECT SUM(((((ora_fine*60)+(min_fine))-((ora_ini*60)+(min_ini)))/60)) AS maggio FROM eventi WHERE utente='{$_SESSION['username']}' AND mese='05' AND tipo='f'");
$tot_mag_f = mysql_fetch_assoc($mag_f);
$fmag = $tot_mag_f['maggio'];
$per_mag = ($fmag/$mag)*100;

$graph = new Graph(580,390);
$graph->SetScale("textint");

$ydata = array($per_set,$per_ott,$per_nov,$per_dic,$per_gen,$per_feb,$per_mar,$per_apr,$per_mag);
$user = $_SESSION['username'];

$graph->SetMargin(50,30,70,70);

$labels = array("set","ott","nov","dic","gen","feb","mar","apr","mag");
$graph->xaxis->SetTickLabels($labels);

$graph->title->Set('Percentuale delle ORE FRONTALI sul totale - mese per mese');
$graph->title->SetColor('#5074ee');
$graph->subtitle->Set("utente: $user (data: $data)");
$graph->yaxis->title->Set('percentuale rispetto al totale');
$graph->xaxis->title->Set('mesi');

$barplot=new BarPlot($ydata);
$graph->Add($barplot);
$barplot->SetFillGradient("#cdbe70","#eedc82",GRAD_HOR);
$barplot->SetColor("#cdbe70");

$graph->Stroke();
mysql_close($objConnect);
}
?>
