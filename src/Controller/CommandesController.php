<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commandes;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_commandes') or is_granted('ROLE_superadmin')")
 */
class CommandesController extends AbstractController
{
    /**
     * @Route("/commande", name="commandes")
     */
    public function index(){
        $repositoryCommandes = $this->getDoctrine()->getRepository('App:Commandes');
        $commandes = $repositoryCommandes->findAll();

        return $this->render('app/commandes.html.twig', array(
            'commandes' => $commandes
        ));
    }

    /**
     * @Route("/commande/{id}", name="commande")
     */
    public function commande($id){
        $repositoryCommandesLignes = $this->getDoctrine()->getRepository('App:CommandesLignes');
        $repositoryCommandes = $this->getDoctrine()->getRepository('App:Commandes');

        $commandes_lignes = $repositoryCommandesLignes->findBy(array('id_commande' => $id));
        $commande = $repositoryCommandes->find($id);

        return $this->render('app/detail_commande.html.twig', array(
            'commandes_lignes' => $commandes_lignes,
            'commande' => $commande
        ));
    }
}