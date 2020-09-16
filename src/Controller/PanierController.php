<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index()
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
    

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/article/tous", name="add_article")
     */
    /*  public function addArticle()
    {
        if (isset($_POST['submit'])) {
            $_SESSION = array();
            $_POST['submit'] = $_SESSION['submit'];
        }

        $this->session->get($_SESSION['submit']);
    } */
}
