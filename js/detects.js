function onloadCSS(e,n){e.onload=function(){e.onload=null,n&&n.call(e)},"isApplicationInstalled"in navigator&&"onloadcssdefined"in e&&e.onloadcssdefined(n)}var stylesheet=loadCSS("wp-content/themes/_loa/style.css");onloadCSS(stylesheet,function(){console.log("Stylesheet has asynchronously loaded.")}),function(e){"use strict";var n=function(n,o,t){var l,s=e.document,a=s.createElement("link");if(o)l=o;else{var d=(s.body||s.getElementsByTagName("head")[0]).childNodes;l=d[d.length-1]}var i=s.styleSheets;a.rel="stylesheet",a.href=n,a.media="only x",l.parentNode.insertBefore(a,o?l:l.nextSibling);var r=function(e){for(var n=a.href,o=i.length;o--;)if(i[o].href===n)return e();setTimeout(function(){r(e)})};return a.onloadcssdefined=r,r(function(){a.media=t||"all"}),a};"undefined"!=typeof module?module.exports=n:e.loadCSS=n}("undefined"!=typeof global?global:this),loadCSS("wp-content/themes/_loa/style.css");