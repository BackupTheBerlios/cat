<?php
include('language.inc.php');
$pagetitle = sprintf($lang['info']['pagetitle'],ucfirst($what),$artist,$album);
include('page_header.inc.php');

$tracklist = '';

switch (strtolower($what)) {
  case 'album':
	
    include('grabbing.inc.php');
    $data = amazon_getalbuminfo($artist,$album);

    if ($data===FALSE) {
      echo '<p align="center">'.$lang['info']['na'].'</p>
	    <form method="GET" action="http://www.amazon.de/exec/obidos/external-search?tag=catmusicfiles-21">
	      <table align="center" border="0" style="border:2px solid black">
		<tr>
		  <td align="right">
		    <b>Suchen in:</b>
		  </td>
		  <td>
		    <select name="index">
		    <option value="music" selected>Alben
		    <option value="music-tracks">Song-Titel
		    </select>
		  </td>
		  <td align="left">
		    <a href="http://www.amazon.de/exec/obidos/redirect-home?tag=catmusicfiles-21&amp;site=home">
		      <img src="/images/amazon_logo.png" border="0" title="In Partnerschaft mit Amazon.de">
		    </a>
		  </td>
		</tr>
		<tr>
		  <td align="right">
		    <b>Suchbegriff:</b>
		  </td>
		  <td colspan="2">
		    <input type="text" name="keyword" size="30" value="'.$artist.' '.$album.'">
		    <input type="hidden" name="tag" value="catmusicfiles-21">
		    <input type="hidden" name="tag-id" value="catmusicfiles-21">
		  </td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="2" align="left">
		    <input type="submit" name="Los" value="Suchen">
		  </td>
		</tr>
	      </table>
	    </form>
      ';
      break; //leave switch
    } //if

    if ($data['tracklist']!==FALSE) {
      for ($i=1;$i<sizeof($data['tracklist']);$i++) { //loop thru CDs
	$tracklist .= "<p><span style=\"font-size:17px\">CD $i:</span></p><p>";
	for ($j=1;$j<sizeof($data['tracklist'][$i]);$j++) { //loop thru tracks
	  $tracklist .= "[$j] ".ucwords($data['tracklist'][$i][$j]).'<br>';
	}
	echo '</p>';
      }
    } else {
      $tracklist = $lang['info']['tracklistna'];
    }

    echo '<table border="0" align="center">
	    <tr>
	      <td colspan="2" align="center">
		<span style="font-size:15px; font-weight:bold">'.$artist.'</span><br>
		<span style="font-size:22px; font-weight:bold">'.$album.'</span>
	      </td>
	    </tr>

	    <tr>
	      <td>
		<img src="'.$data['image_large'].'">
	      </td>
	    </tr>
	    <tr>
	      <td align="center">
		'.$tracklist.'
	      </td>
	    </tr>
	    <tr>
	      <td align="center">
<!--<a href="'.$data['detailspage_affiliate'].'">
		  <img src="/images/amazon.png" width="120" height="40" title="Dieses Album bei Amazon.de kaufen">-->
		</a>
	      </td>
	    </tr>
	  </table>';
  break;
} //switch

include('page_footer.inc.php');
?>
