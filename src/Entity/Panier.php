<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @ORM\Entity(repositoryClass=PanierRepository::class)
 */
class Panier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /* public function __construct(){
		if(!isset($_SESSION['panier'])){
			$_SESSION['panier'] = array();
		}
	}

    public function add($product_id){
		if(isset($_SESSION['panier'][$product_id])){
			$_SESSION['panier'][$product_id]++;
		}else{
			$_SESSION['panier'][$product_id] = 1;
		}
  } */
  
  private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }



    public function addArticle()
    {
        if (isset($_POST['submit'])) {
            $_SESSION = array();
            $_POST['submit'] = $_SESSION['submit'];
        }

        $this->session->get($_SESSION['submit']);
    }
}
