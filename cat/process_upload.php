<?php

// upload hack
$message = '';
$url_uploads = "./incoming";
$max_upload_size = "10000000"; // in bytes
$allow_uploads = 1; // allow uploads, easy on/off

	$image_link = 0; // default to non-image link
	$source = $HTTP_POST_FILES['file1']['tmp_name'];
	$source_mime = $HTTP_POST_FILES['file1']['type'];
	$origname = $HTTP_POST_FILES['file1']['name'];
	$upload_size = $HTTP_POST_FILES['file1']['size'];
	
	// don't allow anyone to be stupid
	$filearray = explode(".",$origname);
	$fileext = $filearray[count($filearray) - 1];
	$badext = "CGI PHP PL ASP";
	if($fileext != "") {	
		if(strstr($badext,strtoupper($fileext)))
			$origname .= ".txt";	
	}
	$dest = '';
	$upload_type = split("/",$source_mime);
	if( ($source != 'none') && ($source != '')) {
		if( $upload_type[0] == "image" ) {
			$image_link = 1;
		}
		$dest = $url_uploads . "/" . $origname;

		if($upload_size > $max_upload_size) {
			unlink($source);
			$message .= "<BR><SMALL>Uploaded file larger than $max_upload_size limit.  Sorry.</SMALL><BR>";
		} else {
			if(move_uploaded_file($source,$dest)) {
				if(!chmod($dest,0777)) {
					echo '<BR>File mode could not be modified.<BR>';
				}
			} else {	// file move success
				echo '<BR>File could not be stored.<BR>';
			}

			// now put link into original message
				$message .= "<BR><BR>Uploaded file: <A HREF=\"".$dest."\">$origname</A>";
		} // end if on large file
	} // else no file selected or too large of a file
echo $message;
?>

