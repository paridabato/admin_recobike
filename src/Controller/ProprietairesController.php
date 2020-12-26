<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Magasins;
use App\Form\ProprietairesType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_proprietaires') or is_granted('ROLE_superadmin')")
 */
class ProprietairesController extends AbstractController
{

    /**
     * @Route("/proprietaire", name="proprietaires")
     */
    public function proprietaires(Request $request){
        $repositoryProprietaires = $this->getDoctrine()->getRepository('App:Proprietaires');
        $proprietairesAll = $repositoryProprietaires->findAll();

        return $this->render('app/proprietaires.html.twig', array(
            'proprietaires' => $proprietairesAll
        ));
    }

    /**
     * @Route("/proprietaire/{id}", name="proprietaire_id")
     */
    public function proprietaireId($id, Request $request){
        $repositoryProprietaires = $this->getDoctrine()->getRepository('App:Proprietaires');
        $proprietaires = $repositoryProprietaires->find($id);
        $proprietaire = $this->createForm(ProprietairesType::class, $proprietaires);

        return $this->render('app/proprietaire.html.twig', array(
            'form' => $proprietaire->createView(),
        ));

    }
}