function afficherOuPas(idAfficherOuPas){
   
    var produits = document.getElementById(idAfficherOuPas);

    
    if(produits.style.display!="none")
        produits.style.display="none";   
    else
        produits.style.display="block";
        

}
