<?php include('language.inc.php'); $pagetitle = 'Search Form'; include('page_header.inc.php'); ?>
	      <br>
	      <div align="center">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="85%">
		      <div align="center">
			<font face="Verdana, Arial, Helvetica, sans-serif">
			<b><?php echo $lang['stdsearch']['shortinfo']; ?></b></font>
		      </div>
		    </td>
		  </tr>
		</table>
		<hr size="1">
		<form name="form1" method="get" action="search.php">
		  <table width="90%" border="0" cellspacing="5" cellpadding="0" align="center">
		    <tr>
		      <td width="22%" height="30">
			<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="4"><?php echo $lang['artist']; ?></font></b></font></div>
		      </td>
		      <td width="78%" valign="middle" height="30"><font size="4" face="Verdana, Arial, Helvetica, sans-serif">
			<input type="text" name="artist" size="60" maxlength="30">
			</font></td>
		    </tr>
		    <tr>
		      <td width="22%">
			<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="4"><?php echo $lang['title']; ?></font></b></font></div>
		      </td>
		      <td width="78%" valign="middle"><font size="4" face="Verdana, Arial, Helvetica, sans-serif">
			<input type="text" name="title" size="60">
			</font></td>
		    </tr>
		    <tr>
		      <td width="22%">
			<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="4"><?php echo $lang['album']; ?></font></b></font></div>
		      </td>
		      <td width="78%" valign="middle"><font size="4" face="Verdana, Arial, Helvetica, sans-serif">
			<input type="text" name="album" size="60" maxlength="30">
			</font></td>
		    </tr>
		    <tr>
		      <td width="22%">
			<div align="right">
			  <font face="Verdana, Arial, Helvetica, sans-serif" size="4">
			  <b><?php echo $lang['added_by']; ?></b></font>
			</div>
		      </td>
		      <td width="78%" valign="middle"><font size="4" face="Verdana, Arial, Helvetica, sans-serif">
			<input type="text" name="addedby" size="40" maxlength="20">
			</font></td>
		    </tr>
		    <tr>
		      <td width="22%">&nbsp;</td>
		      <td width="78%" valign="middle">&nbsp;</td>
		    </tr>
		    <tr>
		      <td width="22%">
			<div align="right"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="4"><?php echo $lang['stdsearch']['searchfor']; ?></font></b></font></div>
		      </td>
		      <td width="78%" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif">
			<input type="checkbox" name="s_lyrics" value="yes" checked>
			Lyrics
			<input type="checkbox" name="s_tabs" value="yes" checked>
			Tabs
			<input type="checkbox" name="s_chords" value="yes" checked>
			Chords
			<input type="checkbox" name="s_btabs" value="yes" checked>
			Bass Tabs</font></td>
		    </tr>
		    <tr>
		      <td width="22%" height="25">
			<div align="right"><font size="4"><b><font face="Verdana, Arial, Helvetica, sans-serif"><?php echo $lang['stdsearch']['mode']; ?></font></b></font></div>
		      </td>
		      <td width="78%" valign="middle" height="25">
			<input type="radio" name="mode" value="normal" checked>
			<font face="Verdana, Arial, Helvetica, sans-serif"><?php echo $lang['stdsearch']['mode_normal']; ?>
			<input type="radio" name="mode" value="exact">
			<?php echo $lang['stdsearch']['mode_exact']; ?></font></td>
		    </tr>
		    <tr>
		      <td width="22%">&nbsp; </td>
		      <td width="78%" valign="middle">
			<input type="submit" name="Submit" value="<?php echo $lang['stdsearch']['buttontext']; ?>">
			<input type="reset" name="Submit2" value="Reset">
		      </td>
		    </tr>
		  </table>
		  <br>
		</form>
	      </div>
<? include('page_footer.inc.php'); ?>
