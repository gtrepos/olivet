jQuery.noConflict();

jQuery(document).ready( function () {
	
    // On cache les sous-menus
    // sauf celui qui porte la classe "open_at_load" :
    jQuery("ul.subMenu:not('.open_at_load')").hide();
    // On selectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'element span qu'ils contiennent par un lien :
    jQuery("li.toggleSubMenu span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = jQuery(this).text();
        jQuery(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>') ;
    } ) ;

    // On modifie l'evenement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    jQuery("li.toggleSubMenu > a").click( function () {
        // Si le sous-menu etait deja ouvert, on le referme :
        if (jQuery(this).next("ul.subMenu:visible").length != 0) {
            jQuery(this).next("ul.subMenu").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
        }
        // Si le sous-menu est cache, on ferme les autres et on l'affiche :
        else {
            jQuery("ul.subMenu").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
            jQuery(this).next("ul.subMenu").slideDown("normal", function () { jQuery(this).parent().addClass("open") } );
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });
    
} ) ;