<?php include('language.inc.php'); $pagetitle = 'Statistics'; include('page_header.inc.php');

function cat_tabletitle($title) {
	print '<br><div align="center"><hr size="1"><font size="3" face="Verdana"><b><i>';
	print $title;
	print '</i></b></font><br>';
}

//read configuration and include functions
require('../functions.inc'.$scriptext);

$result=mysql_query("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status,f.date,f.type
		     FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
		     ORDER BY f.id DESC
		     LIMIT 0,20
		     ");

cat_tabletitle('Latest files:');
echo '<table width="100%" border="0" cellspacing='.$cellspc.' cellpadding='.$cellpad.'>';
echo '<tr>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Submitter</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Type</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Date</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Artist</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Album</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Title</b></i></font></td>';
echo '</tr>';

while ($row=mysql_fetch_array($result)) {

    //format date
    $filedate=substr($row['date'],0,4).'-'
		.substr($row['date'],4,2).'-'
		.substr($row['date'],6,2)
		.'/'.substr($row['date'],8,2).':'
		.substr($row['date'],10,2);

    $type2 = cat_settype($row['type']);

    if (!isset($colorflag)||$colorflag == 0) {
	$rowcolor = $rowcolorlight;
	$colorflag = 1;
    } else {
	$rowcolor = $rowcolordark;
	$colorflag = 0;
    }

    print '<tr>';
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row['addedby']);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $type2);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $filedate);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row["artist"]);
    print '<td bgcolor='.$rowcolor.'>';
    printf('<a class="lowpriority" href="info.php?what=album&amp;artist=%s&amp;album=%s" title="'.$lang['stats']['viewalbum'].'">%s</a><br></td>', urlencode($row['artist']), urlencode($row['album']), $row['album']);
    print '<td bgcolor='.$rowcolor.'>';
    printf('<a href="%s/%s/%s" title="'.$lang['stats']['viewfile'].'">%s</a><br></td>', '../files', $row['type'], $row["id"], $row["title"]);
    print '</tr>';
}
echo "</table></div>";

//Views Top 10
$result=mysql_query("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status,f.views,f.type
		     FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
		     ORDER BY f.views DESC
		     LIMIT 10
		     ");

cat_tabletitle('Top 10 Accessed Files:');
echo '<table width="100%" border="0" cellspacing='.$cellspc.' cellpadding='.$cellpad.'>';
echo '<tr>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Submitter</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Type</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Views</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Artist</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Album</b></i></font></td>';
echo '<td bgcolor='.$headercolor.'><font size="4"><i><b>Title</b></i></font></td>';
echo '</tr>';

while ($row=mysql_fetch_array($result)) {

    $type2 = cat_settype($row['type']);

    if ($colorflag == 0) {
	$rowcolor = $rowcolorlight;
	$colorflag = 1;
    } else {
	$rowcolor = $rowcolordark;
	$colorflag = 0;
    }

    print '<tr>';
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row['addedby']);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $type2);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row['views']);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row["artist"]);
    print '<td bgcolor='.$rowcolor.'>';
    printf('%s<br></td>', $row["album"]);
    print '<td bgcolor='.$rowcolor.'>';
    printf('<a href="%s/%s/%s">%s</a><br></td>', '../files', $row['type'], $row["id"], $row["title"]);
    print '</tr>';
}
echo "</table></div>";

//Top 10 Submitters
$result=mysql_query("SELECT name,reg_date,num_submitted FROM catusers
			ORDER BY num_submitted DESC
			LIMIT 0,9
		     ");
cat_tabletitle('Top 10 Submitters:');
echo '<table width="80%" border="0" cellspacing='.$cellspc.' cellpadding='.$cellpad.'>';
echo '<tr>';
echo '<td align="center" bgcolor='.$headercolor.'><font size="4"><i><b>Rank</b></i></font></td>';
echo '<td width="25%" bgcolor='.$headercolor.'><font size="4"><i><b>Name</b></i></font></td>';
echo '<td width="25%" bgcolor='.$headercolor.'><font size="4"><i><b>Registered since</b></i></font></td>';
echo '<td width="25%" bgcolor='.$headercolor.'><font size="4"><i><b>Files added</b></i></font></td>';
echo '</tr>';

$number = $colorflag = 0;

while ($row=mysql_fetch_array($result)) {
    if ($colorflag == 0) {
	$rowcolor = $rowcolorlight;
	$colorflag = 1;
    } else {
	$rowcolor = $rowcolordark;
	$colorflag = 0;
    }

    if ($row['num_submitted'] != '0') {
	$number = $number + 1;
	print '<tr>';
	print '<td align="center" bgcolor='.$rowcolor.'>';
	printf('%s<br></td>', $number);
	print '<td bgcolor='.$rowcolor.'>';
	printf('%s<br></td>', $row['name']);
	print '<td bgcolor='.$rowcolor.'>';
	printf('%s<br></td>', $row['reg_date']);
	print '<td bgcolor='.$rowcolor.'>';
	printf('%s<br></td>', $row['num_submitted']);
	print '</tr>';
    }
}
echo "</table></div>";

print '<br><hr size="1"><br><div align="center"><b>';
//Files added today:<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles");
	$row = mysql_fetch_array($result);
	print '<i>Total number of files in the library: </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE status='0'");
	$row = mysql_fetch_array($result);
	print '<i>Files not yet reviewed (red dot): </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE status='1'");
    if ($result) {
	$row = mysql_fetch_array($result);
	print '<i>Files that are approved (green dot): </i>'.$row['count'].'<br>';
    }

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE type='1'");
	$row = mysql_fetch_array($result);
	print '<i>Total number of lyrics: </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE type='2'");
	$row = mysql_fetch_array($result);
	print '<i>Total number of chords: </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE type='3'");
	$row = mysql_fetch_array($result);
	print '<i>Total number of tabs: </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) AS count FROM catfiles WHERE type='4'");
	$row = mysql_fetch_array($result);
	print '<i>Total number of bass tabs: </i>'.$row['count'].'<br>';

    $result = mysql_query("SELECT count(*) FROM catvisitors");
    $visitors['total'] = mysql_result($result,0);
    $result = mysql_query("SELECT count(*) FROM catvisitors WHERE MONTH(date)=MONTH(NOW())");
    $visitors['month'] = mysql_result($result,0);
    $result = mysql_query("SELECT count(*) FROM catvisitors WHERE
			  (DAYOFYEAR(date)=DAYOFYEAR(NOW())
			    OR DAYOFYEAR(date)=DAYOFYEAR(NOW()))
			  AND DAYOFYEAR(date)=DAYOFYEAR(NOW())");
    $visitors['day'] = mysql_result($result,0);
    print "<i>Number of visitors: </i>".$visitors['day']." today / ".$visitors['month']." this month / ".$visitors['total']." total";

print '</b></div>';

?>
