


function affichageDuName(formName,name){
    sortie="default";
  
    if(formName=="adresse"){
        switch(name){
            case 'rue':
                sortie='la rue';
                break;
            case 'ville':
                sortie='la ville';
                break;
            case 'codePostal':
                sortie='le code postal';
                break;
            case 'pays':
                sortie='le pays';
                break;
            case 'nomAdresse':
                sortie='le nom';
                break;
        }
    }
    else if(formName=="payer"){
        switch(name){
            case 'adressePayer':
                sortie='l\'adresse';
                break;
            case 'paiementPayer':
                sortie='le mode de paiement';
                break;
            case 'codeSecuPayer':
                sortie='le code de sécurité';
                break;
        }
    }
    else if(formName=='inscription'){
        switch(name){
            case 'mail':
                sortie='votre mail';
                break;
            case 'pseudo':
                sortie='votre pseudo';
                break;
            case 'prenom':
                sortie='votre prénom';
                break;
            case 'nom':
                sortie='votre nom';
                break;
            case 'mdp':
                sortie='votre mot de passe';
                break;
        }
    }
    else if(formName=='paiement'){
        switch(name){
            case 'numero':
                sortie='le numéro de la carte';
                break;
            case 'nomCarte':
                sortie='le nom indiqué sur la carte';
                break;
            case 'date':
                sortie='la date d\'expiration';
                break;
            case 'codeSecu':
                sortie='le code de sécurité';
                break;
        }
    }
    else if(formName=='ajoutArticle'){
        switch(name){
            case 'nomModif':
                sortie='le nom de l\'article';
                break;
            case 'quantiteModif':
                sortie='la quantité de l\'article';
                break;
            case 'categorieModif':
                sortie='la catégorie de l\'article';
                break;

        }
    }
    else if(formName=='encherir'){
        switch(name){
            case 'prix':
                sortie='le prix';
                break;

        }
    }
  
    return sortie;
}

function validateEmail (emailAdress)
{
  let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (emailAdress.match(regexEmail)) {
    return true; 
  } else {
    return false; 
  }
}

  function validateForm(formName,tableau,idError){
   
      var erreur = 0;
      var message="";
  
     
      for(const elem of tableau){
          
        if(formName=='inscription' && elem=='mail'){ 
            if(!validateEmail(document.getElementById(elem).value)){ 
                erreur++;
                message = "Email invalide!";
                }
        }
        if(formName=='encherir'){ 
            if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                erreur++;
                message = "Le prix doit être un nombre entier!";
               
            }
            else{
                if(parseInt(document.getElementById(elem).value)<0){
                    erreur++;
                    message = "La prix doit être supérieur ou égale à 0!";
                }

            }
        }
        if(formName=='ajoutArticle' && elem=='quantiteModif'){ 
        
            if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                erreur++;
                message = "la quantité doit être un nombre entier!";
               
            }
            else{
                if(parseInt(document.getElementById(elem).value)<0){
                    erreur++;
                    message = "La quantité doit être supérieur ou égale à 0!";
                }

            }
        }
        if(formName=='paiement'){
            if(elem=='numero'){ 
                
                if(document.getElementById(elem).value.length!=16){
                        erreur++;
                        message = "La taille du numéro de la carte doit être 16";
                    }
                if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                    erreur++;
                    message = "Le numéro de carte doit etre un nombre entier";
                    }
                
            }
            else if(elem=='codeSecu'){ 
                
                if(document.getElementById(elem).value.length!=3){
                    erreur++;
                    message = "La taille du numéro de sécurité doit être de 3";
                }
                if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                    erreur++;
                    message = "Le numéro de sécurité doit etre un nombre entier";
                    }
            }
    
        }
        if(formName=='payer'){
            if(elem=='codeSecuPayer'){ 
                
                if(document.getElementById(elem).value.length!=3){
                    erreur++;
                    message = "La taille du numéro de sécurité doit être de 3";
                }
                if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                    erreur++;
                    message = "Le numéro de sécurité doit etre un nombre entier";
                    }
            }
    
        }
      
        
        if(formName=='adresse' && elem=='codePostal'){ 
            if(isNaN(document.getElementById(elem).value)){ //Doit etre un entier
                erreur++;
                message = "Le code postal doit etre un nombre entier";
                }
        }
        
        if(formName=='inscription' && elem=='mdp'){ 
            if((document.getElementById(elem).value).length<8){ //Doit etre un entier
                erreur++;
                message = "La taille de votre mot de passe est trop petit (8 minimum)";
                }
        }
        if(document.getElementById(elem).value==""){
          erreur++;

          message = "Veuillez saisir " + affichageDuName(formName,document.getElementById(elem).name);
          
        }
       
      
       
        
      }
     
    

      

      var error =  document.getElementById(idError);
     
      if(erreur>0){
          error.innerHTML=message;
          error.style.visibility='visible';
          return false;
      }
      else
      {

          error.style.visibility='hidden';
          return true;
      }
  }