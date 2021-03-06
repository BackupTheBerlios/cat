// filename: browsercheck.js
// Creating the Browsercheck Object for Browser Identification
// Distributed under the terms of the GNU Library General Public License
// version 1.01 - 26 July 2000
// please document *any* changes exactly!
// author: martin.kliehm@3w4u.de

// window.onerror = null
<script language="JavaScript">
<!--
function BrowserCheck() {
        var b = navigator.userAgent.toLowerCase()
        // get browser version
        this.major = parseInt(navigator.appVersion)
        this.minor = parseFloat(navigator.appVersion)

        // check for Netscape detect masked browsers workaround for NN6 returning navigator.appVersion = 5
        this.ns = (this.major >= 4 && ((b.indexOf("mozilla") != -1) && (b.indexOf("spoofer") == -1) && (b.indexOf("compatible") == -1) && (b.indexOf("opera") == -1) && (b.indexOf("webtv") == -1)))
        this.ns4 = (this.ns && (this.major == 4))
        this.ns4up = (this.ns && (this.major >= 4))
        this.ns5 = (this.ns && (this.major == 5))
        this.ns5up = (this.ns && (this.major >= 5))
        this.ns6 = (this.ns && ((this.major == 6) || (b.indexOf("netscape6") != -1)))
        this.ns6up = (this.ns && ((this.major >= 6) || this.ns6))

        // check for Microsoft Internet Explorer detect masked browsers workaround for IE5 returning navigator.appVersion = 4
        this.ie = (this.major >= 4 && ((b.indexOf("msie") != -1) && (b.indexOf("spoofer") == -1) && (b.indexOf("opera") == -1) && (b.indexOf("webtv") == -1)))
        this.ie4 = (b.indexOf("msie 4") != -1)
        this.ie4up = (this.ie && (this.major >= 4))
        this.ie5 = (b.indexOf("msie 5") != -1)
        this.ie5up = (this.ie && (this.major >= 5 || this.ie5))
        this.ie6 = (this.ie && (this.major == 6))
        this.ie6up = (this.ie && (this.major >= 6))

        // detect Opera behind masking
        this.opera = (b.indexOf("opera") != -1)
        this.opera3 = (b.indexOf("opera 3") != -1)
        this.opera3up = ((b.indexOf("opera 3") != -1) || (b.indexOf("opera 4") != -1) || (b.indexOf("opera/4") != -1) || (b.indexOf("opera 5") != -1)) // changed 26 Jul 2000 by martin.kliehm@3w4u.de: added "opera/4" for non-masked Operas
        this.opera4 = ((b.indexOf("opera 4") != -1) || (b.indexOf("opera/4") != -1)) // changed 26 Jul 2000: see above
        this.opera4up = ((b.indexOf("opera 4") != -1) || (b.indexOf("opera/4") != -1) || (b.indexOf("opera 5") != -1)) // changed 26 Jul 2000: see above
        this.opera5 = (b.indexOf("opera 5") != -1)
        // added 26 Jul 2000 by martin.kliehm@3w4u.de: set NS and IE detection to false if masked Opera
        if (this.opera) {
                this.ns = this.ns4 = this.ns4up = this.ns5 = this.ns5up = this.ns6 = this.ns6up = this.ie = this.ie4 = this.ie4up = this.ie5 = this.ie5up = this.ie6 = this.ie6up = false
                }

        // is.min stands for minimum requirements, i.e. browsers 4+ (remove comments around Opera 4 if the browser meets standards)
        this.min = (this.ns || this.ie  || this.opera4up)

        // platform detection without the use of document.platform
        this.win = this.pc = (b.indexOf("win") != -1 || b.indexOf("16bit") != -1)
        this.mac = (b.indexOf("mac") != -1)

        // object detection
        this.all = (document.all) ? true : false
        this.layers = (document.layers) ? true : false
        this.dom = (document.getElementById) ? true : false

        this.java = (navigator.javaEnabled())
        this.print = (window.print) ? true : false

        this.images = (document.images) ? true : false
        this.frames = (window.frames) ? true : false
        this.screen = (window.screen) ? true : false

        // JavaScript version detection (workaround for NS3 returning 1.2 instead of 1.1)
        if (this.opera3) this.js = 1.1
        else if ((this.ns4 && this.minor <= 4.05) || this.ie4) this.js = 1.2
        else if ((this.ns4 && this.minor > 4.05) || this.ie5up || this.opera4) this.js = 1.3
        else if (this.ns5 && !this.ns6up) this.js = 1.4
        else if (this.ns6up) this.js = 1.5
        }

// automatically create the "is" object
is = new BrowserCheck();
if (is.opera4up) {
   document.write("Opera 4+ detected");
}
// -->
</script>
