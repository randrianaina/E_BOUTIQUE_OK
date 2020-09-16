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
    public function index(SessionInterface $session)
    {
        $panier = $session->get('panier');

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }




    /**
     * @Route("/panier/add/{id}" , name="panier_add")           //Convention name: controllername_methode
     */

    //public function add($id, Request $request)
    // ^^ Method 1: On demande $id, on recupere la requete ^^

    public function add($id, SessionInterface $session)
    // Methode 2: on demande un OBJET qui REPRESENT la SESSION
    {
        //$session = $request->getSession();      // On va obtenir un objet ^^, qui va etre bougé dans $session
        // ^^ Methode 2: on a plus besoin de cette ligne

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

        $session->set('panier', $panier);
        // Pour garder dans la SESSION l'etat actuel du $panier

        dd($session->get('panier'));
        //dumb&die

    }
}
