// next we need to do the links to other results
if ($offset==1) { // bypass PREV link if offset is 0
    $prevoffset=$offset-20;
    print "<a href=\"$PHP_SELF?offset=$prevoffset\">PREV</a> &nbsp; \n";
}

// calculate number of pages needing links
$pages=intval($numrows/$limit);
// $pages now contains int of pages needed unless there is a remainder from division
if ($numrows%$limit) {
    // has remainder so add one page
    $pages++;
}

for ($i=1;$i<=$pages;$i++) { // loop thru
    $newoffset=$limit*($i-1);
    print "<a href=\"$PHP_SELF?offset=$newoffset\">$i</a> &nbsp; \n";
}

// check to see if last page
if (!(($offset/$limit)==$pages) && $pages!=1) {
    // not last page so give NEXT link
    $newoffset=$offset+$limit;
    print "<a href=\"$PHP_SELF?offset=$newoffset\">NEXT</a><p>\n";
}