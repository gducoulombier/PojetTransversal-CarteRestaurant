$(document).ready(function(){
    //Lorsque la souris entre dans le div...
    $("a").mouseenter(function(){
        //...On ajoute une couleur de fond au div
        $(this).css("background-color", "#EEFFFE");
    });

    //Lorsque la souris ressort du div...
    $("a").mouseleave(function(){
        //...On remet un fond blanc
        $(this).css("background-color", "#fff");
    });

   
});