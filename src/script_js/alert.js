
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
            message= "Votre <a class='aPanier' href='index.php?page=commande&id="+valeurAlert+"'>commande</a> a bien été pris en compte!";
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
        case 'modifArticles':
            message = "Vous bien modifié les articles que vous vendez!";
            type="success";
            break;
        case 'ajoutArticleVendeur':
            message = "Vous avez bien ajouté un article à la vente!";
            type="success";
            break;
        case 'addEnchere':
            message = "Vous avez bien proposé une meilleure offre!";
            type="success";
            break;
        case 'modifVendeurAdmin':
            message = "Vous avez bien modifié les vendeurs!";
            type="success";
            break;
        case 'acceptEnchere':
            message = "Vous avez bien accepté les enchères!";
            type="success";
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
    
