<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticlesRepository;



class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, ArticlesRepository $articlesRepository)
    {
        $panier = $session->get('panier', []);
        // ^^ ca prends la valeur de ce qu'il a dans la SESSION
        // Ou, on laisse un tableu vide s'il a pas encore des articles selectiones

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                // On bouge tout dans un nouveau tableau, avec 2 colonnes 
                'product' => $articlesRepository->find($id),
                // Ici on a besoin de toutes les donnes d'article qui correspondent a l'ID
                // On utilise "ArticlesRepository"
                'quantity' => $quantity
            ];
        }

        dump($panierWithData);


        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController', 'items' => $panierWithData
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
