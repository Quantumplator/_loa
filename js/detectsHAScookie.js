function onloadCSS(e,n){e.onload=function(){e.onload=null,n&&n.call(e)},"isApplicationInstalled"in navigator&&"onloadcssdefined"in e&&e.onloadcssdefined(n)}!function(e){"use strict";var n=function(n,o,t){var l,a=e.document,s=a.createElement("link");if(o)l=o;else{var d=(a.body||a.getElementsByTagName("head")[0]).childNodes;l=d[d.length-1]}var i=a.styleSheets;s.rel="stylesheet",s.href=n,s.media="only x",l.parentNode.insertBefore(s,o?l:l.nextSibling);var r=function(e){for(var n=s.href,o=i.length;o--;)if(i[o].href===n)return e();setTimeout(function(){r(e)})};return s.onloadcssdefined=r,r(function(){s.media=t||"all"}),s};"undefined"!=typeof module?module.exports=n:e.loadCSS=n}("undefined"!=typeof global?global:this),loadCSS("http://loa.dylanjharris.net/wp-content/themes/_loa/style.css");var stylesheet=loadCSS("http://loa.dylanjharris.net/wp-content/themes/_loa/style.css");onloadCSS(stylesheet,function(){console.log("Cookie already set so I just loaded stylesheet asynchronously for you. Happy Birthday.")});