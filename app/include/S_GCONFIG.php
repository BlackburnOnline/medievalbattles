		<form type=get action="guildconfig.php">
	<table border=0 width="60%" align=center>
	 <tr>
	   <td class=main colspan=2><b class=reg>Change Guild Settings</b></td>
	 <tr>
	   <td class=main2 colspan=2>Here, you can change the entry password and info for your guild.</td>
	 <tr>
	   <td class=main2><b class=reg>Old Entry Passwod</b></td><td class=inner><center><input type="text" name="oepw" size=15></center></td>
	 <tr>
	   <td class=main2><b class=reg>New Entry Password</b></td><td class=inner><center><input type="text" name="nepw" size=15></center></td>
	 <tr>
	   <td class=main2><b class=reg>Guild Info</b></td><td class=inner><center><textarea name=info rows=6 cols=20 wrap><? echo"$ginfo"; ?></textarea></center></td>
	 </table>
	 <br>
	<center><input class=button type=submit name=change value=Change></center>
	<input type="hidden" name="change" value="1">
	</form>