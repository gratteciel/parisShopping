<!-- Modal -->

<div style="color:black" class="modal fade" id="rechercherVendeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rechercher un vendeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_php/rechercherVendeur.php?page=<?php echo $page ?>" method="post" onsubmit="return validateRechercherForm('errorRechercheDiv')">
                    <div id='form-mod'>

                        <div style="display:flex;flex-direction:row">
                            <input type="text"
                                   class="form-control form-mod"
                                   placeholder="Email"
                                   style="width:80%"
                                   id='rechercheMail'
                                   name="rechercheMail"
                            >
                        </div>
                        <div style="display:flex;flex-direction:row">
                            <input type="text"
                                   class="form-control form-mod"
                                   placeholder="Nom"
                                   style="width:80%"
                                   id='rechercheNom'
                                   name="rechercheNom"
                            >
                        </div>
                        <div style="display:flex;flex-direction:row">
                            <input type="text"
                                   class="form-control form-mod"
                                   placeholder="Prenom"
                                   style="width:80%"
                                   id='recherchePrenom'
                                   name="recherchePrenom"
                            >
                        </div>
                        <div id="errorRechercheDiv" style="color:red;margin-left: 6px;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" name="submitRechercheVendeur" id="submitRechercheVendeur" class="btn btn-primary">Rechercher un vendeur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
