

  
  <!-- Modal -->
  <div style="color:black" class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"  id="exampleModal2Label">Ajouter un moyen de paiement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="script_php/ajouterPaiement.php?page=<?php echo $page?>" method="post" onsubmit = "return validateForm('paiement',['numero','date','nomCarte','codeSecu'],'errordiv2')">
              <div id='form-mod'>
                <label for="typeCarte" style="margin-left:10px;margin-bottom: 0px;">Type de carte</label>
                <select class="form-select form-mod" aria-label="Default select example" id="typeCarte" name="typeCarte">
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="American Express">American Express</option>
                  </select>
                  <input type="text" 
                        class="form-control form-mod" 
                    id='numero'
                    placeholder="Numéro de la carte (16 chiffres)"
                    name="numero"
                    >
                    <input type="text" 
                            class="form-control form-mod" 
                        id='nomCarte'
                        placeholder="Nom sur la carte"
                        name="nomCarte"
                        >
                        <label for="date" style="margin-left:10px;">Date d'expiration</label>
                  <div style="display:flex;flex-direction:row">
                        
                      <input type="date" 
                              class="form-control form-mod" 
                              placeholder="date"
                              
                              name="date"
                              id="date"
                              >

                        <input type="text" 
                            class="form-control form-mod" 
                            placeholder="Code de sécurité"
                            style="width:46%"
                            name="codeSecu"
                            id="codeSecu"
                            >
  
                      
                  </div>
                  
                 
                  
  
              </div>
              <div id="errordiv2" style="color:red;margin-left: 6px;"></div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" name="submitPaiement" id="submitPaiement"  class="btn btn-primary">Ajouter</button>
        </div>
        </form>
      </div>
    </div>
  </div>



  