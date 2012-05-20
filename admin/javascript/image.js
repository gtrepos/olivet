function montreImage(id, name){
	survolLigne("image_"+id);
	overlib("<img src='../img/upload/"+name+"'/>");
}

function cacheImage(id){
	restaureLigne("image_"+id);
	nd();
}