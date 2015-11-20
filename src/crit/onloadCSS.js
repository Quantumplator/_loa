/*!
onloadCSS: adds onload support for asynchronous stylesheets loaded with loadCSS.
[c]2014 @zachleat, Filament Group, Inc.
Licensed MIT
*/

/* global navigator */
/* exported onloadCSS */
function onloadCSS( ss, callback ) {
  ss.onload = function() {
    ss.onload = null;
    if( callback ) {
      callback.call( ss );
    }
  };

  // This code is for browsers that don’t support onload, any browser that
  // supports onload should use that instead.
  // No support for onload:
  //  * Android 4.3 (Samsung Galaxy S4, Browserstack)
  //  * Android 4.2 Browser (Samsung Galaxy SIII Mini GT-I8200L)
  //  * Android 2.3 (Pantech Burst P9070)

  // Weak inference targets Android < 4.4
  if( "isApplicationInstalled" in navigator && "onloadcssdefined" in ss ) {
    ss.onloadcssdefined( callback );
  }
}
var stylesheet = loadCSS( "wp-content/themes/_loa/style.css" );
onloadCSS( stylesheet, function() {
  var expires = new Date(+new Date + (7 * 24 * 60 * 60 * 1000)).toUTCString();
  document.cookie = 'fullCSS=true; expires=' + expires;
  console.log( "Stylesheet loaded async and cookie has been set" );
});