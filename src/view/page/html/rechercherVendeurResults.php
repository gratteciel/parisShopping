<div id="vendeurResultsAffichage" style="margin:3%;">
    <table class="table table-bordered" style="color:white;">
        <thead>
        <tr>
            <th scope="col">E-mail</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col" style="width:100px">Supprimer as Vendeur</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($_SESSION['rechercherVendeurResults'] as $vendeur): ?>
            <tr>
                <?php
                echo "<td>" . $vendeur['mail'] . "</td>";
                echo "<td>" . $vendeur['nom'] . "</td>";
                echo "<td>" . $vendeur['prenom'] . "</td>";
                echo "<td style='width:100px'>";
                ?>

                <button onclick="location.href='script_php/supprVendeurFlag.php?idUtilisateur=<?php echo $vendeur['idUtilisateur']; ?>'" type="button"
                        class="btn btn-danger">Supprimer
                </button>

                <?php echo "</td>" ?>
            </tr>
            </ul>
        <?php endforeach; ?>


        </tbody>
    </table>
</div>

