<?
if($signup)	{

	$opw = $pw;		
	$cpw = md5($cpw);
	$pw = md5($pw);
		
	include("include/connect.php");

	$numberplayers = mysql_db_query($dbnam, "SELECT count(userid) FROM user");
	$noplayers = mysql_result($numberplayers,"noplayers");

	// is email already in database?
		$emresult = mysql_db_query($dbnam, "SELECT email FROM user WHERE email='$email'");
		$emnamecheck = mysql_fetch_array($emresult);

	// what about the empire ename?
		$eresult = mysql_db_query($dbnam, "SELECT ename FROM user WHERE ename='$ename'");
		$enamecheck = mysql_fetch_array($eresult);

		$ename1 = strtolower($ename);
		$enamecheck1 = strtolower($enamecheck[0]);

		$email1 = strtolower($email);
		$emnamecheck1 = strtolower($emnamecheck[0]);

	if($enamecheck1 == $ename1 AND $ename != "")	{
		echo "$ename is already being used!";
		die();
	}
	elseif($emnamecheck1 == $email1 AND $email != "")	{
		echo"$email is already being used!";
		die();
	}
		
	if($class == ns)	{
		echo "You gotta have a class to play the game!";
		die();
	}
	
	if($race == ns)	{
		echo "You gotta have a race to play the game!";
		die();
	}
	
	if($ename == "")	{
		echo "You gotta have an empire name to play the game!";
		die();
	}

	if($noplayers >= 600)	{
		echo "Game is full! Try again later!";
		die();
	}	
	elseif (($email == "") and ($cemail == ""))	{
		echo "You gotta have an email to play!";
		die();
	}
	elseif ($email != $cemail)	{
		echo "Emails don't match!";
		die();
	}	
	elseif (($pw == "") and ($cpw == ""))	{
		echo "You gotta have a password to play!";
		die();
	}
	elseif ($pw != $cpw)	 {
		echo "Passwords don't match!";
		die();
	}
	elseif($class != Cleric AND $class != Fighter AND $class != Mage AND $class != Ranger AND $class != Goblin)	{
		echo "That class doesn't exist!";
		die();
	}
	
	//	select minimum amount of members
	$Sett_least = mysql_db_query($dbnam, "SELECT min(members) FROM settlement");
	$least_set = mysql_result($Sett_least,"least_set");

	//	select a random settlement
	$maxset0 = mysql_db_query($dbnam, "SELECT max(setid) AS maxset FROM settlement");
	$maxset = mysql_result($maxset0,"maxset");
	$sel_mem = rand(1,$maxset);

	//	extract members from settlement
	$Random_mem = mysql_db_query($dbnam, "SELECT members FROM settlement WHERE setid='$sel_mem'");
	$R_Mem = mysql_result($Random_mem,"R_Mem");

	if($least_set != $R_Mem)	{
		 $Sett_least = mysql_db_query($dbnam, "SELECT min(members) FROM settlement");
		 $least_set = mysql_result($Sett_least,"least_set");
		
		 $Sel_members = mysql_db_query($dbnam, "SELECT setid FROM settlement WHERE members ='$least_set'");
		 $sel_mem = mysql_result($Sel_members,"sel_mem");
	}

	if($least_set == $R_Mem)	{
		$least_set = $R_Mem;
	}

	$new_mem = $least_set + 1;
	mysql_query("UPDATE settlement SET members ='$new_mem' WHERE setid='$sel_mem'");
	
	$snum = $sel_mem;

	// create the account
	$buildingsuserid = mysql_db_query($dbnam, "SELECT max(userid) FROM user");
	$buserid = mysql_result($buildingsuserid,"buserid");
	$newbuserid = $buserid + 1;

	if (($email === $cemail) and ($pw === $cpw) and ($email != "") and ($cemail != "") and ($pw != "") and ($cpw != ""))	{
 		$part1 = rand(250, 350);
		$part2 = rand(000, 999);

		$gp = "$part1" . "$part2";
		$iron = rand(4000, 6000);
		$civ = rand(1000, 1250);
		$recruits = rand(150, 250);
		$puppies = rand(10, 20);
		$war = rand(1,5);
		$wiz = rand(1,5);
		$pri = rand(1,5);
		$maxciv = rand(100,250);

			if($class == "Cleric")	{
				$part1 = rand(350, 450);
				$part2 = rand(000, 999);

				$gp = "$part1" . "$part2";
				$iron = rand(6000, 7500);
				$civ = rand(1200, 1400);
				$recruits = rand(200, 300);
				$puppies = rand(15, 30);
				$war = rand(4,10);
				$wiz = rand(4,10);
				$pri = rand(4,10);
				$maxciv = rand(250,350);
			}
			
			if($class == "Ranger")	{
				$arch = rand(4, 10);
			}
			if($race == 'Giant')	 {
				$wiz = 0;
				$pri = 0;
			}
			if($class == 'Ranger')	{
				$r13pts = 125000;
				$wiz = 0;
			}
			else	{
				$r13pts = 0;
			}
		//exp values  
		$archexp = 26;
		$warexp = 23;
		$wizexp = 20;
		$priexp = 22;
		$landexp = 8;
		$mtexp = 5;

			if($class == "Cleric")	{
				$archexp = 30;
				$warexp =  26;
				$wizexp =  23;
				$priexp =  24;
				$landexp = 10;
				$mtexp =  7;
			}
		
		$exp = ($war * $warexp) + ($pri * $priexp) + ($wiz * $wizexp) + ($arch * $archexp) + ($maxciv * 10) + (250 * 8) + (200 * 5);
		mysql_query ("INSERT INTO user (email,  pw, ename, msn, aim, gp, iron, exp, food, land, mts, setid, class, userid, race, safemode) 
                VALUES ('$email', '$pw', '$ename', '$msn', '$aim', '$gp', '$iron', '$exp', '1500', '250', '200', '$snum', '$class', '$newbuserid', '$race', '48')
             ");
		
		mysql_query("INSERT INTO buildings (email, pw, home, barrack, farm, wp, gm, im, aland, amts, userid) 
			VALUES	('$email', '$pw', '50', '50', '50', '0', '50', '50', '100', '100', '$newbuserid') ");
		
		mysql_query("INSERT INTO military (email, pw, civ, recruits, warriors, wizards, priests, maxciv, userid, warpower, warspeedw, cweapon, wizpower, wizspeeds, cspell, pripower, prispeedw, cstaff, cbow, archspeedw, archpower, wararmor, wizarmor, priarmor, wardef, wizdef, pridef, warspeeda, wizspeeda, prispeeda, archers, puppies) 
			VALUES	('$email', '$pw', '$civ', '$recruits', '$war', '$wiz', '$pri', '$maxciv', '$newbuserid', '3', '6','Dagger', '4', '7', 'Magic Missile', '2', '6', 'Quarterstaff', 'None', '0', '0', 'Studded Leather', 'Robe', 'Leather', '1', '1', '2', '0', '0', '1', '$arch', '$puppies') ");
		
		mysql_query("INSERT INTO research (email, pw, userid, r13pts) 
			VALUES	('$email', '$pw', '$newbuserid', '$r13pts') ");
		
		mysql_query("INSERT INTO explore (email, pw, userid) 
			VALUES	('$email', '$pw', '$newbuserid') ");
	
	$selectempire = mysql_db_query($dbnam, "SELECT setid FROM user WHERE email = '$email' AND pw = '$pw'");	
	$semp = mysql_result($selectempire,"semp");
		
		include("include/clock.php");

		mysql_query("INSERT INTO setnews (date, news, setid) 
			VALUES	('$clock', '<font class=red>$ename has joined the settlement</font>', '$snum') ");
		mysql_query("INSERT INTO return (email, pw, userid) 
			VALUES	('$email', '$pw', '$newbuserid') ");

	echo "Thank you for signing up for Medieval Battles.  You are in settlement $snum.  <br>
			Your login information has been emailed to you.<br><br><a href=index.php>You can login now here</a>";	

	$subject = "Welcome to Medieval Battles";
	$body = "
	Thank you for being apart of the new online game, Medieval Battles.
	Your empire name is $ename
	Your email is $email
	Your password is $opw
	You will need your email and password to login to your account.

	If you have any questions you can email us at support@medievalbattles.com";

	$from = "From: support@medievalbattles.com\r\nbcc: phb@sendhost\r\nContent-type: text/plain\r\nX-mailer: PHP/" . phpversion();
	$mailsend = mail("$email","$subject","$body","$from");

	die();
	}
}
else	{
	echo "If you want to make an account, <a href=index.php?signup=yes>click here</a>";
}
?>