<script language="JavaScript" type="text/js">

function setPointer(theRow, thePointerColor)
{
    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }

    var rowCellsCnt  = theCells.length;
    for (var c = 0; c < rowCellsCnt; c++) {
        theCells[c].style.backgroundColor = thePointerColor;
    }

    return true;
} // end of the 'setPointer()' function

</script>

<?php
include('language.inc.php');
require('../config.inc.php');

    switch ($type) {
    case '1':
        $type2='LYR';
        $resultid = $results_lyrics;
    break;
    case '2':
        $type2='CRD';
        $resultid = $results_chords;
    break;
    case '3':
        $type2='TAB';
        $resultid = $results_tabs;
    break;
    case '4':
        $type2='BTAB';
        $resultid = $results_btabs;
    break;
    }

  while ($myrow = mysql_fetch_array($resultid)) {

    echo '
		<tr bgcolor="#223388"
			onmouseover="setPointer(this,\'#1122CC\')"
			onmouseout="setPointer(this,\'#224488\')">
		';
    echo '<td><img src="/images/dot_'.($myrow['status']==1 ? 'green' : 'red').'.gif"><br></td>';
    printf('<td><span style="font-weight:bold">%s</span><br></td>', $myrow['artist']);
    printf('<td>%s<br></td>', $myrow['album']);
    printf('<td><span style="font-weight:bold"><a href="%s/%s/%s">%s</a></span><br></td>', '../files', $type, $myrow['id'], $myrow['title']);
    echo '</tr>';
  }
?>
