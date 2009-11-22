jQuery.noConflict();

jQuery(document).ready( function () {
	
	/*************************
	* menu_deroulant1, partenaires
	**************************/
    // On cache les sous-menus
    // sauf celui qui porte la classe "open_at_load" :
    jQuery("ul.subMenu1:not('.open_at_load')").hide();
    // On selectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'element span qu'ils contiennent par un lien :
    jQuery("li.toggleSubMenu1 span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = jQuery(this).text();
        jQuery(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>') ;
    } ) ;

    // On modifie l'evenement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    jQuery("li.toggleSubMenu1 > a").click( function () {
        // Si le sous-menu etait deja ouvert, on le referme :
        if (jQuery(this).next("ul.subMenu1:visible").length != 0) {
            jQuery(this).next("ul.subMenu1").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
        }
        // Si le sous-menu est cache, on ferme les autres et on l'affiche :
        else {
            jQuery("ul.subMenu1").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
            jQuery(this).next("ul.subMenu1").slideDown("normal", function () { jQuery(this).parent().addClass("open") } );
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });

    /***********************
     * menu_deroulant2, produits dispo
	**************************/
    // On cache les sous-menus
    // sauf celui qui porte la classe "open_at_load" :
    jQuery("ul.subMenu2:not('.open_at_load')").hide();
    // On selectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'element span qu'ils contiennent par un lien :
    jQuery("li.toggleSubMenu2 span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = jQuery(this).text();
        jQuery(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>') ;
    } ) ;

    // On modifie l'evenement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    jQuery("li.toggleSubMenu2 > a").click( function () {
        // Si le sous-menu etait deja ouvert, on le referme :
        if (jQuery(this).next("ul.subMenu2:visible").length != 0) {
            jQuery(this).next("ul.subMenu2").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
        }
        // Si le sous-menu est cache, on ferme les autres et on l'affiche :
        else {
            jQuery("ul.subMenu2").slideUp("normal", function () { jQuery(this).parent().removeClass("open") } );
            jQuery(this).next("ul.subMenu2").slideDown("normal", function () { jQuery(this).parent().addClass("open") } );
        }
        // On empêche le navigateur de suivre le lien :
        return false;
    });

    
} ) ;