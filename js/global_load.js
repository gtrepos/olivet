
//generic function to include javascript files
function IncludeJavaScript(jsFile)
{
  document.write('<script type="text/javascript" src="'+ jsFile + '"></scr' + 'ipt>'); 
}

//google maps

/*var googleMapKey = 'ABQIAAAA0Pdh_8EET-n72xP7OCU9VRQMBzOkXylWza1-3on8o8mwezh4PRTp2Xq8TqJZmdjX43w2K_JJ0BFd6w';
IncludeJavaScript('http://maps.google.com/maps?file=api&amp;v=2&amp;key='+googleMapKey);
IncludeJavaScript('js/googleMapInit.js');*/
IncludeJavaScript('js/chooseNumberOfArticles.js');
IncludeJavaScript('js/prototype.js');
IncludeJavaScript('js/panier.js');
