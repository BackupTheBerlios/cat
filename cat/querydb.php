<?php
include('language.inc.php');
switch ($mode) {
    case 'normal':
        if ($artist=='' && $title=='' && $album=='' && $addedby=='') {
            $length_ok == 0;
        } else {

            if ($artist == ''){$artist = '%';}
            if ($title == ''){$title = '%';}
            if ($album == ''){$album = '%';}
            if ($addedby == ''){$addedby = '%';}

            $result = mysql_query ("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status
                                    FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
                                    WHERE type = '$type'
                                    AND f.artist LIKE '%$artist%'
                                    AND f.title LIKE '%$title%'
                                    AND a.name LIKE '%$album%'
                                    AND f.addedby LIKE '%$addedby%'
                                    ORDER BY f.type,f.artist,a.name,f.title,f.status
                                   ");
            $length_ok = 1;
        }
    break;

    case 'quick':
        $searchstrlen = strlen($quickquerystring);
        if ($searchstrlen < 3){ $length_ok = 0; } else {
            $sql="SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status
                  FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
                  WHERE f.type = '$type'
                  AND (f.artist LIKE '%$quickquerystring%'
                  OR f.title LIKE '%$quickquerystring%'
                  OR a.name LIKE '%$quickquerystring%')
                  ORDER BY f.type,f.artist,f.title,f.status";
            $result = mysql_query ($sql) or die(mysql_error());
            $length_ok = 1;
         }
    break;

    case 'exact':
        $result = mysql_query ("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status
                                FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
                                WHERE f.type = '$type'
                                AND f.artist = '$artist'
                                AND f.title = '$title'
                                AND a.name = '$album'
                                AND f.addedby = '$addedby'
                                ORDER BY f.type,f.artist,f.title,f.status
                               ");
    $length_ok = 1;
    break;

    case 'browsebyartist':
        $result = mysql_query ("SELECT f.id,f.artist,f.title,a.name AS album,f.addedby,f.status
                                FROM catfiles f LEFT JOIN catalbums a ON f.album=a.id
                                WHERE f.type = '$type'
                                AND f.artist LIKE '$artist%'
                                ORDER BY f.type,f.artist,f.title,f.status
                               ");
    $length_ok = 1;
    break;

    case '':
    print '<br>No search mode has been specified. Please use the <a href="/cat/en/stdsearch.php">forms</a> provided.';
    exit;
    break;
}

?>
