<?	
		
$tfleets = $fleets;
if($TIME_1 == 0)	{	$tfleets = 1;	}
if($TIME_2 == 0)	{	$tfleets = 2;	}
if($TIME_3 == 0)	{	$tfleets = 3;	}
if($TIME_4 == 0)	{	$tfleets = 4;	}
		
$warhp = $wardef * 100;
$archhp = $archdef * 120;
$prihp = $pridef * 80;
$wizhp = $wizdef * 75;
$golemhp = $wizdef * 100;
$irongolemhp = $wizdef * 100;

if($uwarrior > 0)	{	$u_tally = $u_tally + 1;	 }
elseif($uwizard > 0)	{	$u_tally = $u_tally + 1;	 }
elseif($upriest > 0)	{	$u_tally = $u_tally + 1;	 }
elseif($uarcher > 0)	{	$u_tally = $u_tally + 1;	 }
elseif($ugolem > 0)	{	$u_tally = $u_tally + 1;	 }
elseif($uirongolem > 0)	{	$u_tally = $u_tally + 1;	 }

$divided_pts = $evpower / $u_tally;
		
if($uwarrior > 0)	{		
	$subwar = (($uwarrior * $warhp) - $divided_pts) / $warhp;
	if($subwar < 0)	{	$subwar = 0;	}
		$subwar = round($subwar);
		$warcol = "war" . "$tfleets";
	mysql_query("UPDATE returntbl SET $warcol='$subwar' WHERE email='$email' AND pw='$pw'");
	$warriors = $warriors - $uwarrior;
	mysql_query("UPDATE military SET warriors='$warriors' WHERE email='$email' AND pw='$pw'");
}
if($uwizard > 0)	{		
	$subwiz = (($uwizard * $wizhp) - $divided_pts) / $wizhp;
	if($subwiz < 0)	 {	$subwiz = 0;	}
		$subwiz = round($subwiz);
		$wizcol = "wiz" . "$tfleets";
	mysql_query("UPDATE returntbl SET $wizcol='$subwiz' WHERE email='$email' AND pw='$pw'");
	$wizards = $wizards - $uwizard;
	mysql_query("UPDATE military SET wizards='$wizards' WHERE email='$email' AND pw='$pw'");
}
if($upriest > 0)	{		
	$subpri = (($upriest * $prihp) - $divided_pts) / $prihp;
	if($subpri < 0)	{	$subpri = 0;	}
		$subpri = round($subpri);
		$pricol = "pri" . "$tfleets";
	mysql_query("UPDATE returntbl SET $pricol='$subpri' WHERE email='$email' AND pw='$pw'");
	$priests = $priests - $upriest;
	mysql_query("UPDATE military SET priests='$priests' WHERE email='$email' AND pw='$pw'");
}
if($uarcher > 0)	{
	$subarch = (($uarcher * $archhp) - $divided_pts) / $archhp;
	if($subarch < 0)	{	$subarch = 0;	}
		$subarch = round($subarch);
		$archcol = "arch" . "$tfleets";
	mysql_query("UPDATE returntbl SET $archcol='$subarch' WHERE email='$email' AND pw='$pw'");
	$archers = $archers - $uarcher;
	mysql_query("UPDATE military SET archers='$archers' WHERE email='$email' AND pw='$pw'");
}
if($ugolem > 0)	{
	$subgolem = (($ugolem * $archhp) - $divided_pts) / $golemhp;
	if($subgolem < 0)	{	$subgolem = 0;	}
		$subgolem = round($subgolem);
		$golemcol = "golem" . "$tfleets";
	mysql_query("UPDATE returntbl SET $golemcol='$subgolem' WHERE email='$email' AND pw='$pw'");
	$golem = $golem - $ugolem;
	mysql_query("UPDATE military SET golem='$golem' WHERE email='$email' AND pw='$pw'");
}
if($uirongolem > 0)	{
	$subirongolem = (($uirongolem * $irongolemhp) - $divided_pts) / $irongolemhp;
	if($subirongolem < 0)	{	$subirongolem = 0;	}
		$subirongolem = round($subirongolem);
		$irongolemcol = "irongolem" . "$tfleets";
	mysql_query("UPDATE returntbl SET $archcol='$subirongolem' WHERE email='$email' AND pw='$pw'");
	$irongolem = $irongolem - $uirongolem;
	mysql_query("UPDATE military SET irongolem='$irongolem' WHERE email='$email' AND pw='$pw'");
}
	
if($uwarrior > 0 AND $uwarrior != "")	{	$wspeed = $warspeedw + $warspeeda;	}
if($uwizard > 0 AND $uwizard != "")	{	$wispeed = $wizspeeds + $wizspeeda;	}
if($upriest > 0 AND $upriest != "")	{	$pspeed = $prispeedw + $prispeeda;	 }
if($uarcher > 0 AND $uarcher != "")	{	$aspeed = $archspeedw + $archspeeda;	}
if($ugolem > 0 AND $ugolem != "")	{	$golemspeed = 20;	}
if($uirongolem > 0 AND $uirongolem != "")	{	$irongolemspeed = 25;	}

$R_time = max($wspeed, $wispeed, $pspeed, $aspeed, $golemspeed, $irongolemspeed);
		
if($race == 'Elf')	{
	$R_time = $R_time * .8; 
	$R_time = floor($R_time);
}
if($race == ' Night Elf')	{
	$R_time = $R_time * .75; 
	$R_time = floor($R_time);
}

$returning = "time" . "$tfleets";
mysql_query("UPDATE returntbl SET $returning='$R_time' WHERE email='$email' AND pw='$pw'");
mysql_query("UPDATE user SET fleets = fleets - 1 WHERE email='$email' AND pw='$pw'");

############################
##	losses for empire being attacked
############################

if($evm[archdef] == 0)	{	$evm[archdef] = 1;	}
$evcatapulthp = 140 * 12;
$evarchhp = 120 * $evm[archdef];
$evwarhp = 100 * $evm[wardef];
$evprihp = 80 * $evm[pridef];
$evwizhp = 75 * $evm[wizdef];
$evgolemhp = 100 * 20;
$evirongolemhp = 100 * 25;

if($evm[warriors] > 0)	{	$evtally = $evtally + 1;	 }
if($evm[wizards] > 0)	{	$evtally = $evtally + 1;	 }
if($evm[priests] > 0)	 {	$evtally = $evtally + 1;	 }
if($evm[archers] > 0)	{	$evtally = $evtally + 1;	 }
if($evm[catapult] > 0)	{	$evtally = $evtally + 1;	 }
if($evm[golem] > 0)	{	$evtally = $evtally + 1;	 }
if($evm[irongolem] > 0)	{	$evtally = $evtally + 1;	 }
		
if($evtally >= 1)	{	$evpts = $cdefense / $evtally;	}
	
if($evm[warriors] > 0)	{
	$ev_warloss = (($evm[warriors] * $evwarhp) - $evpts) / $evwarhp;
	if($ev_warloss < 0)	{	$ev_warloss = 0;	}
	mysql_query("UPDATE military SET warriors = round($ev_warloss) WHERE userid='$empvalue'");
}
if($evm[wizards] > 0)	{
	$ev_wizloss = (($evm[wizards] * $evwizhp) - $evpts) / $evwizhp;
	if($ev_warloss < 0)	{	$ev_warloss = 0;	}
	mysql_query("UPDATE military SET wizards = round($ev_wizloss) WHERE userid='$empvalue'");
}
if($evm[priests] > 0)	 {
	$ev_priloss = (($evm[priests] * $evprihp) - $evpts) / $evprihp;		
	if($ev_priloss < 0)	{	$ev_priloss = 0;	}
	mysql_query("UPDATE military SET priests = round($ev_priloss) WHERE userid='$empvalue'");
}
if($evm[archers] > 0)	{
	$ev_archloss = (($evm[archers] * $evarchhp) - $evpts) / $evarchhp;
	if($ev_archloss < 0)	{	$ev_archloss = 0;	 }
	mysql_query("UPDATE military SET archers = round($ev_archloss) WHERE userid='$empvalue'");
}
if($evm[catapult] > 0)	{
	$ev_catapultloss = (($evm[catapult] * $evcatapulthp) - $evpts) / $evcatapulthp;
	if($ev_catapultloss < 0)	{	$ev_catapultloss = 0;	 }
	mysql_query("UPDATE military SET catapult = round($ev_catapultloss) WHERE userid='$empvalue'");
}
if($evm[golem] > 0)	{
	$ev_golemloss = (($evm[golem] * $evgolemhp) - $evpts) / $evgolemhp;
	if($ev_golemloss < 0)	{	$ev_golemloss = 0;	 }
	mysql_query("UPDATE military SET golem = round($ev_golemloss) WHERE userid='$empvalue'");
}
if($evm[irongolem] > 0)	{
	$ev_irongolemloss = (($evm[irongolem] * $evirongolemhp) - $evpts) / $evirongolemhp;
	if($ev_irongolemloss < 0)	{	$ev_irongolemloss = 0;	 }
	mysql_query("UPDATE military SET irongolem = round($ev_irongolemloss) WHERE userid='$empvalue'");
}

$war_loss = round($uwarrior - $subwar);
$wiz_loss = round($uwizard - $subwiz);
$pri_loss = round($upriest - $subpri);
$arch_loss = round($uarcher - $subarch);
$golem_loss = round($ugolem - $subgolem);
$irongolem_loss = round($uirongolem - $subirongolem);

if($uwarrior > 0)	{
	if($war_loss > 1)	{	$wtype = warriors;	}
	else	{	$wtype = warrior;	 }
	$war_l = "<font class=yellow>$war_loss</font> $wtype";
}
if($uwizard > 0)	{	
	if($wiz_loss > 1)	{	$witype = wizards;	}
	else	{	$witype = wizard;	 }
	$wiz_l = "<font class=yellow>$wiz_loss</font> $witype";
}
if($upriest > 0)	{	
	if($pri_loss > 1)	{	$ptype = priests;	}
	else	{	$ptype = priest;	}
	$pri_l = "<font class=yellow>$pri_loss</font> $ptype";
}
if($uarcher > 0)	{
	if($arch_loss > 1)	 {	$atype = archers;	}
	else	{	$atype = archer;	}
	$arch_l = "<font class=yellow>$arch_loss</font> $atype";
}
if($ugolem > 0)	{
	if($golem_loss > 1)	 {	$golemtype = golems;	}
	else	{	$golemtype = golem;	}
	$golem_l = "<font class=yellow>$golem_loss</font> $golemtype";
}
if($uirongolem > 0)	{
	if($irongolem_loss > 1)	 {	$irongolemtype = iron golems;	}
	else	{	$irongolemtype = iron golem;	}
	$irongolem_l = "<font class=yellow>$irongolem_loss</font> $irongolemtype";
}

$your_losses = "Your losses: $war_l $wiz_l $pri_l $arch_l $golem_l $irongolem_l";
?>