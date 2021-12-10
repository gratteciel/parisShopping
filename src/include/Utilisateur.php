<?php

/**
 *
 */
class Utilisateur
{
    public static function addressList($pdo, $utilisateurId)
    {
        /** @var PDO $pdo */
        if (empty($utilisateurId)) {
            return [];
        }

        // prepare sql statement and use parameters (:userId)
        $sth = $pdo->prepare('SELECT * FROM adresse WHERE utilisateurId = :userId');
        // replace ":userId" param with (int) $utilisateurId
        $sth->bindParam(':userId', $utilisateurId, PDO::PARAM_INT);
        // execute sql
        $sth->execute();

        // return array with all table rows found for this user
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cardList($pdo, $utilisateurId)
    {
        /** @var PDO $pdo */
        if (empty($utilisateurId)) {
            return [];
        }

        $sth = $pdo->prepare('SELECT * FROM paiement WHERE utilisateurId = :userId');
        // replace ":userId" param with (int) $utilisateurId
        $sth->bindParam(':userId', $utilisateurId, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function commandes($pdo, $utilisateurId)
    {
        /** @var PDO $pdo */
        if (empty($utilisateurId)) {
            return [];
        }

        $sth = $pdo->prepare('SELECT * FROM commandeLog WHERE utilisateurId = :userId ORDER BY dateCommande DESC' );
        // replace ":userId" param with (int) $utilisateurId
        $sth->bindParam(':userId', $utilisateurId, PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function afficherValeurSession($fieldName)
    {
        if (isset($_SESSION[$fieldName])) {
            return $_SESSION[$fieldName];
        }

        return null;
    }
}