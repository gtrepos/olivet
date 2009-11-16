function loadGoogleMap() {

	if (GBrowserIsCompatible()) {		
		
		//point on OLIVET : cf. :http://www.backups.nl/geocoding/
		var point = new GLatLng(48.1068185, -1.4654957);
		
		var map = new GMap2(document.getElementById("googleMap"));
		// Pour zoomer avec la molette de la souris
		// Pour le désactiver ajouter // devant la ligne suivante ou bien la supprimer :)
		map.enableScrollWheelZoom();

		// Grande barre de zoom
		map.addControl(new GLargeMapControl());

		// Ou bien : Deux boutons zoom + 4 directions
		//map.addControl(new GSmallMapControl());

		// Ou bien : Juste deux boutons pour zoomer et dézoomer
		//map.addControl(new GSmallZoomControl());

		//Pour switcher entre les différentes vues (sattelite, plan, hybride)
		map.addControl(new GMapTypeControl());        
		// On centre la carte sur votre adresse
		map.setCenter(point, 13);
		// On créer un marqueur à l'adresse spécifiée
		var marker = new GMarker(point); 
		// Affiche le marqueur
		map.addOverlay(marker);
		
	}else{
		//alert("loadGoogleMap : not GBrowserIsCompatible()");
	}
}