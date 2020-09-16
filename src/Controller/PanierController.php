<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */

    //Affichage du panier aux utilisateurs
    //Utilisation de SessionInterface pour la gestion des sessions (service)
    public function index(SessionInterface $session)
    //
    {
        //on stocke dans $panier les données stockées dans la session dans panier
            // ou stocke un tableau vide si il y a aucunes données
        $panier = $session->get('panier',[]);

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }


    
    

    /**
     * @Route("/panier/add/{id}" , name="panier_add")           //Convention name: controllername_methode
     */
    
     //Fonction ajout d'article
    //public function add($id, Request $request)
    // Commentaire HORIA : ^^ Method 1: On demande $id, on recupere la requete ^^

        //En premier paramètre, on récupère l'id 
    public function add($id, SessionInterface $session)
    // Commentaire HORIA : Methode 2: on demande un OBJET qui REPRESENT la SESSION
    {
        //$session = $request->getSession();      //Commentaire HORIA On va obtenir un objet ^^, qui va etre bougé dans $session
        // ^^ Methode 2: on a plus besoin de cette ligne


        //On récupère les données de la session qui s'apelle panier, sinon on récupère un tableau vide
        $panier = $session->get('panier', []);
        // On recupere $panier dans la SESSION
        // ^^ Valeur par default

        if (!empty($panier[$id])) {
            // Si j'ai DEJA un produit dans le panier
            $panier[$id]++;
            // On RAJOUTE '1' chaque fois;
        } else {
            $panier[$id] = 1;
        }

        //Sauvegarde l'état de la session actuelle contenant des données panier
        $session->set('panier', $panier);
        // Pour garder dans la SESSION l'etat actuel du $panier

        dd($session->get('panier'));
        //dumb&die

    }
}
