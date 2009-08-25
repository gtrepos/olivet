

function maj_resume_panier(req){
	$('resume_panier').innerHTML= req.responseText;
}

function maj_mon_panier(req){
	$('mon_panier').innerHTML= req.responseText;
}


function nothing(req){
}


function setNbArticles(idproduit) {
	//alert(idproduit);
	var nbarticles = $F('nbarticles_'+idproduit);
	//alert(nbarticles);
	
	
	new Ajax.Request("tools/visitor_panier_manipulation.php", 
			{ 
		method: 'post', 
		postBody: 'nbarticles='+ nbarticles+'&idproduit='+idproduit+'&ajax_req=setNbArticles',
		onComplete: nothing 
			});
	
	new Ajax.Request("visitor/banniere/resume_panier.php", 
			{ 
		method: 'post', 
		postBody: 'nbarticles='+ nbarticles+'&idproduit='+idproduit+'&ajax_req=setNbArticles',
		onComplete: maj_resume_panier
			});

}

function panierVider() {
	
	new Ajax.Request("tools/visitor_panier_manipulation.php", 
			{ 
		method: 'post', 
		postBody: 'ajax_req=panierVider',
		onComplete: nothing 
			});

	new Ajax.Request("visitor/banniere/resume_panier.php", 
			{ 
		method: 'post', 
		postBody: 'ajax_req=panierVider',
		onComplete: maj_resume_panier 
			});

	new Ajax.Request("visitor/centre/commander/mon_panier.php", 
			{ 
		method: 'post', 
		postBody: 'ajax_req=panierVider',
		onComplete: maj_mon_panier 
			});

}