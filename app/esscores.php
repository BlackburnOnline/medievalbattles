<?php

include("include/igtop.php");

echo "
<div align=center><b class=reg>[ <a href='esscores.php'>Strongest Empires</a> ]</b></div>
<div align=center><b class=reg>[ <a href='emland.php'>Most Land</a> ]</b></div>
<div align=center><b class=reg>[ <a href='emmountains.php'>Most Mountains</a> ]</b></div>
<div align=center><b class=reg>[ <a href='setstrength.php'>Strongest Settlements</a> ]</b></div>
<div align=center><b class=reg>[ <a href='sguild.php'>Strongest Guilds</a> ]</b></div>
<div align=center><b class=reg>[ <a href='stats.php'>Statistics</a> ]</b></div>
<br><br>
<table border='0' bordercolor='#404040' width='80%' align='center' cellspacing='1'>
	<tr>
		<td colspan='5' class='main'><b class='reg'>Strongest Empires</b></td>
	<tr>
		<td class='main2'></td>
		<td class='main2' width='50%'><b class='reg'>Empire</b></td>
		<td class='main2'><b class='reg' width='15%'>Mountains</b></td>
		<td class='main2'><b class='reg' width='15%'>Land</b></td>
		<td class='main2'><b class='reg' width='20%'>Experience</b></td>";

	$query_string = "SELECT ename, mts, land, exp, userid FROM user ORDER BY exp DESC LIMIT 0,40";
	$result_id = mysql_query($query_string, $var);
	while ($row = mysql_fetch_row($result_id))	{

		$SETID_SELECT = mysql_db_query($dbnam, "SELECT setid FROM user WHERE ename='$row[0]'");	
	   		$SID_S = mysql_result($SETID_SELECT,"SID_S");
		$EMPS_SET_GUILD = mysql_db_query($dbnam, "SELECT guild FROM user WHERE userid='$row[4]'");	
	   		$E_S_G = mysql_result($EMPS_SET_GUILD,"E_S_G");
		
		$E_S_G = "[$E_S_G]";
		if($E_S_G == "[None]")	{	$E_S_G = "";	}	

		$placeno = $placeno + 1;
		$row[3] = number_format($row[3]);
		$row[2] = number_format($row[2]);
		$row[1] = number_format($row[1]);

echo "
	<tr align='center' valign='top' colspan='7'>
		<td bgcolor='#404040'>$placeno</td>
		<td bgcolor='#404040' align='left'><font class='red'><b>$row[0] ($SID_S)</b> </font><i>$E_S_G</i></td>
		<td bgcolor='#404040'>$row[1]</td>
		<td bgcolor='#404040'>$row[2]</td>
		<td bgcolor='#404040'>$row[3]</td>";
}
echo "
</table> 
</body>
</html>";
?>