(function($){
  
  // on entour le champs texte avec une Div qui contiendra notre jauge
  $('input.compteur').wrap('<div class="compteur" />').each(function(){
    
    // initialisation des variables
    var element_input = $(this); // le champs texte

    var element_div = element_input.parent(); // la div
    // on r�cup�re la valeur minimum de la jauge
    var min = element_input.data('min');
    // puis le maximum
    var max = element_input.data('max');
    
    // sa taille
    var taille = element_input.data('taille') ? element_input.data('taille') : 100 ;
    // on r�cup�re la valeur par d�faut de la jauge et la transporme en pourcentage
    var ratio; 
    if(element_input.val()<0){
      ratio=0;
    }else{
      ratio  = (element_input.val()- min ) / (max - min);
      if (ratio > 1){
          ratio = 1;
      }}
      //la couleur de la jauge
      if(ratio > 0.5){
        var color = element_input.data('color') ? element_input.data('color') : "#0cf510" ;
     }else if (0.10<ratio<=0.5){
      var color = element_input.data('color') ? element_input.data('color') :  "#e60909";
     }else{
      var color = element_input.data('color') ? element_input.data('color') : "#f5d20c" ;
     }
    

    // on met en forme la div et le champs texte
    element_div.width(taille*2)
               .height(taille*2);
    element_input.width(taille)
                 .css("font-size",(taille/100*60)+"px")
                 .css("top",(taille/100*60)+"px")
                 .css("left",(taille/100*50)+"px");

    //on dessine la jauge circulaire � l'aide du canevas
    dessin_jauge(element_div , taille , 1 , "#fff" , true , true);
    
    //on dessine le niveau de la jauge circulaire
    var contexte = dessin_jauge(element_div , taille , ratio , color , false , true);

    // cr�ation d'un �v�nement : souris cliqu�e
    /*element_div.mousedown(function(event){

      // on supprimer tout �v�nement qui pourrai parasiter notre animation
      event.preventDefault();

      // cr�ation d'un �v�nement : souris en mouvement
      element_div.bind('mousemove' , function(event){

        // on r�cup�re la position de la souris
        var x = event.pageX - element_div.offset().left - element_div.width() / 2;
        var y = event.pageY - element_div.offset().top - element_div.height() / 2;

        // on calcule l'angle de la jauge de couleur
        var ratio = Math.atan2(x,-y) / (2*Math.PI);
        if(ratio<0){ ratio+=1;}

        //on efface l'ancienne jauge de couleur
        contexte.clearRect(0,0,(taille*2),(taille*2));

        //on redessine la jauge de couleur avec les nouvelles valeurs
        dessin_jauge(element_div , taille , ratio , color , false , contexte);

        // le champs texte obtient la nouvelle valeur arrondie
        element_input.val(Math.round( ratio * ( max - min ) + min ) );

      });

    // cr�ation d'un �v�nement : souris d�-cliqu�e
    }).mouseup(function(event){

      event.preventDefault();
      element_div.unbind('mousemove');

    });*/


  });

})(jQuery);