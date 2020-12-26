<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produits;
use App\Form\ProduitsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_produits') or is_granted('ROLE_superadmin')")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/produit", name="produits")
     */
    public function produits(){
        $repositoryProduits = $this->getDoctrine()->getRepository('App:Produits');
        $produits = $repositoryProduits->findAll();

        return $this->render('app/produits.html.twig', array(
            'produits' => $produits
        ));
    }

    /**
     * @Route("/produit/{id}", name="produit_id")
     */
    public function produit($id){
        $repositoryProduits = $this->getDoctrine()->getRepository('App:Produits');
        $produit = $repositoryProduits->find($id);

        $creerproduit = $this->createForm(ProduitsType::class, $produit);

        return $this->render('app/detail_produit.html.twig', array(
            'form' => $creerproduit->createView(),
        ));
    }
}