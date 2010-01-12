<!-- google map API key : pour uniquement (?): http://www.fermeolivet.net/
ABQIAAAA0Pdh_8EET-n72xP7OCU9VRQMBzOkXylWza1-3on8o8mwezh4PRTp2Xq8TqJZmdjX43w2K_JJ0BFd6w
pour http://gaecolivet.free.fr
ABQIAAAA0Pdh_8EET-n72xP7OCU9VRTFDZFcyfLWBobWIx1qDZjkNxE3HBTPI13wNF6BYVEaxM-0X9xjzs0Acg
-->


<!-- Remplacer la clef aprés key= par la votre//-->
    <script src=" http://maps.google.com/?file=api&amp;v=2.x&amp;key=ABQIAAAAW9GyMK3xmJic7HkkJ6_FKhRgqac2kDoat0qdh_Gp70xojZjKPBS0aYcbexH1s9cAbRM8T_PeZX9xrg" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[   
   
    // Adresse sur laquelle le carte sera centrer et ou sera placer le marqueur
    var cfg_adress         = 'Olivet, 35000 Servon Sur Vilaine';
   
    // Largeur de la carte
    var cfg_largeur     = '500px';
   
    // Hauteur de la carte
    var cfg_hauteur     = '400px';
   
    // Niveau de zoom, entre 1 (niveau globe) et 17 (niveau rue)
    var cfg_zoomLevel    = 13;
   
    // Texte pour le popup
    // Si vous ne souahitez pas de poupup laisser mettre simplement "" comme valeur
    var cfg_description = ""+
    "<table border='0' width='207' cellpadding='3' cellspacing='0'>"+
    "<tr><td valign='top'>"+
    "<div style='color: blue; font-size: 14px; font-weight:bold;'>"+
    "Ferme D'olivet"+
    "</div><br/>"+
    "Gaec à 3 voix, L'Olivet<br/>"+
    "35530 SERVON-SUR-VILAINE<br/>"+
    "02 99 55 28 69<br/>"+
    "<a href='http://fermeolivet.free.fr'>http://fermeolivet.free.fr</a>"+
    "</td>"+
//    "<td>"+
//    "<img src='http://www.business-in-europe.com/fr/visuals/new-voie-express.gif'" + 
//    	"border='0' alt='Photo' vspace='5' align='right' />"+
//    "</td>"+
    "</tr></table>";
   
    // Variable globale pour l'objet GMAP2
    var map;
   
    // Variable global pour l'objet GClientGeocoder qui traduit une adresse en longitude,latitude
    var geocoder;

    // Function appellée au chargement de la page web
    // Créee et configure la carte
    function loadMyMap() {
   
        // Teste si le navigateur est compatible avec l'API Gmaps

      	// Affecte la carte à la div  "map_olivet" (voir tout en bas)
            var divMap    = document.getElementById("map_olivet");
                    
        if (GBrowserIsCompatible()) {
           

           
            // Redimensionne la carte
            divMap.style.width    = cfg_largeur;
            divMap.style.height    = cfg_hauteur;
           
            // Création des objets princiapux
            map         = new GMap2(divMap); 
            geocoder     = new GClientGeocoder();
           
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
            centerMapOnAdress(cfg_adress);
        }else{
        	divMap.innerHTML = "Votre navigateur ne permet pas l\'affichage de carte Google Maps : ";
        }
    }
   
    // Centre une carte sur une adresse
    // Geocode l'adresse
    // Message d'erreur si adresse non trouvé
    function centerMapOnAdress(adresse) {
   
        if (!adresse.length) alert('Remplir la variable adresse');
       
        // Décodage de l'adresse         
        geocoder.getLatLng(
          adresse,
          function(point) {
         
            // Adresse introuvable
            if (!point) {
                alert('Adresse : ' + addresse + " introuvable");
            } else {
           
                // Centre la carte sur l'adresse
                map.setCenter(point, cfg_zoomLevel);
               
                // On créer un marqueur à l'adresse spécifiée
                var marker = new GMarker(point);
               
                var textePopUp = cfg_description;
               
                // Si il y a une description
                if (textePopUp.length) {               
               
                    // Affiche un popup lors du clic sur le marqueur
                    GEvent.addListener(marker, "click", function() {
                        marker.openInfoWindowHtml(textePopUp);
                    });
                    // Affiche le marqueur
                    map.addOverlay(marker);
                   
                    // Par défaut on affiche le popup tout de suite sans attendre un clic
                    // Désactiver en commentant la ligne
                    marker.openInfoWindowHtml(textePopUp);
                }
                    else  map.addOverlay(marker); // Affiche le marqueur
                }
              }
        );
          
    }
   
    // Au chargement de la page on affiche la carte
    window.onload=loadMyMap;
   
    // A la fermeture de la page on libère la mémoire allouée à la carte
    window.onunload=GUnload;
    //]]>
    </script>
    <!-- div dédiée à la carte //-->
    <div id="map_olivet">
    
    </div>



	<a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=olivet+servon+sur+vilaine+france&sll=48.107059,-1.465495&sspn=0.007164,0.00972&ie=UTF8&hq=&hnear=Olivet,+35530+Servon-sur-Vilaine,+Ille-et-Vilaine,+Bretagne,+France&ll=48.107059,-1.465495&spn=0.007164,0.00972&t=h&z=16&iwloc=A">Agrandir le plan</a>	
		
