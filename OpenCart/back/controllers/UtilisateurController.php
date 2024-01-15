<?php
include_once "../config.php";
require_once "../model/utilisateur.php";

class UtilisateurController{

    //L'ajout
    function ajouterUtilisateur($utilisateur)
    {
        $sql = "INSERT INTO utilisateur (firstName, lastName, address, country, phoneNumber, picture) 
                VALUES (:firstName, :lastName, :address, :country, :phoneNumber, :picture)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);

            $query->execute([
                'firstName' => $utilisateur->getFirstName(),
                'lastName' => $utilisateur->getLastName(),
                'address' => $utilisateur->getAddress(),
                'country' => $utilisateur->getCountry(),
                'phoneNumber' => $utilisateur->getPhoneNumber(),
                'picture' => $utilisateur->getPicture()
            ]);

            http_response_code(201);

        } 
        catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }


    //L'affichage
    
    function afficherUtilisateurs()
{
    $sql = "SELECT * FROM utilisateur";
    $db = config::getConnexion();
    try {
        $list = $db->query($sql);
        $users = $list->fetchAll(PDO::FETCH_ASSOC); 
        return $users; 
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


    // Suppression

function supprimerUtilisateur($id)
{
    $sql = "DELETE FROM utilisateur WHERE id = :id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);

        return $query->rowCount() > 0; 
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}

// Récupérer User

function recupererUtilisateur($id)
{
    $sql = "SELECT * FROM utilisateur WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user; 
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


// La Modification



function modifierUtilisateur($id, $utilisateur)
{
    $sql = "UPDATE utilisateur SET firstName = :firstName, lastName = :lastName, address = :address, country = :country, phoneNumber = :phoneNumber, picture = :picture WHERE Id = :Id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);

        $query->bindValue(':Id', $id, PDO::PARAM_INT);
        $query->bindValue(':firstName', $utilisateur->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':lastName', $utilisateur->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':address', $utilisateur->getAddress(), PDO::PARAM_STR);
        $query->bindValue(':country', $utilisateur->getCountry(), PDO::PARAM_STR);
        $query->bindValue(':phoneNumber', $utilisateur->getPhoneNumber(), PDO::PARAM_STR);
        $query->bindValue(':picture', $utilisateur->getPicture(), PDO::PARAM_STR);

        $query->execute();

        return $query->rowCount() > 0;
    } catch (Exception $e) {
    error_log('Erreur dans modifierUtilisateur: ' . $e->getMessage());
    return false;
    }
}




}

?>
