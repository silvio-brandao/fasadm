function GetBrowserInfo() {
			var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
		   
			var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
			var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
		   
			var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
			var isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6
			if (isOpera) {
				return "Opera";
			}
			else if (isFirefox) {
				return "Firefox";
			}
			else if (isChrome) {
				return "Chrome";
			}
			else if (isSafari) {
				return "Safari";
			}
			else if (isIE) {
				return "Internet Explorer";
			}
			else {
				return 0;
			} 
		}