<? include ("include/top.php"); ?>
		
		    <center><b>Game News</b></center>
			<hr class=main>
			<!-- BODY STARTS -->
	<br><br>
	<table border=1 bordercolor="#000000" align=center width="25%">
	<tr>
	  <td class=inner2><a href="strongemp.php">Strongest Empires</a></td>
	 <tr>
	  <td class=inner2><a href="mostland.php">Most Land</a></td>
	 <tr>
	  <td class=inner2><a href="mostmts.php">Most Mountains</a></td>
	 <tr>
	  <td class=inner2><a href="strongset.php">Strongest Settlements</a></td>
	 <tr>
	  <td class=inner2><a href="strongguild.php">Strongest Guilds</a></td>
	 </table>
<?php

	include("include/connect.php");
	$tablename = "user";

echo "
			<br><br>
	
		

	
	<table border=0 bordercolor=#404040 width=80% align=center cellspacing=1>
	  <tr>
	    <td colspan=5 class=main><b class=reg>Strongest Settlements</b></td>
	  <tr>
		<td class=main2></td>
		<td class=main2 width=50%><b class=reg>Name</b></td>
		<td class=main2><b class=reg width=15%>Guild</b></td>
		<td class=main2><b class=reg width=15%>Settlement</b></td>
		<td class=main2><b class=reg width=20%>Experience</b></td>
";


			$query_string = "SELECT setname, setguild, setid, setstrength FROM settlement ORDER BY setstrength DESC LIMIT 0,10";
		$result_id = mysql_query($query_string, $var);
		while ($row = mysql_fetch_row($result_id))
		    {

		
	

					 $placeno = $placeno + 1;

		    	print("<TR ALIGN=center VALIGN=TOP colspan=7>
				<td bgcolor=#404040>$placeno</td>
				<td bgcolor=#404040 align=left>$row[0]</td>
				<td bgcolor=#404040>$row[1]</td>
				<td bgcolor=#404040>$row[2]</td>
				<td bgcolor=#404040>$row[3]</td>
												");
				
		    }

		echo "</table>"; 

?>

			<!-- BODY ENDS -->
			<hr class=main>

<? include ("include/bottom.php"); ?>		
	