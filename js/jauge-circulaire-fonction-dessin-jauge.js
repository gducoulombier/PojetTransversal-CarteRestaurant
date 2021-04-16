function dessin_jauge(element_div , taille , ratio , color , ombre , contexte){

  if(contexte===true){
  
    var circle = $('<canvas width="'+(taille*2)+'px" height="'+(taille*2)+'px" />');
    element_div.append(circle);
    // on configure notre plan de travail : 2 dimentions
    var ctx = circle[0].getContext('2d');

  }else{

    ctx = contexte;

  }

  // début du dessin
  ctx.beginPath();
  // on dessine un cercle
  ctx.arc(taille,taille,(taille/100*85), -1/2*Math.PI , ratio*2*Math.PI-1/2*Math.PI);
  // taille du bord
  ctx.lineWidth = (taille/100*20);
  //couleur du bord
  ctx.strokeStyle = color;

  if(ombre){

    //position de l'ombre
    ctx.shadowOffsetX = (taille/100*1.5);
    // taille de l'ombre
    ctx.shadowBlur = (taille/100*8);
    //couleur de l'ombre
    ctx.shadowColor='rgba(0,0,0,0.5)';

  }

  //fin du dessin
  ctx.stroke();

  return ctx;

}