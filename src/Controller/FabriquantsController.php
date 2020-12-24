<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fabriquants;
use App\Entity\Magasins;
use App\Form\FabriquantsType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Transport\TransportInterface;

class FabriquantsController extends AbstractController
{

    /**
     * @Route("/fabriquant", name="fabriquants")
     */
    public function fabriquants(Request $request){
        $repositoryFabriquants = $this->getDoctrine()->getRepository('App:Fabriquants');
        $fabriquantsAll = $repositoryFabriquants->findAll();

        return $this->render('app/fabriquants.html.twig', array(
            'fabriquants' => $fabriquantsAll
        ));
    }

    /**
     * @Route("/fabriquant/creer", name="creerfabriquants")
     * @Route("/fabriquant/edit/{id}", name="editfabriquants_id")
     */
    public function creerFabriquants(Request $request, $id = false): Response
    {
        if($id){
            $repositoryFabriquants = $this->getDoctrine()->getRepository('App:Fabriquants');
            $fabriquant = $repositoryFabriquants->find($id);
        }
        else $fabriquant = new Fabriquants();

        $creerfabriquants = $this->createForm(FabriquantsType::class, $fabriquant);
        $creerfabriquants->handleRequest($request);
        if($creerfabriquants->isSubmitted()) {
            if ($creerfabriquants->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fabriquant);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Fabriquant les données mises à jour.');
            }
        }

        return $this->render('app/creerfabriquants.html.twig', [
            'form' => $creerfabriquants->createView(),
        ]);
    }
}