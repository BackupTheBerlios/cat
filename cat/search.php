<?php
include('language.inc.php');
switch ($_GET['mode']) {
  case 	 'quick': $pagetitle = sprintf($lang['search']['pagetitle']['quick'],$quickquerystring); break;
  case 	'normal': $pagetitle = 	 $lang['search']['pagetitle']['ext_normal']; break;
  case          'exact': $pagetitle =         $lang['search']['pagetitle']['ext_exact']; break;
  case 'browsebyartist': $pagetitle = sprintf($lang['search']['pagetitle']['artistbrowse'],$artist); break;
}
include('page_header.inc.php');
?>

<?php
//convert any number of whitespaces to one single whitespace
//and remove whitespaces at beginning and end
if ($_GET['mode']=='normal'||$_GET['mode']=='exact') {
 $artist  = $_GET['artist'];
 $title   = $_GET['title'];
 $album   = $_GET['album'];
 $addedby = $_GET['addedby'];
 $content = $_GET['content'];
 
 $artist  = ereg_replace (' +', ' ', $artist); $artist = trim($artist);
 $title   = ereg_replace (' +', ' ', $title); $title = trim($title);
 $album   = ereg_replace (' +', ' ', $album); $album = trim($album);
 $addedby = ereg_replace (' +', ' ', $addedby); $addedby = trim($addedby);
 $content = ereg_replace (' +', ' ', $content); $content = trim($content);

 if (!get_magic_quotes_gpc())
    {
    $artist = ereg_replace("(')", "\'", $artist);
    $title = ereg_replace("(')", "\'", $title);
    $album = ereg_replace("(')", "\'", $album);
    $addedby = ereg_replace("(')", "\'", $addedby);
    $content = ereg_replace("(')", "\'", $content);
    $quickquerystring = ereg_replace("(')", "\'", $quickquerystring);
    }

}

if ($_GET['mode']=='quick') {
   $quickquerystring = $_GET['quickquerystring'];
   $quickquerystring = ereg_replace (' +', ' ', $quickquerystring);
   $quickquerystring = trim($quickquerystring);
   if (!get_magic_quotes_gpc()) $quickquerystring = ereg_replace("(')", "\'", $quickquerystring);
   }


if (FALSE) {
} else {

    if ($s_lyrics=='' && $s_tabs=='' && $s_chords=='' && $s_btabs=='') {
	print 'You must specify at least one filetype to search for.';
	exit;
    }

    if ($s_lyrics) {
	$type='1';
	include('querydb'.$scriptext.'');
	$results_lyrics=$result;
	if ($result) { $num_lyrics=mysql_num_rows($result); }
    }

    if ($s_chords) {
	$type='2';
	include('querydb'.$scriptext.'');
	$results_chords=$result;
	if ($result) { $num_chords=mysql_num_rows($result); }
    }

    if ($s_tabs) {
	$type='3';
	include('querydb'.$scriptext.'');
	$results_tabs=$result;
	if ($result) { $num_tabs=mysql_num_rows($result); }
    }

    if ($s_btabs) {
	$type='4';
	include('querydb'.$scriptext.'');
	$results_btabs=$result;
	if ($result) { $num_btabs=mysql_num_rows($result); }
    }

	if ($length_ok) {
	    $num_total = ($num_lyrics + $num_tabs + $num_chords + $num_btabs);
	    if (!$num_total) {
		echo '<br>'.$lang['search']['noresults'];

		echo '<ul><li><a href="stdsearch.php">'.$lang['search']['option_tryagain'].'</a></li>';
		echo '<li><a href="mailto:sky@nachtwind.net">'.$lang['search']['option_request'].'</a></li></ul><br>';

		if ($s_tabs || $s_btabs || $s_chords) {
		printf('<a href="%s?externalresults=1&amp;artist=%s&amp;title=%s&amp;s_tabs=%s&amp;s_chords=%s&amp;s_btabs=%s">Start an external search.</a>',$PHP_SELF,$artist,$title,$s_tabs,$s_chords,$s_btabs);
		exit;
		}
	    }
	    
	    if ($mode=='browsebyartist') {
		echo '<div align="center">';
		for ($i=65;$i<=90;$i++) {

		if ($i % 2 == 0) {
		    $charcolor = '#AADDaa';
		} else {
		    $charcolor = '#AADDaa';
		}
		      echo '<a href="../search/artist='.chr($i).'&title=&album=&addedby=&s_lyrics='.$s_lyrics.'&s_tabs='.$s_tabs.'&s_chords='.$s_chords.'&s_btabs='.$s_btabs.'&mode=browsebyartist"><b><font color="'.$charcolor.'" face="Verdana" size="4">'.chr($i).'</font></b></a>&nbsp;&nbsp;';
		}
		echo '</div><br>';
	    }
	    
	    print '<br><div align="center"><font size=4 face="Verdana">Lyrics: '.$num_lyrics.' | Chords: '.$num_chords.' | Tabs: '.$num_tabs.' | Bass Tabs: '.$num_btabs.'</font><br>';

	    print '<hr size=1>
		  <img src="../images/dot_red.gif" width="20" height="16" align="absmiddle">
		  <i><font face="Times New Roman, Times, serif">'.$lang['not_approved'].'</font></i>
		  <img src="../images/dot_green.gif" width="20" height="16" align="absmiddle">
		  <i>'.$lang['approved'].'</i><br>
		  <hr size="1"></div>';

		$colorflag = 0;

		print '<table align="center" width="100%" cellpadding='.$cellpad.' cellspacing='.$cellspc.'>';
		if ($s_lyrics && $num_lyrics) {
		echo '<tr>';
		echo '<td bgcolor="#003366"><font size="4"><i><b></b></i>Lyrics</font></td>';
		echo '<td bgcolor="#003366" width="24%"><font size="4"><i><b>Artist</b></i></font></td>';
		echo '<td bgcolor="#003366" width="33%"><font size="4"><i><b>Album</b></i></font></td>';
		echo '<td bgcolor="#003366" width="33%"><font size="4"><i><b>Title</b></i></font></td>';
		echo '</tr>';
		$type='1';
		include('displayresults.php');
		}

		if ($s_chords && $num_chords) {
		echo '<tr>';
		echo '<td><font size="4"><i><b></b></i>&nbsp;</font></td>';
		echo '<td width="24%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td bgcolor="#003366"><font size="4"><i><b></b></i>Chords</font></td>';
		echo "<td bgcolor=\"#003366\" width=\"24%\"><font size=\"4\"><i><b>".$lang['artist']."</b></i></font></td>";
		echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['album']."</b></i></font></td>";
		echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['title']."</b></i></font></td>";
		echo '</tr>';
		$type='2';
		include('displayresults.php');
		}

		if ($s_tabs && $num_tabs) {
		    echo '<tr>';
		    echo '<td><font size="4"><i><b></b></i>&nbsp;</font></td>';
		    echo '<td width="24%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '</tr>';
		    echo '<tr>';
		    echo '<td bgcolor="#003366"><font size="4"><i><b></b></i>Tabs</font></td>';
		    echo "<td bgcolor=\"#003366\" width=\"24%\"><font size=\"4\"><i><b>".$lang['artist']."</b></i></font></td>";
		    echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['album']."</b></i></font></td>";
		    echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['title']."</b></i></font></td>";
		    echo '</tr>';
		    $type='3';
		    include('displayresults'.$scriptext.'');
		}

		if ($s_btabs && $num_btabs) {
		    echo '<tr>';
		    echo '<td><font size="4"><i><b></b></i>&nbsp;</font></td>';
		    echo '<td width="24%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '<td width="33%"><font size="4"><i><b>&nbsp;</b></i></font></td>';
		    echo '</tr>';
		    echo '<tr>';
		    echo '<td bgcolor="#003366"><font size="4"><i><b></b></i>BTabs</font></td>';
		    echo "<td bgcolor=\"#003366\" width=\"24%\"><font size=\"4\"><i><b>".$lang['artist']."</b></i></font></td>";
		    echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['album']."</b></i></font></td>";
		    echo "<td bgcolor=\"#003366\" width=\"33%\"><font size=\"4\"><i><b>".$lang['title']."</b></i></font></td>";
		    echo '</tr>';
		    $type='4';
		    include('displayresults.php');
		}

		echo '</table><br><br>';

    } else {
	if ($mode=='quick')  echo $lang['search']['error']['quick'];
	if ($mode=='normal') echo $lang['search']['error']['normal'];
	if ($mode=='exact')  echo $lang['search']['error']['exact'];
    }

  }


?>
<? include('page_footer.inc.php'); ?>
