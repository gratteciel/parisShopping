<!-- Modal -->
<div style="color:black" class="modal fade" id="rechercherVendeur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un vendeur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_php/rechercher.php?page=<?php echo $page ?>" method="post" onsubmit="return validateForm('ajoutVendeur', ['mail','mdp','nom','prenom'], 'errordiv')">
                    <div id='form-mod'>
                        <div style="display:flex;flex-direction:row">
                            <input type="email"
                                   class="form-control form-mod"
                                   placeholder="mail"
                                   style="width:80%"
                                   id='mail'
                                   name="mail">
                        </div>
                        <div style="display:flex;flex-direction:row">
                            <input type="password"
                                   class="form-control form-mod"
                                   placeholder="mdp"
                                   style="width:80%"
                                   id='mdp'
                                   name="mdp">
                        </div>
                        <div style="display:flex;flex-direction:row">
                            <input type="text"
                                   class="form-control form-mod"
                                   placeholder="Nom"
                                   style="width:80%"
                                   id='nom'
                                   name="nom"
                            >
                        </div>
                        <div style="display:flex;flex-direction:row">
                            <input type="text"
                                   class="form-control form-mod"
                                   placeholder="Prenom"
                                   style="width:80%"
                                   id='prenom'
                                   name="prenom"
                            >
                        </div>
                        <div>
                            <input type="tel"
                                   class="form-control form-mod"
                                   placeholder="telephone"
                                   style="width:80%"
                                   id='telephone'
                                   name="telephone"
                            >
                        </div>
                        <div id="errordiv" style="color:red;margin-left: 6px;"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" name="submitVendeur" id="submitVendeur" class="btn btn-primary">Ajouter Vendeur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
