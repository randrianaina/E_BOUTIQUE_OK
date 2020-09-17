<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticlesRepository;

use App\Entity\Articles;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier_page")
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

        $total = 0;
        foreach ($panierWithData as $item)
        {
            $totalItem = $item['product']->getPrixArticle() * $item['quantity'];
            $total += $totalItem;
            // Pour chaque article/item, on ajoute dans $totalItem ce qu'on viens de calculer
        }

        dump($panierWithData);


        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'items' => $panierWithData,
            'total' => $total
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

        dump($session->get('panier'));
        //dumb&die

        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findBy(array("idCategorie" => 1));
        //dump($articles);

        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'article trouvé ...!');
        }

        /* return $this->render('article/index.html.twig', ['articles' => $articles, 'controller_name' => 'Article Controller']); */

        return $this->redirectToRoute('article_tous');

    }
    /**
     * @Route ("/panier/remove/{id}") , name="panier_remove") 
     */
    public function remove($id, SessionInterface $session) {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
    }

    /**
     * @Route("/panier/add/{id}/quantity" , name="panier_add_art_quantity")           //Convention name: controllername_methode
     */
    public function quantityadd($id, SessionInterface $session, ArticlesRepository $articlesRepository)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            // Si j'ai DEJA un produit dans le panier
            $panier[$id]++;
            // On RAJOUTE '1' chaque fois;
        } else {
            $panier[$id] = 1;
        }

       $session->set('panier', $panier);

       $panier = $session->get('panier', []);

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

       $total = 0;
       foreach ($panierWithData as $item)
       {
           $totalItem = $item['product']->getPrixArticle() * $item['quantity'];
           $total += $totalItem;
           // Pour chaque article/item, on ajoute dans $totalItem ce qu'on viens de calculer
       }

       


       return $this->render('panier/index.html.twig', [
           'controller_name' => 'PanierController',
           'items' => $panierWithData,
           'total' => $total
       ]);

        

    }
    



}
