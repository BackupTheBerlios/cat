<?php
/*echo '<div style="font-size:12px">';
show_source('grabbing.inc.php');
echo '</div>'; exit;*/

/************************************************************************************
   Rechtliches: Lizenzbedingungen und Haftungsauschluss
		- Mit der Benutzung dieses Scripts werden
		  die folgenden Bedingungen anerkannt:

   ---------
   I. PostIt
   ---------
    ************************************************************************
    *
    * PostIt - Pretend to be a form.
    *
    * Copyright (c) 1999 Holotech Enterprises. All rights reserved.
    * You may freely modify and use this function for your own purposes. You
    * may freely distribute it, without modification and with this notice
    * and entire header intact.
    *
    * This function takes an associative array and a URL. The array is URL-
    * encoded and then POSTed to the URL. If the request succeeds, the
    * response, if any, is returned in a scalar array. Outputting this is the
    * caller's responsibility; bear in mind that it will include the HTTP
    * headers. If the request fails, an associative array is returned with the
    * elements 'errno' and 'errstr' corresponding to the error number and
    * error message. If you have any questions or comments, please direct
    * them to postit@holotech.net
    *
    *					       Alan Little
    *					       Holotech Enterprises
    *					       http://www.holotech.net/
    *					       December 1999
    *
    ************************************************************************

    --------------------------------------------------------------------
    II. Amazon.de (http://www.amazon.de/exec/obidos/tg/browse/-/505050/)
    --------------------------------------------------------------------
    Jedes Website-Design, jeder Text, alle Grafiken, jede Auswahl bzw.
		jedes Layout davon und jede Software Copyright © 1998-2001 Amazon.com,
		Inc. ALLE RECHTE VORBEHALTEN. Das Kopieren oder die Reproduktion (inklusive des
		Ausdrucks auf Papier) der gesamten Website bzw. von Teilen dieser Website werden nur zu dem Zweck gestattet, eine Bestellung bei Amazon.com, Inc.,
		aufzugeben oder zu dem Zweck, diese Website als Einkaufsressource zu verwenden.

    Jede andere Verwendung der auf dieser Website verfügbaren
	  Materialien bzw. Informationen -- inklusive der Reproduktion, des
	  Weitervertriebs, der Veränderung und der Veröffentlichung zu einem
	  anderen als dem oben genannten Zweck -- ist untersagt, es sei denn, Amazon.com,
	  Inc., hat dem vorher schriftlich zugestimmt.

    -----------------------------------
    III. Über diese Funktionsbibliothek
    -----------------------------------
    1. Weitergabe
    Die Funktion amazon_getalbuminfo() ist Copyright (C)2002 Sky Professional Webdesign & Scripting
    und darf im privaten Bereich kostenfrei eingesetzt werden. Eine kommerzielle Nutzung
    (was die Verwendung dieser Funktion auf Seiten mit Werbung einschließt) ist nur mit
    schriftlicher Genehmigung von Sky Professional Webdesign & Scripting erlaubt.

    2. Modifikationen und Additionen
    Für Modifikationen und Additionen dieses Script gelten die unter Punkt III.1 angegebenen
    Bedingungen für die Nutzung, mit folgenden Zusätzen:

	a) Dieser Abschnitt (Punkt I-IV) muss zwingend bestehen bleiben und darf nicht verändert werden.
	b) Jegliche Änderungen müssen dokumentiert und anderen Benutzern unter diesen Lizenzbedingungen
	   zugänglich gemacht werden.

    3. Haftungsausschluss
    Die Verantwortung für jegliche Schäden (inkl. Folgeschäden und Schädigung Dritter) und
    Rechtsverletzungen geht beim Einsatz dieses Scripts automatisch auf die Person über,
    die es zur Verfügung stellt und/oder einsetzt.
    Beim Einsatz dieses Scriptes sind die unter II angegebenen Lizenzbedingungen von amazon.de
    zu beachten. In Zweifelsfällen gilt als letzte Instanz immer die unter II angegebene Webseite.

    -- sky@nachtwind.net

    --------------------------------
    IV. Informationen zur Benutzung:
    --------------------------------
    Diese Funktion erwartet als ersten Parameter den Künstlernamen, als zweiten den NAmen des Albums.
    Ist ein Parameter nicht verfügbar, so muss ein Leerstring angegeben werden.
    Der Rückgabewert ist ein Array mit folgender Struktur:

    [asin] => Die ASIN von Amazon, welche das Produkt eindeutig bezeichnet
    [detailspage_affiliate] => Ein Link zur Produktseite mit der Affiliate-ID
    [detailspage] => Ein Link zur Produktseite ohne Affiliate-ID
    [image_small] => CD-Cover URL (klein, 48x50)
    [image_medium] => CD-Cover URL (mittel, 125x130)
    [image_large] => CD-Cover URL (groß, 289x300)
    [tracklist] => Array mit CD-Nummern
		   (
		   [1] => Array mit Tracks für CD 1
			  (
			  [1] => Track 1
			  [n] => Track n
			  )
		   [n] => Array mit Tracks für CD n
			  (
			  [1] => Track 1
			  [n] => Track n
			  )
		   )
    [label] =>	Das Label, unter dem die CD veröffentlich wurde
    [release_date] => Das Veröffentlichungsdatum als UNIX-Timestamp
    [num_cds] => Die Anzahl der CDs

    Ist ein Wert nicht verfügbar, so enthält das betreffende Feld FALSE;
    Konnte kein eindeutiger Hit gefunden werden, ist der ganze Rückgabewert FALSE
    - Das Script oder Programm, das die Ausgabe entgegenennimmt, muss selbst
    für ein Handling dieser Fälle sorgen.
************************************************************************************/

function PostIt($DataStream, $URL)
{
  $URL = ereg_replace("^http://", "", $URL);

  $Host = substr($URL, 0, strpos($URL, "/"));
  $URI = strstr($URL, "/");

  $ReqBody = "";
  while (list($key, $val) = each($DataStream)) {
    if ($ReqBody) $ReqBody.= "&";
    $ReqBody.= $key."=".urlencode($val);
  }
  $ContentLength = strlen($ReqBody);

  $ReqHeader =
    "POST $URI HTTP/1.1\n".
    "Host: $Host\n".
    "User-Agent: Opera 5.12/en\n".
    "Content-Type: application/x-www-form-urlencoded\n".
    "Content-Length: $ContentLength\n\n".
    "$ReqBody\n";

  $socket = fsockopen($Host, 80, &$errno, &$errstr);
  $idx = 0;
  fputs($socket, $ReqHeader);
  while (!feof($socket)) {
    $Result[$idx++] = fgets($socket, 128);
  }
  return $Result;
}

function amazon_getalbuminfo($artist,$album)
{
  $monthnames = array('Januar','Februar','M&auml;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
  $monthnumbers = array(1,2,3,4,5,6,7,8,9,10,11,12);

  $affiliateid = "catmusicfiles-21";
  $searchhandler = "http://www.amazon.de/exec/obidos/search-handle-form/028-3745996-6199736";

  $d["field-artist"] = $artist;
  $d["field-title"]  = $album;
  $d["index"]	     = "music";
  $d["size"]	     = "5"; //number of hits to display per page
  $d["url"]	     = "field-binding=";

  $result = PostIt($d, $searchhandler);

  for ($i=0;$i<sizeof($result);$i++) {
    $line = $result[$i];

    if (strstr($line,'Wir haben keine genauen Treffer')!==FALSE) { //correct result can't be guaranteed, return
      return(FALSE); exit;
    }

    if (strstr($line,'Location: ')!==FALSE) { //we got a direct hit with redirect
      $data['detailspage'] = str_replace('Location: http://www.amazon.de','',$line);
      break;
    }

    if (strstr($line,'ASIN')!==FALSE) break; //ASIN found
  }

  //to-do: get all matches, sort them by release-date criteria,
  //	   data availability (tracks,pic) and stock status

  $data['asin'] = preg_replace("!^(.*?)/ASIN/(.*?)/(.*?)$!i","$2",$line);
  $data['detailspage_affiliate'] = "http://www.amazon.de/exec/obidos/ASIN/".$data['asin']."/$affiliateid/";

  if (!isset($data['detailspage'])) { //if not already set by the direct hit handler (see above)
    if (!preg_match("!<a href=(\"?)(.*?)(\"?)>!i",$line,$matches)) { //extract from first HREF, stop on error
      $data['error'] = "Das Album \"$album\" von \"$artist\" konnte leider nicht gefunden werden.";
      return($data);
    } else {
      $data['detailspage'] = $matches['2'];
    }
  }

  $line = '';

  //get the details page and store it in (string)$line
  $f = fsockopen("www.amazon.de",80,$errno,$errstr,5);
  fputs($f, "GET ".$data['detailspage']." HTTP/1.0\r\nHost: www.amazon.de\r\n\r\n");
  while (!feof($f)) {
    $line .= fgets($f,128);
  }
  fclose ($f);

  $data['detailspage'] = 'http://www.amazon.de'.$data['detailspage'];

  $imagesubid = preg_replace("!^(.*)images/P/(.*?)\.(.*?)\.MZZZZZZZ(.*)$!si","$3",$line);
  $imagext = preg_replace("!^(.*)images/P/(.*?)\.MZZZZZZZ\.(jpg|jpeg|png|gif)(.*)$!si","$3",$line);

  $data['image_small'] = "http://images-eu.amazon.com/images/P/".$data['asin'].'.'.$imagesubid.'.THUMBZZZ'.'.'.$imagext;
  $data['image_medium'] = "http://images-eu.amazon.com/images/P/".$data['asin'].'.'.$imagesubid.'.MZZZZZZZ'.'.'.$imagext;
  $data['image_large']  = "http://images-eu.amazon.com/images/P/".$data['asin'].'.'.$imagesubid.'.LZZZZZZZ'.'.'.$imagext;

  if (($data['tracklist'] = preg_replace("!^(.*?)Schreiben Sie eine Online-Rezension(.{0,100})<hr noshade size=1>(.*?)</font>(.*?)<b>(.*?)<p>(.*?)<hr noshade size=1>(.*?)$!si","$6",$line))==$line) { //get track list table
    $data['tracklist'] = FALSE;
  } else {
    //$data['tracklist'] = preg_replace("!<a(.*?)>(.*?)</a>!si","$2",$data['tracklist']); //strip out link tags
    //$data['tracklist'] = preg_replace("!<img(.*?)>!si","",$data['tracklist']); //strip out image tags
    $data['tracklist'] = strip_tags(str_replace('<br>',"\n",$data['tracklist']));
    $data['tracklist'] = preg_replace("!(\012{2,})!s","",$data['tracklist']);
    $data['tracklist'] = preg_replace("!CD: ([0-9]{1})!si","|||",$data['tracklist']);
    if (!preg_match("!^\|\|\|!si",$data['tracklist'])) $data['tracklist'] = '|||'.$data['tracklist'];
    $data['tracklist'] = explode('|||',$data['tracklist']);
    for ($i=1;$i<sizeof($data['tracklist']);$i++) {
      $data['tracklist'][$i] = explode('|||',preg_replace("!([0-9]{1,2})\.([^ ])!si","|||$2",$data['tracklist'][$i]));
    }  }

  if (($data['label'] = preg_replace("!^(.*?)<b>Label:</b>(.*?)<br>(.*?)$!si","$2",$line))==$line) $data['label'] = FALSE; //get label
  if (($data['release_date'] = preg_replace("!^(.*?)<b>Erscheinungsdatum:</b>(&#160;|&nbsp;)(.*?)<br>(.*?)$!si","$3",$line))==$line) $data['release_date'] = FALSE; //get release date
  if (($data['num_cds'] = preg_replace("!^(.*?)\(CD-Anzahl: ([0-9]{1})\)(.*?)$!si","$2",$line))==$line) $data['num_cds'] = FALSE; //get number of CDs

  if ($data['release_date']!==FALSE) {
    $tempdate = explode(' ',str_replace('.','',$data['release_date']));
    for ($i=0;$i<12;$i++) $tempdate[1] = str_replace($monthnames[$i],$monthnumbers[$i],$tempdate[1]);
    $data['release_date'] = mktime(0,0,0,$tempdate[1],$tempdate[0],$tempdate[2]);
  }

  if (strstr($line,'cd_hoch_130x130.gif')) //the 'cd-cover not found'-image
    $data['image_small'] = $data['image_medium'] = $data['image_large'] = FALSE;

  return($data);
}

function saveremoteimage($url,$localpath,$filename)
{
  $url = preg_replace("!^http://!i", "", $url);
  $host = substr($url, 0, strpos($url, "/"));
  $uri = strstr($url, "/");
  $filename .= '.'.preg_replace("!^(.*?)\.([a-zA-Z]{3,4})$!","$2",$url);

  //read from remote
  $f = fsockopen($host,80,$errno,$errstr,5);
  fputs($f, "GET $uri HTTP/1.0\r\nHost: $host\r\n\r\n");
  $img = fread($f,128768);
  fclose ($f);

  //strip header junk
  $img = preg_replace("!^(.*?)(\r\n\r\n)!s","",$img);

  //save to local
  $f = fopen($localpath.'/'.$filename,'w');
  fwrite($f,$img);
  fclose($f);
  return(TRUE);
}

?>
