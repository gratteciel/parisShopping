
function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
    return decodeURIComponent(name[1]);
    }

//On check si on a une alert:

var valeurAlert=null;
var typeAlert=null;  
var message=null;
var type=null;

if(get('alerts'))
{
    
    typeAlert = get('tA');
    valeurAlert = get('valA');
    switch(typeAlert){
        case 'connect':
            message= "Vous vous êtes connecté au compte : " + valeurAlert;
            type="success";
            break;
        case 'deconnect':
            message= "Vous vous êtes déconnecté du compte : " + valeurAlert;
            type="warning";
            break;
        case 'supprA':
            message= "Vous avez bien supprimé <b>" + valeurAlert + "</b> de votre panier";
            type="danger";
            break;
        case 'addA':
            message= "Vous avez bien ajouté <b>" + valeurAlert + "</b> à votre <a class='aPanier' href='index.php?page=panier/panier'>panier</a>";
            type="success";
            break;

        case 'addAdresse':
            message= "Vous avez bien ajouté <b>une adresse</b>!";
            type="success";
            break;
        case 'addPaiement':
            message= "Vous avez bien ajouté <b>un moyen de paiement</b>!";
            type="success";
            break;
        case 'supprAdresse':
            message= "Vous avez bien supprimé <b>une adresse</b>!";
            type="danger";
            break;
        case 'supprPaiement':
            message= "Vous avez bien supprimé <b>un moyen de paiement</b>!";
            type="danger";
            break;
        case 'payer':
            message= "Votre <a class='aPanier' href='index.php?page=commande&id="+valeurAlert+">commande</a> a bien été pris en compte!";
            type="success";
            break;
        case 'addAlerte':
            message = "Vous avez ajouté "+ valeurAlert +" à vos alertes" ;
            type="success";
            break;
        case 'suppAlerte':
            message = "Vous avez retiré " + valeurAlert +" de vos alertes";
            type="success";
            break;
        case 'addVendeur':
            message= "Vous avez bien ajouté <b>un vendeur</b>!";
            type="success";
            break;
        case 'problemeVendeur':
            message = "Erreur dans l'ajout d'un <b>vendeur</b>, le <b>vendeur</b> est déja présent dans la base de données ";
            type="danger";
            break;
        case 'pasVendeur':
            message = "Le profil que vous venez de mettre n'est pas un <b>vendeur</b> ";
            type = "danger";
            break;
        case 'rechercheVendeurSuccess':
            message = " Voici la liste des <b>vendeurs</b> ";
            type ="success";
            break;
        case 'problemeRechercheVendeur':
            message = "Erreur dans la recherche d'un <b>vendeur</b>, le <b>vendeur</b> n'est déja présent dans la base de données ";
            type="danger";
            break;
        case 'supprVendeur' :
            message = "Vous avez supprimer un vendeur avec succes" ;
            type = "success";
            break;

    }
    

        
}




var alertPlaceholder = document.getElementById('afficheAlert')


function alert(message, type) {
    var wrapper = document.createElement('div')
    alertPlaceholder.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message + '<button id="boutonClose" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
}

if (message) {
    alert(message, type) 
    var croix = document.getElementById('boutonClose')
    croix.addEventListener('click', function () {
        alertPlaceholder.innerHTML = "";
    })
}
    
