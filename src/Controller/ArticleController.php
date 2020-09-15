<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/article/tous", name="article_tous")
     */
    public function All() // pour trouver par l'attribut que l'on veut => name, price voire les 2
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findAll(); // $products = $repository->findBy(['name'=>'keyboard', 'price'=>'ASC']); => vient tout mettre dans un tableau
        /* $products = $repository->findAll(); */
        //dump($articles);

        dump(session_status());
        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'article trouvé ...!');
        }
        dump($_POST);

        return $this->render('article/index.html.twig', ['articles' => $articles, 'controller_name' => 'Article Controller' ]);

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/article/consoles", name="article_consoles")
     */
    public function Consoles()
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findBy(array("idCategorie" => 1)); 
        //dump($articles);

        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'article trouvé ...!');
        }

        return $this->render('article/index.html.twig', ['articles' => $articles, 'controller_name' => 'Article Controller' ]);
    }

    /**
     * @Route("/article/jeux", name="article_jeux")
     */
    public function Jeux()
    {
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repository->findBy(array("idCategorie" => 2)); 
        //dump($articles);

        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'article trouvé ...!');
        }

        return $this->render('article/index.html.twig', ['articles' => $articles, 'controller_name' => 'Article Controller' ]);
    }

   /*  private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function addArticle()
    {
        if (isset($_POST['add'])) {
            $_POST['add'] = $_SESSION['add'];
        }

            $this->session->get($_SESSION['add']);

        }
        
    } */





}
