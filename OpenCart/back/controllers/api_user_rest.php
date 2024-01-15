<?php
header("Content-Type: application/json");
include_once "../config.php";
require_once "../model/utilisateur.php";
include_once "UtilisateurController.php";

header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, XMLHttpRequest");
header("Access-Control-Allow-Credentials: true");

$method = $_SERVER['REQUEST_METHOD'];

$controller = new UtilisateurController();
$id = $_GET['id'] ?? null;


switch ($method) {

  case 'GET':
   
    // $Id = $_GET['id'] ?? null;
    if ($id) {
        $user = $controller->recupererUtilisateur($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404); 
            echo json_encode(["error" => "Utilisateur non trouvé"]);
        }
    } else {
        $users = $controller->afficherUtilisateurs();
        echo json_encode($users);
    }
    break;

  case 'POST':
    $data = json_decode(file_get_contents('php://input'), true);
    $response = $controller->ajouterUtilisateur(new Utilisateur(...$data));
    if ($response) {
        echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
    } else {
        echo json_encode(["error" => "L'ajout de l'utilisateur a échoué"]);
    }
    break;

   
    case 'PUT':
        // Modifier un utilisateur
        $data = json_decode(file_get_contents('php://input'), true);
        
        if ($id && $data) {
            $response = $controller->modifierUtilisateur($id, new Utilisateur(...$data)); 
            if ($response) {
                echo json_encode(["message" => "Utilisateur modifié avec succès"]);
            } else {
                http_response_code(400); 
                echo json_encode(["error" => "La modification de l'utilisateur a échoué"]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["error" => "ID de l'utilisateur ou données manquantes"]);
        }
    break;
    
    
    

    
    case 'DELETE':
        // Supprimer un utilisateur
        // Extract the  id user from the URL
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($urlParts);
    
        if ($id) {
            $response = $controller->supprimerUtilisateur($id);
            if ($response) {
                echo json_encode(["message" => "Utilisateur supprimé avec succès"]);
            } else {
                http_response_code(400); 
                echo json_encode(["error" => "La suppression de l'utilisateur a échoué"]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["error" => "Id de l'utilisateur manquant"]);
        }
        break;
    
    
    
  }
