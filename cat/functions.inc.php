<?php

//setcookie() replacement
function cat_setcookie ($CkyName, $CkyVal, $exp, $pth, $Domain, $Secure) {
         static $mycky;
         $exp = strftime("%A, %d-%b-%Y %H:%M:%S", $exp);
         $cookiestr = sprintf ("%s=%s; domain=%s; path=%s; expires=%s",
         $CkyName, $CkyValue, $Domain, $pth, $exp);
         $mycky = ( ($mycky) ? "$mycky\n" : "") . "Set-Cookie: $cookiestr";
         header($mycky);
}

//convert type from number to string
function cat_settype ($type) {
echo "CAT_SETTYPE(): Warning, this function is deprecated!<br>\n";
         switch ($type) {
         case '1':
             $retval='LYR';
         break;
         case '2':
             $retval='CRD';
         break;
         case '3':
             $retval='TAB';
         break;
         case '4':
             $retval='BTAB';
         break;
         }
         return $retval;
} //*** end_function ***

?>
