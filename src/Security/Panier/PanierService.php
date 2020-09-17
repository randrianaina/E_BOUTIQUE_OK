<?php

namespace App\Service\Panier;

use Symfony\Component\HttpFoundation\Session\SessionInterface;



class PanierService {

    protected $session;
    
    public function __construct(SessionInterface $session) {

        $this->session = $session;
    }


    public function add(int $id) { 

        $panier = $this->session->get('panier', []);
        // On recupere $panier dans la SESSION
        // ^^ Valeur par default

        if (!empty($panier[$id])) {
            // Si j'ai DEJA un produit dans le panier
            $panier[$id]++;
            // On RAJOUTE '1' chaque fois;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
        // Pour garder dans la SESSION l'etat actuel du $panier


    }

    public function remove(int $id) {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
    }

    /* public function getFullPanier() : array {}

    public function getTotal() : float {} */
}