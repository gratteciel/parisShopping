<?php

/**
 *
 */
class Admin
{
    /**
     * @param object $pdo   databse connection object
     * @param array  $input array with new vendeur values
     *
     * @return bool true if operation succeed. If it does not succeed, we will throw an exception error message
     * @throws Exception
     */
    public static function ajoutVendeur($pdo, $input)
    {
        $mandatoryFields = [
            'mail',
            'nom',
            'prenom',
            'mdp',
        ];

        // (1) validate fields: verify that mandatory fields exists
        foreach ($mandatoryFields as $fieldName) {
            if (empty($input[$fieldName])) {
                throw new \Exception(sprintf("Invalid field name: %s", $fieldName));
            }
        }

        // (2) check if vendeur exists deja
        /** @var $pdo PDO */
        $sth = $pdo->prepare('SELECT * FROM utilisateur WHERE mail = :inputEmail');
        $sth->bindParam(':inputEmail', $input['mail'], PDO::PARAM_STR);
        // execute sql
        $sth->execute();
        $foundEntry = $sth->fetch(PDO::FETCH_ASSOC);

        if ($foundEntry && empty($foundEntry['estVendeur'])) {
            // utilisateur existe deja but it's not vender. we set vendeur flag to 1
            // update utilisateur
            $sth = $pdo->prepare("UPDATE `utilisateur` SET estVendeur=1 WHERE mail=:inputEmail");
            $sth->bindParam(':inputEmail', $input['mail'], PDO::PARAM_STR);
            $sth->execute();

            return true;
        }

        if ($foundEntry) {
            // utlisateur existe and it is vendeur
            throw new \Exception(sprintf("Utilisateur email existe deja: %s", $input['mail']));
        }

        // (3) insert/add new entry in utilisateur table
        $data = [
            'mail'   => $input['mail'],
            'mdp'    => $input['mdp'],
            'nom'    => $input['nom'],
            'prenom' => $input['prenom'],
            'numTel' => !empty($input['numTel']) ? $input['numTel'] : '',
        ];
        //
        $sql  = "INSERT INTO `utilisateur` 
            (`idUtilisateur`, `mail`, `mdp`, `estAdmin`, `nom`, `prenom`, `pseudo`, `numTel`, `vendeurId`, `clocheNotifs`, `estVendeur`) 
            VALUES
            (NULL, :mail, password(:mdp), 0, :nom, :prenom, '', :numTel, NULL, 0, 1)";

        $result = $pdo->prepare($sql)->execute($data);

        if (!$result) {
            throw new \Exception(sprintf("Fail to add new vendeur: %s", $input['mail']));
        }

        return true;
    }
}